<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="API v1",
 *      description="Details API",
 *      @OA\Server(
 *          url=L5_SWAGGER_CONST_HOST,
 *          description="API"
 *      )
 * )
 * 
 * @OA\SecurityScheme(
 *      securityScheme="sanctum",
 *      type="http",
 *      scheme="bearer"
 * )
 */

class ApiController extends Controller
{
    //
}
