<?php

namespace app\controller;

use Exception;
use support\Request;
use support\Response;
use Throwable;
use Triangle\OAuth;

class Auth
{
    /**
     * @param Request $request
     * @return Response
     * @throws Throwable
     */
    public function index(Request $request): Response
    {
        return $this->google($request);
    }

    /**
     * @param Request $request
     * @return Response
     * @throws Throwable
     */
    public function google(Request $request): Response
    {
        parse_redirect($request);

        $oauth = new OAuth([
            'providers' => [
                'google' => [
                    'enabled' => true,
                    'callback' => 'https://oggetto-coffee.localzet.com/auth/google',
                    'keys' => [
                        'id' => '578559583790-4dv22kseh0nh3kquk6kkg4lq2k567q5c.apps.googleusercontent.com',
                        'secret' => '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',
                    ],
                ],
            ]
        ]);
        $authenticate = $oauth->authenticate('google');
        if ($authenticate instanceof Response) {
            return $authenticate;
        }

        $profile = array_change_key_case((array)$authenticate->getUserProfile());
        unset($profile['data']);
        $profile['provider'] = 'google';
        $oauth = \app\model\Oauth::updateOrCreate(['provider' => 'google', 'identifier' => $profile['identifier']], $profile);

        if ($oauth->user) {
            $user = $oauth->user;
        } else {
            $user = \app\model\Users::firstOrCreate(['email' => $oauth['email']], [
                'email' => $oauth['email'],
                'firstname' => $oauth['firstname'],
                'lastname' => $oauth['lastname'],
                'middlename' => $oauth['middlename'],
                'status' => 'pending'
            ]);

            $oauth->user()->associate($user);
            $oauth->save();
        }

        session(['user_id' => $user->id]);
        parse_session_data($request);

        return redirect_home('/my');
    }

    /**
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function destroy(Request $request): Response
    {
        parse_redirect($request);

        session()->flush();
        session()->save();

        return redirect_home();
    }
}