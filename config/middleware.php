<?php

/**
 * @package     Triangle Web
 * @link        https://github.com/Triangle-org
 *
 * @copyright   2018-2024 Localzet Group
 * @license     https://mit-license.org MIT
 */

return [
    '' => [\app\middleware\CORS::class],
    'api' => [\app\api\middleware\AuthGuarder::class]
];