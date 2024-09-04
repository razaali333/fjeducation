<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\CoreController;
use App\Http\Resources\ContentResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/api/v1/profile-contents",
 *     summary="Get all allowed content.",
 *     tags={"Content"},
 *     security={{ "Bearer":{} }},
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
class ProfileContentController extends CoreController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = Auth::guard('api')->user();

        $user->load(['earnedRates', 'earnedRates.contents', 'earnedRates.contents.content']);

        $result = [];

        foreach ($user->earnedRates as $rate) {
            foreach ($rate->contents as $content) {
                $result[] = (new ContentResource($content->content))->toArray($request);
            }
        }

        $this->result->Success = true;
        $this->result->Content = $result;

        return response()->json($this->result);
    }
}
