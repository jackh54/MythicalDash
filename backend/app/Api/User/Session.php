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
use MythicalClient\Chat\Roles;
use MythicalClient\Chat\Billing;
use MythicalClient\Chat\Session;
use MythicalClient\Chat\columns\UserColumns;

$router->post('/api/user/session', function (): void {
    App::init();
    $appInstance = App::getInstance(true);
    $config = $appInstance->getConfig();

    $appInstance->allowOnlyPOST();
    $session = new Session($appInstance);

});

$router->post('/api/user/session/billing/update', function (): void {
    App::init();
    $appInstance = App::getInstance(true);
    $config = $appInstance->getConfig();

    $appInstance->allowOnlyPOST();
    $session = new Session($appInstance);

    try {
        if (!isset($_POST['company_name']) && $_POST['company_name'] == '') {
            $appInstance->BadRequest('Company name is missing!', ['error_code' => 'COMPANY_NAME_MISSING']);
        }
        $companyName = $_POST['company_name'];
        if (!isset($_POST['vat_number']) && $_POST['vat_number'] == '') {
            $appInstance->BadRequest('VAT Number is missing!', ['error_code' => 'VAT_NUMBER_MISSING']);
        }
        $vatNumber = $_POST['vat_number'];
        if (!isset($_POST['address1']) && $_POST['address1'] == '') {
            $appInstance->BadRequest('Address 1 is missing', ['error_code' => 'ADDRESS1_MISSING']);
        }
        $address1 = $_POST['address1'];
        if (!isset($_POST['address2']) && $_POST['address2'] == '') {
            $appInstance->BadRequest('Address 2 is missing', ['error_code' => 'ADDRESS2_MISSING']);
        }
        $address2 = $_POST['address2'];
        if (!isset($_POST['city']) && $_POST['city'] == '') {
            $appInstance->BadRequest('City is missing', ['error_code' => 'CITY_MISSING']);
        }
        $city = $_POST['city'];
        if (!isset($_POST['country']) && $_POST['country'] == '') {
            $appInstance->BadRequest('Country is missing', ['error_code' => 'COUNTRY_MISSING']);
        }
        $country = $_POST['country'];
        if (!isset($_POST['state']) && $_POST['state'] == '') {
            $appInstance->BadRequest('State is missing', ['error_code' => 'STATE_MISSING']);
        }
        $state = $_POST['state'];
        if (!isset($_POST['postcode']) && $_POST['postcode'] == '') {
            $appInstance->BadRequest('PostCode is missing', ['error_code' => 'POSTCODE_MISSING']);
        }
        $postcode = $_POST['postcode'];

        Billing::updateBilling(
            $session->getInfo(UserColumns::UUID, false),
            $companyName,
            $vatNumber,
            $address1,
            $address2,
            $city,
            $country,
            $state,
            $postcode
        );

        $appInstance->OK('Billing info saved successfully!', []);
    } catch (Exception $e) {
        $appInstance->getLogger()->error('Failed to save billing info! ' . $e->getMessage());
        $appInstance->BadRequest('Bad Request', ['error_code' => 'DB_ERROR', 'error' => $e->getMessage()]);
    }
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
            'billing' => $billing,
        ]);
    } catch (Exception $e) {
        $appInstance->BadRequest('Bad Request', ['error_code' => 'INVALID_ACCOUNT_TOKEN', 'error' => $e->getMessage()]);
    }

});
