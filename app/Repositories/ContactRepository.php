<?php

namespace App\Repositories;

use App\Http\Services\ContactService;
use App\Models\Contact;

class ContactRepository
{
    public function create(array $data): Contact
    {
        return Contact::create($data);
    }

    public function getMetrics()
    {
        return Contact::selectRaw('
            COUNT(*) as total,
            SUM(sentiment = "positive") as positive,
            SUM(sentiment = "neutral") as neutral,
            SUM(sentiment = "negative") as negative,
            SUM(category = "question") as questions,
            SUM(category = "support") as support,
            SUM(category = "feedback") as feedback,
            SUM(category = "complaint") as complaints,
            SUM(category = "other") as other
        ')->first();
    }
}
