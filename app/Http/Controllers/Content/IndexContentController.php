<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\CoreController;
use App\Http\Resources\ContentCollection;
use App\Models\Content;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/api/v1/contents/{type}",
 *     summary="Getting all content in category (if exists).",
 *     tags={"Content"},
 *     @OA\Parameter(
 *         in="path",
 *         name="type",
 *         allowEmptyValue=true,
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="OK",
 *         @OA\JsonContent(
 *             ref="#/components/schemas/ContentCollection"
 *         )
 *     ),
 *     @OA\Response(
 *         response="500",
 *         description="There is errors in request.",
 *         @OA\JsonContent(
 *             ref="#/components/schemas/Result"
 *         )
 *     )
 * )
 */
class IndexContentController extends CoreController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $type = null): JsonResponse
    {
        $contents = Content::query();

        if ($type != null) {
            $contents->whereHas('contentCategory', function ($query) use ($type) {
                return $query->where('slug', $type);
            });
        }

        $this->result->Success = true;
        $this->result->Content = (new ContentCollection($contents->get()))->toArray($request);

        return response()->json($this->result);
    }
}
