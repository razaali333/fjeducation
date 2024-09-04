<?php

namespace App\Http\Controllers;

use App\Services\Patterns\Result;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     version="1.0",
 *     title="Education IS Swagger OpenAPI documentation",
 *     description="OpenAPI documentation for backend methods of Education IS.<br>Notice: every data figuring in response is placing in <i>Result</i> Schema (see in description below)."
 * ),
 * @OA\Server(
 *     url="http://localhost:8002",
 *     description="DEV"
 * ),
 * @OA\Server(
 *     url="http://localhost:8002",
 *     description="PROD"
 * ),
 * @OA\PathItem(path="/api"),
 * @OA\SecurityScheme(
 *     scheme="bearer",
 *     securityScheme="Bearer",
 *     type="http",
 *     in="header",
 *     name="Authorization",
 * )
 */
class CoreController extends Controller
{
    protected Result $result;

    public function __construct()
    {
        $this->result = new Result();
    }
}
