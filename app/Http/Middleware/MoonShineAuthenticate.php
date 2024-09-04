<?php

namespace App\Http\Middleware;

use Illuminate\Validation\ValidationException;
use MoonShine\MoonShineAuth;

class MoonShineAuthenticate extends \MoonShine\Http\Middleware\Authenticate
{
    protected function authenticate($request, array $guards): void
    {
        if (!config('moonshine.auth.enable', true)) {
            return;
        }

        $guard = MoonShineAuth::guard();

        if (!$guard->check()) {
            $this->unauthenticated($request, $guards);
        }

        if (!$guard->user()->is_admin) {
            $guard->logout();
            throw ValidationException::withMessages([
                'username' => 'You are not allowed to access this page.',
            ]);
        }

        $this->auth->shouldUse(MoonShineAuth::guardName());
    }

    protected function redirectTo($request): string
    {
        return moonshineRouter()->to('login');
    }
}
