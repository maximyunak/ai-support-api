<?php

namespace App\Http\Services;


use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AIService
{

    public function analyze(string $comment)
    {
        $prompt = <<<PROMPT
            Ты — помощник службы поддержки.

            Проанализируй обращение пользователя.

            Верни ТОЛЬКО валидный JSON без markdown, без пояснений и без дополнительного текста.

            Правила:
            - sentiment может быть только: "positive", "neutral", "negative"
            - category может быть только: "question", "support", "feedback", "complaint", "other"
            - reply — вежливый ответ пользователю длиной 2–3 предложения.

            Формат ответа:

            {
              "sentiment": "positive|neutral|negative",
              "category": "question|support|feedback|complaint|other",
              "ai_reply": "..."
            }
        PROMPT;

        try {
            $req = Http::baseUrl(config('services.openai.base_url'))
                ->withToken(config('services.openai.api_key'))
                ->post("/chat/completions", [
                    "model" => config("services.openai.model"),
                    "messages" => [
                        [
                            "role" => "system",
                            "content" => $prompt
                        ],
                        [
                            "role" => "user",
                            "content" => $comment
                        ]
                    ]
                ]);
            $content = $req->json("choices.0.message.content");
            if (!$content) {
                throw new \Exception('AI response empty');
            }
            $req->throw();

            return json_decode($content, true);
        } catch (\Throwable $exception) {
            Log::error("AI FAILED", [
                "message" => $exception->getMessage(),
            ]);

            return [
                "sentiment" => "neutral",
                "category" => "other",
                "ai_reply" => "Спасибо за ваше обращение. Мы скоро свяжемся с вами.",
            ];
        }
    }


}
