<?php

/**
 * @package     Triangle Web
 * @link        https://github.com/Triangle-org
 *
 * @copyright   2018-2024 Localzet Group
 * @license     https://mit-license.org MIT
 */

use localzet\Server;

return [
    'monitor' => [
        'handler' => process\Monitor::class,
        'reloadable' => false,
        'constructor' => [
            'monitorDir' => array_merge(
                [
                    app_path(),
                    config_path(),
                    base_path() . '/autoload',
                    base_path() . '/process',
                    base_path() . '/support',
                    base_path() . '/resource',
                    base_path() . '/.env',
                ],
                glob(base_path() . '/plugin/*/app'),
                glob(base_path() . '/plugin/*/autoload'),
                glob(base_path() . '/plugin/*/config'),
                glob(base_path() . '/plugin/*/api')
            ),
            'monitorExtensions' => [
                'php', 'phtml', 'html', 'htm', 'env'
            ],
            'options' => [
                'enable_file_monitor' => !Server::$daemonize && DIRECTORY_SEPARATOR === '/',
                'enable_memory_monitor' => DIRECTORY_SEPARATOR === '/',
            ]
        ]
    ],
    'pusher' => [
        'handler' => process\Pusher::class,
        'listen' => 'websocket://0.0.0.0:3131',
        'count' => 1,
        'reloadable' => false,
        'constructor' => [
            'api_listen' => 'http://0.0.0.0:3232',
            'app_info' => [
                'oggetto_coffee_240419' => [
                    'channel_hook' => 'http://127.0.0.1:8787/push/hook',
                    'app_secret' => 'styhjkjsdnkkvsjdkbfsjcyusbhwes',
                ],
            ]
        ]
    ]
];
