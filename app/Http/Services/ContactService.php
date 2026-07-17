<?php

namespace App\Http\Services;

use App\Mail\OwnerContactMail;
use App\Mail\UserContactMail;
use App\Models\Contact;
use App\Repositories\ContactRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactService
{
    public function __construct(private readonly AIService $AIService, private readonly ContactRepository $contactRepository){}

    public function store(array $data): Contact
    {
        $analysis = $this->AIService->analyze($data['comment']);

        $contact = $this->contactRepository->create([...$data, ...$analysis]);

        try {
            Mail::to($data['email'])->send(new UserContactMail($contact));
            Mail::to(config("mail.admin_email"))->send(new OwnerContactMail($contact));
        } catch (\Throwable $th) {
            Log::error('Mail sending failed', [
                'contact_id' => $contact->id,
                'message' => $th->getMessage(),
            ]);
        }

        return $contact;
    }

}
