<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;

class HealthController extends Controller
{
    #[OA\Get(
        path: '/api/health',
        summary: 'Check service health',
        tags: ['Health']
    )]
    #[OA\Response(
        response: 200,
        description: 'Service is healthy',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'string', example: 'ok'),
            ]
        )
    )]
    #[OA\Response(
        response: 429,
        description: 'Too Many Requests.'
    )]
    public function __invoke()
    {
        return response()->json([
            'status' => 'ok',
        ]);
    }
}
