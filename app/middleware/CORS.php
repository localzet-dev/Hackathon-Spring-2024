<?php

namespace app\middleware;

use Triangle\Engine\Http\Request;
use Triangle\Engine\Http\Response;
use Triangle\Engine\Middleware\MiddlewareInterface;

class CORS implements MiddlewareInterface
{

    public function process(Request $request, callable $handler): Response
    {
        $methods = ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS', 'HEAD', 'TRACE', 'CONNECTION'];
        $origins = ['*'];

        $allowedMethods = config('app.allowed_methods', $methods);
        $allowedOrigins = config('app.allowed_origins', $origins);

        $requestMethod = $request->method();
        $requestOrigin = $request->header('Origin', '*');

        $headers = [
            'Access-Control-Allow-Credentials' => 'true',
            'Access-Control-Allow-Origin' => in_array($requestOrigin, $allowedOrigins, true) ? $requestOrigin : $allowedOrigins[0],
            'Access-Control-Allow-Methods' => implode(', ', $allowedMethods),
            'Access-Control-Allow-Headers' => $request->header('Access-Control-Request-Headers', '*'),
            'Access-Control-Max-Age' => 86400, // Предварительные запросы кэшируются на 24 часа
        ];

        if ($requestMethod === 'OPTIONS') {
            return (new Response(200, $headers, 'OK'))->header('Allow', implode(', ', $allowedMethods));
        }

        if (!in_array($requestMethod, $methods, true)) {
            return new Response(501, $headers, 'Not Implemented');
        }

        if (!in_array($requestMethod, $allowedMethods, true)) {
            return new Response(405, $headers, 'Method Not Allowed');
        }

        $response = $handler($request);

        if ($requestMethod === 'HEAD') {
            return $response->withBody('');
        }

        return $response->withHeaders($headers)->withoutHeader('Access-Control-Max-Age');
    }
}