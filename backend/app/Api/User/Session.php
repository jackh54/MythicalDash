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
use MythicalClient\Chat\Billing;
use MythicalClient\Chat\User;
use MythicalClient\Chat\Roles;
use MythicalClient\Chat\columns\UserColumns;
use MythicalClient\Chat\Session;

$router->post('/api/user/session', function (): void {
    App::init();
    $appInstance = App::getInstance(true);
    $config = $appInstance->getConfig();

    $appInstance->allowOnlyPOST();
    $session = new Session($appInstance);


});

$router->get('/api/user/session', function (): void {
    App::init();
    $appInstance = App::getInstance(true);
    $config = $appInstance->getConfig();

    $appInstance->allowOnlyGET();
    $session = new Session($appInstance);
    $accountToken = $session->SESSION_KEY;
    try {
        $billing = Billing::getBillingData(User::getInfo($accountToken, UserColumns::UUID, false));
        $appInstance->OK('Account token is valid', [
            'user_info' => [
                'username' => User::getInfo($accountToken, UserColumns::USERNAME, false),
                'email' => User::getInfo($accountToken, UserColumns::EMAIL, false),
                'verified' => User::getInfo($accountToken, UserColumns::VERIFIED, false),
                'banned' => User::getInfo($accountToken, UserColumns::BANNED, false),
                '2fa_blocked' => User::getInfo($accountToken, UserColumns::TWO_FA_BLOCKED, false),
                '2fa_enabled' => User::getInfo($accountToken, UserColumns::TWO_FA_ENABLED, false),
                '2fa_secret' => User::getInfo($accountToken, UserColumns::TWO_FA_KEY, false),
                'first_name' => User::getInfo($accountToken, UserColumns::FIRST_NAME, true),
                'last_name' => User::getInfo($accountToken, UserColumns::LAST_NAME, true),
                'avatar' => User::getInfo($accountToken, UserColumns::AVATAR, false),
                'uuid' => User::getInfo($accountToken, UserColumns::UUID, false),
                'role_id' => User::getInfo($accountToken, UserColumns::ROLE_ID, false),
                'first_ip' => User::getInfo($accountToken, UserColumns::FIRST_IP, false),
                'last_ip' => User::getInfo($accountToken, UserColumns::LAST_IP, false),
                'deleted' => User::getInfo($accountToken, UserColumns::DELETED, false),
                'last_seen' => User::getInfo($accountToken, UserColumns::LAST_SEEN, false),
                'first_seen' => User::getInfo($accountToken, UserColumns::FIRST_SEEN, false),
                'background' => User::getInfo($accountToken, UserColumns::BACKGROUND, true),
                'role_name' => Roles::getUserRoleName(User::getInfo($accountToken, UserColumns::UUID, false)),
                'role_real_name' => Roles::getUserRoleName(User::getInfo($accountToken, UserColumns::UUID, false)),
            ],
            'billing' => $billing
        ]);
    } catch (Exception $e) {
        $appInstance->BadRequest('Bad Request', ['error_code' => 'INVALID_ACCOUNT_TOKEN', 'error' => $e->getMessage()]);
    }

});
