<?php

namespace app\api\middleware;

use Triangle\Engine\Exception\BusinessException;
use Triangle\Engine\Http\Request;
use Triangle\Engine\Http\Response;
use Triangle\Engine\Middleware\MiddlewareInterface;

class AuthGuarder implements MiddlewareInterface
{

    public function process(Request $request, callable $handler): Response
    {
            try {
                if (!$request->sessionId()) {
                    $request->session()->flush();
                    $request->session()->save();
                    throw new BusinessException('Отсутствует идентификатор сессии', 401);
                }

                if (!session('user_id')) {
                    throw new BusinessException('Некорректные данные авторизации', 401);
                }

                $user = user();

                if (!$user) {
                    $request->session()->flush();
                    $request->session()->save();
                    throw new BusinessException('Недопустимые данные авторизации ' . session('user_id') . '/', 401);
                }
            } catch (BusinessException $response) {
                if ($request->expectsJson()) {
                    throw $response;
                } else {
                    if ($request->uri() == '/') return redirect(url('/auth'));
                    return redirect(url('/auth?redirect=' . urlencode($request->uri())));
                }
            }

        return $handler($request);
    }
}