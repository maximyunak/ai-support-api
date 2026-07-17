<?php

namespace App\Http\Controllers;

use App\Http\Services\MetricsService;
use OpenApi\Attributes as OA;

class MetricsController extends Controller
{
    public function __construct(private readonly MetricsService $metricsService) {}

    #[OA\Get(
        path: '/api/metrics',
        summary: 'Get contacts metrics',
        tags: ['Metrics']
    )]
    #[OA\Response(
        response: 200,
        description: 'Metrics retrieved successfully',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'total', type: 'integer', example: 16),
                new OA\Property(property: 'positive', type: 'integer', example: 2),
                new OA\Property(property: 'neutral', type: 'integer', example: 0),
                new OA\Property(property: 'negative', type: 'integer', example: 14),
                new OA\Property(property: 'questions', type: 'integer', example: 1),
                new OA\Property(property: 'support', type: 'integer', example: 0),
                new OA\Property(property: 'feedback', type: 'integer', example: 1),
                new OA\Property(property: 'complaints', type: 'integer', example: 14),
                new OA\Property(property: 'other', type: 'integer', example: 0),
            ]
        )
    )]
    #[OA\Response(
        response: 429,
        description: 'Too Many Requests.'
    )]
    public function __invoke()
    {
        $metrics = $this->metricsService->getMetrics();

        return response()->json($metrics);
    }
}
