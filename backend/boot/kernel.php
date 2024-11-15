<?php
/**
 * This file is loaded by the framework before the application is started.
 */


try {
    if (file_exists(APP_DIR . '/storage/packages')) {
        require APP_DIR . '/storage/packages/autoload.php';
    } else {
        throw new Exception('Packages not installed');
    }
} catch (Exception $e) {
    echo $e->getMessage();
    exit;
}


ini_set('expose_php', 'off');
header_remove('X-Powered-By');
header_remove('Server');


if (!is_writable(__DIR__)) {
    die('Please make sure the root directory is writable.');
}

if (!is_writable(__DIR__ . '/../storage')) {
    die('Please make sure the storage directory is writable.');
}

if (!extension_loaded('mysqli')) {
    die('MySQL extension is not installed!');
}

if (!extension_loaded('curl')) {
    die('Curl extension is not installed!');
}

if (!extension_loaded('gd')) {
    die('GD extension is not installed!');
}

if (!extension_loaded('mbstring')) {
    die('MBString extension is not installed!');
}

if (!extension_loaded('openssl')) {
    die('OpenSSL extension is not installed!');
}

if (!extension_loaded('zip')) {
    die('Zip extension is not installed!');
}

if (!extension_loaded('bcmath')) {
    die('Bcmath extension is not installed!');
}

if (!extension_loaded('json')) {
    die('JSON extension is not installed!');
}

if (!extension_loaded('sodium')) {
    die('sodium extension is not installed!');
}
if (version_compare(PHP_VERSION, '8.1.0', '<')) {
    die('This application requires at least PHP 8.1.0');
}