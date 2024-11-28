<?php


use MythicalClient\App;
use MythicalClient\Chat\User;
use MythicalClient\Mail\Mail;
use MythicalSystems\CloudFlare\Turnstile;
use MythicalClient\Config\ConfigInterface;
use MythicalSystems\CloudFlare\CloudFlare;
use MythicalClient\Chat\columns\UserColumns;

$router->get('/api/user/auth/logout', function (): void {
    echo '<script>
        localStorage.clear();
        sessionStorage.clear();
    </script>';
    try {
        setcookie('user_token', '', time() - 460800 * 460800 * 460800, '/');
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_unset();
            session_destroy();
        }

        header('location: /auth/login?href=api');
        exit;
    } catch (Exception $e) {
        App::getInstance(true)->getLogger()->error('Failed to logout user' . $e->getMessage());
        header('location: /auth/login?href=api');
    }
});