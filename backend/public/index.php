<?php

use MythicalDash\App;

define("ENV_PATH", __DIR__ . "/../storage/");
define('APP_START', microtime(true));
define('APP_DIR', __DIR__ . '/..');


require_once APP_DIR . '/boot/kernel.php';

try {
    if (file_exists(ENV_PATH)) {
        $dotenv = Dotenv\Dotenv::createImmutable(ENV_PATH);
        $dotenv->load();
    } else {
        echo 'No .env file found';
        exit;
    }
} catch (Exception $e) {
    echo $e->getMessage();
    exit;
}

try {
    new App();
} catch (Exception $e) {
    echo $e->getMessage();
    exit;
}
