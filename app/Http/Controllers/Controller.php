<?php

namespace App\Http\Controllers;
use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    description: 'API for contact requests with AI analysis',
    title: 'AI Support API'
)]
abstract class Controller
{
    //
}
