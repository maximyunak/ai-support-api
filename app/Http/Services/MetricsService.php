<?php

namespace App\Http\Services;

use App\Repositories\ContactRepository;

class MetricsService
{

    public function __construct(private readonly ContactRepository $contactRepository){}

    public function getMetrics(): array
    {
        $metrics = $this->contactRepository->getMetrics();

        return [
            'total' => (int) $metrics->total,
            'positive' => (int) $metrics->positive,
            'neutral' => (int) $metrics->neutral,
            'negative' => (int) $metrics->negative,
            'questions' => (int) $metrics->questions,
            'support' => (int) $metrics->support,
            'feedback' => (int) $metrics->feedback,
            'complaints' => (int) $metrics->complaints,
            'other' => (int) $metrics->other,
        ];
    }
}
