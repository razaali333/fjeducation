<?php

namespace App\Services\Patterns;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Result",
 *     description="Server answer",
 *     @OA\Property(
 *         property="Success",
 *         type="bool",
 *         default="false"
 *     ),
 *     @OA\Property(
 *         property="Content",
 *         description="Response content in case of successful request. Can be an object or an array if multiple object returns (list of smth).",
 *         type="object",
 *         items={
 *
 *         }
 *     ),
 *     @OA\Property(
 *         property="Error",
 *         description="Error message if Success flag is false.",
 *         type="string"
 *     )
 * )
 */
final class Result
{
    public bool $Success = false;
    public array $Content = [];
    public string $Error = '';
}
