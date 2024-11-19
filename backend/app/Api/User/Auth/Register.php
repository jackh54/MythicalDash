<?php

use MythicalDash\App;
use MythicalDash\Config\ConfigFactory;
use MythicalDash\Config\ConfigInterface;



$router->add('/api/user/auth/register', function (): void {
    App::init();
    $appInstance = App::getInstance(true);
    $config = $appInstance->getConfig();
    session_start();
    $csrf = new MythicalSystems\Utils\CSRFHandler('csrf', 'csrf');
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $data = [];

        $data['csrf'] = $csrf->string('csrf');

        if ($appInstance->getConfig()->getSetting(ConfigInterface::TURNSTILE_ENABLED, "false") == "true") {
            $data['turnstile']['enabled'] = true;
        } else {
            $data['turnstile']['enabled'] = false;
        }

        App::OK('Go Ahed', [
            "register" => $data
        ]);
    } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        /**
         * Validate the CSRF token
         * 
         * @var bool
         */
        if (!$csrf->validate('csrf')) {
            $appInstance->BadRequest("Bad Request", ["error_code" => "INVALID_CSRF_TOKEN"]);
        }

        /**
         * Check if the required fields are set
         * 
         * @var string
         */
        if (!isset($_POST['firstName']) || $_POST['firstName'] == "") {
            $appInstance->BadRequest("Bad Request", ["error_code" => "MISSING_FIRST_NAME"]);
        }
        if (!isset($_POST["lastName"]) || $_POST["lastName"] == "") {
            $appInstance->BadRequest("Bad Request", ["error_code" => "MISSING_LAST_NAME"]);
        }
        if (!isset($_POST["email"]) || $_POST["email"] == "") {
            $appInstance->BadRequest("Bad Request", ["error_code" => "MISSING_EMAIL"]);
        }

        if (!isset($_POST["password"]) || $_POST["password"] == "") {
            $appInstance->BadRequest("Bad Request", ["error_code" => "MISSING_PASSWORD"]);
        }

        if (!isset($_POST["username"]) || $_POST["username"] == "") {
            $appInstance->BadRequest("Bad Request", ["error_code" => "MISSING_USERNAME"]);
        }
        /**
         * Process the turnstile response
         * 
         * IF the turnstile is enabled
         */
        if ($appInstance->getConfig()->getSetting(ConfigInterface::TURNSTILE_ENABLED, "false") == "true") {
            if (!isset($_POST["cf-turnstile-response"]) || $_POST["cf-turnstile-response"] == "") {
                $appInstance->BadRequest("Bad Request", ["error_code" => "MISSING_TURNSTILE"]);
            }
        }

        

    } else {
        $appInstance->MethodNotAllowed("Method not allowed", ["request_method" => $_SERVER['REQUEST_METHOD']]);
    }

});



