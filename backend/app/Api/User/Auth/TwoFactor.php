<?php
use MythicalClient\App;
use MythicalClient\Chat\columns\EmailVerificationColumns;
use MythicalClient\Chat\columns\UserColumns;
use MythicalClient\Chat\User;
use MythicalClient\Chat\Verification;
use MythicalSystems\CloudFlare\Turnstile;
use MythicalClient\Config\ConfigInterface;
use MythicalSystems\CloudFlare\CloudFlare;
use MythicalSystems\Utils\XChaCha20;
use PragmaRX\Google2FA\Google2FA;

$router->get("/api/user/auth/2fa/setup", function (): void {
    App::init();
    $appInstance = App::getInstance(true);
    $config = $appInstance->getConfig();

    $appInstance->allowOnlyGET();
    $google2fa = new Google2FA();

    $secret = $google2fa->generateSecretKey();

    $appInstance->OK('Successfully generated secret key', ['secret' => $secret]);
});