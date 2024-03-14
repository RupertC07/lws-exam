<?php

namespace App\Http\Middleware;

use App\Http\Responses\AppResponse;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiKeyChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        //this middleware will check the api key, this is to prevent unauthorized use of the api of my mini app

        $apiKey = $request->header("X-API-Key");

        //for now let's store and get apikey on our env 
        $storedKey = env('ANIME_API_KEY');

        if ($apiKey == $storedKey){
            return $next($request);
           
        }

        return AppResponse::error('Unauthorized', null, 403);
        
        //proceed to any controllers or functions
        
       
    }
}
