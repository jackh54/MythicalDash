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
use MythicalClient\Chat\User;
use MythicalClient\Mail\Mail;
use MythicalSystems\CloudFlare\Turnstile;
use MythicalClient\Config\ConfigInterface;
use MythicalSystems\CloudFlare\CloudFlare;
use MythicalClient\Chat\columns\UserColumns;

$router->add('/api/user/auth/login', function (): void {
    $appInstance = App::getInstance(true);
    $config = $appInstance->getConfig();

    $appInstance->allowOnlyPOST();

    /**
     * Check if the required fields are set.
     *
     * @var string
     */
    if (!isset($_POST['login']) || $_POST['login'] == '') {
        $appInstance->BadRequest('Bad Request', ['error_code' => 'MISSING_LOGIN']);
    }

    if (!isset($_POST['password']) || $_POST['password'] == '') {
        $appInstance->BadRequest('Bad Request', ['error_code' => 'MISSING_PASSWORD']);
    }

    /**
     * Process the turnstile response.
     *
     * IF the turnstile is enabled
     */
    if ($appInstance->getConfig()->getSetting(ConfigInterface::TURNSTILE_ENABLED, 'false') == 'true') {
        if (!isset($_POST['turnstileResponse']) || $_POST['turnstileResponse'] == '') {
            $appInstance->BadRequest('Bad Request', ['error_code' => 'TURNSTILE_FAILED']);
        }
        $cfTurnstileResponse = $_POST['turnstileResponse'];
        if (!Turnstile::validate($cfTurnstileResponse, CloudFlare::getRealUserIP(), $config->getSetting(ConfigInterface::TURNSTILE_KEY_PRIV, 'XXXX'))) {
            $appInstance->BadRequest('Invalid TurnStile Key', ['error_code' => 'TURNSTILE_FAILED']);
        }
    }
    $login = $_POST['login'];
    $password = $_POST['password'];

    $login = User::login($login, $password);
    $token = $_COOKIE['user_token'];
    if ($login) {
        if ($token == "") {
            $appInstance->BadRequest('Something behind went wrong!', ['error_code' => 'LOGIC_ERROR']);
        }
        if (User::getInfo($_COOKIE['user_token'], UserColumns::VERIFIED, false) == 'false') {
            if (Mail::isEnabled() == true) {
                setcookie('user_token', '', time() - 123600, '/');
                $appInstance->BadRequest('Account not verified', ['error_code' => 'ACCOUNT_NOT_VERIFIED']);
            }
        }

        if (User::getInfo($_COOKIE['user_token'], UserColumns::BANNED, false) != 'NO') {
            setcookie('user_token', '', time() - 123600, '/');
            $appInstance->BadRequest('Account is banned', ['error_code' => 'ACCOUNT_BANNED']);
        }

        if (User::getInfo($_COOKIE['user_token'], UserColumns::DELETED, false) == 'true') {
            setcookie('user_token', '', time() - 123600, '/');
            $appInstance->BadRequest('Account is deleted', ['error_code' => 'ACCOUNT_DELETED']);
        }
        $appInstance->OK('Successfully logged in', []);
    } else {
        $appInstance->BadRequest('Invalid login credentials', ['error_code' => 'INVALID_CREDENTIALS']);
    }
});
