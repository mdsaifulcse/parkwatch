<?php

namespace App\Http\Middleware;

use App\Http\Traits\ApiResponseTrait;
use Closure;
use Symfony\Component\HttpFoundation\Response;

class UserApiMiddleware
{
    use ApiResponseTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!auth('userApi')->check()) {

            return $this->respondWithError('Your are not authorized user',[],Response::HTTP_UNAUTHORIZED);

        }

        return $next($request);
    }
}
