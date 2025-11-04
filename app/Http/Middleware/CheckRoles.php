<?php

namespace App\Http\Middleware;

use App\Utils\UserRoleUtil;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRoles
{
    public function handle(Request $request, Closure $next, $roles): Response
    {
        $roles = str($roles)->explode('|')->toArray();
        $isValid = UserRoleUtil::checkRoles($roles);

        if (!$isValid) abort(Response::HTTP_FORBIDDEN, 'This action is unauthorized.');

        return $next($request);
    }
}
