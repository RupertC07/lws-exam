<?php

namespace App\Http\Middleware;

use App\Actions\User\UserFetchAction;
use App\Http\Responses\AppResponse;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExistenceChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $user = $request->user();
        $userData = new UserFetchAction();

        if ($userData->execute($user->id)) {
            return $next($request);
        }

        return AppResponse::error('Unauthorized', null, 403);

        
    }
}
