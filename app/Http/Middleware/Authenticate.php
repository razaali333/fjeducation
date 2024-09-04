<?php

namespace App\Http\Middleware;

use App\Services\Patterns\Result;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * @param Request $request
     * @param Closure $next
     * @param ...$guards
     * @return JsonResponse|RedirectResponse
     */
    public function handle($request, Closure $next, ...$guards): JsonResponse|RedirectResponse
    {
        $isAuth = Auth::guard('api')->check();

        if (!$isAuth) {
            $result = new Result();
            $result->Error = __('back.errors.unauthenticated');

            return response()->json($result, 401);
        }

        return $next($request);
    }
}
