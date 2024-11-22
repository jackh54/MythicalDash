<?php
use MythicalClient\App;
use MythicalClient\Chat\columns\UserColumns;
use MythicalClient\Chat\User;
use MythicalSystems\CloudFlare\Turnstile;
use MythicalClient\Config\ConfigInterface;
use MythicalSystems\CloudFlare\CloudFlare;

$router->add('/api/user/auth/forgot', function (): void { 
    $appInstance = App::getInstance(true);
    $config = $appInstance->getConfig();

    $appInstance->allowOnlyPOST();
        /**
     * Check if the required fields are set.
     *
     * @var string
     */
    if (!isset($_POST['email']) || $_POST['email'] == '') {
        $appInstance->BadRequest('Bad Request', ['error_code' => 'MISSING_EMAIL']);
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
    $email = $_POST['email'];

    if (User::exists(UserColumns::EMAIL, $email)) {
        $appInstance->OK('Email exists', []);
    } else {
        $appInstance->BadRequest('Email does not exist', ['error_code' => 'EMAIL_DOES_NOT_EXIST']);
    }

    
});
