<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class Authorization
{
    public function handle($request, Closure $next, $guard = null)
    {
        $apiKey = $request->header('RESTfull-API-KEY');
        $source = "";
        if ($apiKey === (env('API_KEY'))) {
            $source = "WEB";
        }else{
            return response()->json([
                'error' => 'API key is not valid.',
                'success'=> 0,
                'data'=>null,
                'message' => 'API key is not valid.',
            ], 401);
        }
        return $next($request);

    }
}
