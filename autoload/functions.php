<?php

/**
 * @package     Triangle Web
 * @link        https://github.com/Triangle-org
 *
 * @copyright   2018-2024 Localzet Group
 * @license     https://mit-license.org MIT
 */

use app\model\Users;
use localzet\WebAnalyzer;
use support\Log;
use support\Response;
use Triangle\Engine\Exception\BusinessException;
use Triangle\Engine\Http\Request;

/**
 * @param Request|null $request
 * @throws Exception
 */
function parse_redirect(Request $request = null): void
{
    $request = $request ?? request();
    if ($request->sessionId() && $request->get('redirect')) {
        session(['redirect' => urldecode($request->get('redirect'))]);
        session()->save();
    }
}

/**
 * @return string
 * @throws Exception
 */
function get_redirect(): string
{
    $redirect = session('redirect');
    session()->delete('redirect');
    session()->save();
    return $redirect ?? url();
}

/**
 * @param string|null $default
 * @return Response
 * @throws Exception
 */
function redirect_home(string $default = null): Response
{
    $default = $default ?? url();
    $redirect = get_redirect();
    if (!empty($redirect)) {
        if (str_starts_with($redirect, 'http')) {
            return redirect($redirect);
        } else {
            return redirect(url($redirect));
        }
    } else {
        if (str_starts_with($default, 'http')) {
            return redirect($default);
        } else {
            return redirect(url($default));
        }
    }
}

/**
 * Текущий пользователь
 * @param null $fields
 * @return Users|array|mixed|null
 * @throws Exception
 * @throws Exception
 */
function user($fields = null, mixed $default = null): mixed
{
    refresh_user_session();

    $user = Users::find(session('user_id'));

    if (!$user) {
        return $default;
    }

    if ($fields === null) {
        return $user;
    }

    if (is_array($fields)) {
        $results = [];
        foreach ($fields as $field) {
            $results[$field] = $user->$field ?? null;
        }
        return $results;
    }

    if (strpos($fields, '.')) {
        $keyArray = explode('.', $fields);

        foreach ($keyArray as $field) {
            if (!isset($user->$field)) {
                return $user->$fields ?? $default;
            }

            $user = $user->$field;
        }

        return $user;
    }

    return $user->$fields ?? $default;
}

/**
 * Обновить сессию пользователя
 * @param bool $force
 * @return void
 * @throws Exception
 * @throws Exception
 * @throws Exception
 * @throws Exception
 * @throws Exception
 */
function refresh_user_session(bool $force = false): void
{
    $userId = session('user_id');

    if (!$userId) {
        return;
    }

    $user = Users::find($userId);

    if (!$user) {
        session()->forget('user_id');
        return;
    }

    $timeNow = time();
    $sessionTTL = 2;
    $sessionLastUpdateTime = session('session_last_update_time', 0);

    if (!$force && $timeNow - $sessionLastUpdateTime < $sessionTTL) {
        return;
    }

    session([
        'session_last_update_time' => $timeNow,
        'user_id' => $user->id,
    ]);
}

function isUrl($url): bool
{
    if (!$url) {
        return false;
    }

    if (!preg_match('~^(#|//|https?://|(mailto|tel|sms):)~', $url)) {
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }

    return true;
}

function to($name, ...$parameters): string
{
    return url(route($name, ...$parameters));
}

function url($uri = ''): string
{
    if (isUrl($uri)) {
        return $uri;
    }

    return rtrim(config('app.url'), '/') . ($uri ? ('/' . ltrim($uri, '/')) : $uri);
}

/**
 * @param Request|null $request
 * @param bool $forbiddenBot
 * @return void
 * @throws Exception
 */
function parse_session_data(Request $request = null, bool $forbiddenBot = false): void
{
    try {
        $request = $request ?? request();
        $wb = new WebAnalyzer($request->header());

        if ($forbiddenBot && $wb->device->type == 'bot') {
            throw new BusinessException('Forbidden', 403);
        }

        session(['ip' => getRequestIp()]);
        session(['online' => date('d.m.Y H:i:s')]);
        session(['browser' => $wb->browser->toArray()]);
        session(['engine' => $wb->engine->toArray()]);
        session(['os' => $wb->os->toArray()]);
        session(['device' => $wb->device->toArray()]);
        session(['language' => mb_substr($request->header('accept-language'), 0, 2)]);
        session(['referrer' => $request->header('referer')]);

        session(['city' => $wb->location->city ?? null]);
        session(['country' => $wb->location->country ?? null]);
        session(['country_code' => $wb->location->country_code ?? null]);
        session(['timezone' => $wb->location->timezone ?? null]);

        if (!empty($wb->location->subdivisions) && count($wb->location->subdivisions) >= 1) {
            $subdivisions = $wb->location->subdivisions[0]['names']['ru'] ?? $wb->location->subdivisions[0]['names'][strtolower($wb->location->country_code)] ?? $wb->location->subdivisions[0]['names']['en'];
            foreach (array_slice($wb->location->subdivisions, 1) as $subdivision) {
                $subdivisions .= ', ' . ($subdivision['names']['ru'] ?? $subdivision['names'][strtolower($wb->location->country_code)] ?? $subdivision['names']['en']);
            }
        }

        session(['subdivisions' => $subdivisions ?? null]);
    } catch (Throwable $e) {
        Log::error((string)$e);
    } finally {
        session()->save();
    }
}