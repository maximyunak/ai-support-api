<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Http\Services\ContactService;
use OpenApi\Attributes as OA;

class ContactController extends Controller
{
    public function __construct(private readonly ContactService $contactService) {}

    #[OA\Post(
        path: '/api/contact',
        summary: 'Create contact request',
        tags: ['Contacts']
    )]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            required: ['name', 'email', 'phone', 'comment'],
            properties: [
                new OA\Property(property: 'name', type: 'string', example: 'Max'),
                new OA\Property(property: 'email', type: 'string', example: 'max@test.com'),
                new OA\Property(property: 'phone', type: 'string', example: '+799999999'),
                new OA\Property(property: 'comment', type: 'string', example: 'Не работает форма'),
            ]
        )
    )]
    #[OA\Response(response: 201, description: 'Success')]
    #[OA\Response(
        response: 429,
        description: 'Too Many Requests.'
    )]
    #[OA\Response(response: 422, description: 'Validation error')]
    public function __invoke(ContactRequest $request)
    {
        $contact = $this->contactService->store($request->validated());

        return response()->json($contact, 201);
    }
}
