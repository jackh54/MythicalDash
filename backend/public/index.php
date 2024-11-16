<?php
/**
 * MythicalDash - BOOTLOADER
 * 
 * This file is the entry point for the application.
 * 
 * @package MythicalDash
 * 
 * @version 1.0.0
 */
use MythicalDash\App;

/**
 * Define the environment path
 */
define("ENV_PATH", __DIR__ . "/../storage/");
define('APP_START', microtime(true));
define('APP_DIR', __DIR__ . '/..');
/**
 * Require the kernel
 */
require_once APP_DIR . '/boot/kernel.php';

/**
 * Start the APP
 */
try {
    new App(false);
} catch (Exception $e) {
    echo $e->getMessage();
    exit;
}
