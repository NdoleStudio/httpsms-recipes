<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateHttpSmsWebhook
{
    /**
     * Authenticate an incoming webhook request from the httsms.com server.
     * Documentation: https://docs.httpsms.com/webhooks/introduction
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($this->authenticationTokenIsValid($request)) {
            return $next($request);
        }

        App::abort(401, "Invalid httpsms JWT token.");
    }


    private function authenticationTokenIsValid(Request $request): bool {
        try {
            $decoded = JWT::decode($request->bearerToken(), new Key(config('httpsms.webhook.signing_key'), 'HS256'));
            Log::info(json_encode($decoded, JSON_PRETTY_PRINT));
            return true;
        } catch (Exception $exception) {
            Log::info("could not validate httpsms Bearer token [{$request->bearerToken()}]");
            Log::error($exception);
            return false;
        }
    }


}
