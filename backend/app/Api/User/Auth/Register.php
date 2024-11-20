<?php

/*
 * This file is part of MythicalClient.
 * Please view the LICENSE file that was distributed with this source code.
 *
 * MIT License
 *
 * (c) MythicalSystems <mythicalsystems.xyz> - All rights reserved
 * (c) NaysKutzu <nayskutzu.xyz> - All rights reserved
 * (c) Cassian Gherman <nayskutzu.xyz> - All rights reserved
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

use MythicalClient\App;
use MythicalClient\Config\ConfigInterface;

$router->add('/api/user/auth/register', function (): void {
    App::init();
    $appInstance = App::getInstance(true);
    $config = $appInstance->getConfig();
    session_start();
    $csrf = new MythicalSystems\Utils\CSRFHandler('csrf', 'csrf');
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $data = [];

        $data['csrf'] = $csrf->string('csrf');

        if ($appInstance->getConfig()->getSetting(ConfigInterface::TURNSTILE_ENABLED, 'false') == 'true') {
            $data['turnstile']['enabled'] = true;
        } else {
            $data['turnstile']['enabled'] = false;
        }

        App::OK('Go Ahed', [
            'register' => $data,
        ]);
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

        /**
         * Validate the CSRF token.
         *
         * @var bool
         */
        if (!$csrf->validate('csrf')) {
            $appInstance->BadRequest('Bad Request', ['error_code' => 'INVALID_CSRF_TOKEN']);
        }

        /**
         * Check if the required fields are set.
         *
         * @var string
         */
        if (!isset($_POST['firstName']) || $_POST['firstName'] == '') {
            $appInstance->BadRequest('Bad Request', ['error_code' => 'MISSING_FIRST_NAME']);
        }
        if (!isset($_POST['lastName']) || $_POST['lastName'] == '') {
            $appInstance->BadRequest('Bad Request', ['error_code' => 'MISSING_LAST_NAME']);
        }
        if (!isset($_POST['email']) || $_POST['email'] == '') {
            $appInstance->BadRequest('Bad Request', ['error_code' => 'MISSING_EMAIL']);
        }

        if (!isset($_POST['password']) || $_POST['password'] == '') {
            $appInstance->BadRequest('Bad Request', ['error_code' => 'MISSING_PASSWORD']);
        }

        if (!isset($_POST['username']) || $_POST['username'] == '') {
            $appInstance->BadRequest('Bad Request', ['error_code' => 'MISSING_USERNAME']);
        }
        /**
         * Process the turnstile response.
         *
         * IF the turnstile is enabled
         */
        if ($appInstance->getConfig()->getSetting(ConfigInterface::TURNSTILE_ENABLED, 'false') == 'true') {
            if (!isset($_POST['cf-turnstile-response']) || $_POST['cf-turnstile-response'] == '') {
                $appInstance->BadRequest('Bad Request', ['error_code' => 'MISSING_TURNSTILE']);
            }
        }

    } else {
        $appInstance->MethodNotAllowed('Method not allowed', ['request_method' => $_SERVER['REQUEST_METHOD']]);
    }

});
