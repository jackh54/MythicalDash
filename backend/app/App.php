<?php
namespace MythicalDash;

use MythicalDash\Chat\Database;
use Router\Router as rt;

class App extends \MythicalSystems\Api\Api
{
    public static App $instance;
    public Database $db;

    public function __construct(bool $softBoot)
    {        
        /**
         * Load the environment variables
         */
        $this->loadEnv();

        /**
         * Instance
         */
        self::$instance = $this;

        /**
         * Soft boot
         * 
         * If the soft boot is true, we do not want to initialize the database connection or the router.
         * 
         * This is usefull for commands or other things that do not require the database connection.
         * 
         * This is also a lite way to boot the application without initializing the database connection or the router!.
         */
        if ($softBoot) {
            return;
        }

        /**
         * Database Connection
         */
        try {
            $this->db = new Database( $_ENV['DATABASE_HOST'], $_ENV['DATABASE_DATABASE'], $_ENV['DATABASE_USER'], $_ENV['DATABASE_PASSWORD']);
        } catch (\Exception $e) {
            self::InternalServerError($e->getMessage(), null);
        }

        $router = new rt();
        $this->registerApiRoutes($router);

        try {
            $router->route();
        } catch (\Exception $e) {
            self::InternalServerError($e->getMessage(), null);
        }

    }

    /**
     * Register all api endpoints.
     * 
     * @param rt $router The router instance
     * 
     * @return void
     */
    public function registerApiRoutes(rt $router): void
    {
        $admin_folder = __DIR__ . '/../Api/Admin';
        $user_folder = __DIR__ . '/../Api/User';
        $system_folder = __DIR__ . '/../Api/System';

        $admin_files = scandir($admin_folder);
        $user_files = scandir($user_folder);
        $system_files = scandir($system_folder);

        foreach ($system_files as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            }
            $class = 'MythicalDash\Api\System\\' . str_replace('.php', '', $file);
            $class = new $class();
            $router->add($class->route, function () use ($class): void {
                self::init();
                $class->handleRequest();
            });
        }

        foreach ($admin_files as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            }
            $class = 'MythicalDash\Api\Admin\\' . str_replace('.php', '', $file);
            $class = new $class();
            $router->add($class->route, function () use ($class): void {
                self::init();
                $class->handleRequest();
            });
        }

        foreach ($user_files as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            }
            $class = 'MythicalDash\Api\User\\' . str_replace('.php', '', $file);
            $class = new $class();
            $router->add($class->route, function () use ($class): void {
                self::init();
                $class->handleRequest();
            });
        }

        $router->add('/(.*)', function (): void {
            self::init();
            self::NotFound('The api route does not exist!', null);
        });
    }

    /**
     * Extracts the dynamic argument based on the route structure.
     *
     * @param string $route The route it should include (.*) if you are looking for a dynamic argument
     * @param int $aindex This is more like a game :) You need to guess the index of the dynamic argument
     *
     * @return string The dynamic argument
     *
     * For people who think they can optimize this function:
     *
     * I have tried my best to optimize this function as much as possible.
     * If you think you can optimize it further, please do so and create a pull request.
     * But if not make sure to increase the following line with the hours you wasted over here:
     *
     * @time 1 hour
     *
     * For the people who think they know what this function does:
     * You don't trust me on this one, do you? Well, I can assure you that this function is the best function you will ever see in your life.
     */
    public function getRouteArg(string $route, int $aindex = 1): string
    {
        // Break down the route and the current URI into their segments
        $routeParts = explode('/', trim($route, '/'));
        $uriParts = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));

        // Find the part of the URI that matches the "(.*)" in the route
        foreach ($routeParts as $index => $part) {
            if ($part === '(.*)') {
                // +1 cuz we have /api in front and the code does not know that we have that
                // so we need to adjust the index by 1 because of that so yeah do not increase the index by 1 or remove it
                // Doing that is gay! (no offense) Just kidding, but seriously do not do that.
                // I mean we can technically add /api before the $route up there in the code but that would be a waste of time
                // and we do not want to waste time, do we? Nahh we like wasting time on comments like those :)
                // So yeah, do not remove the +1 or increase the index by 1.
                $adjustedIndex = $index + $aindex;

                return $uriParts[$adjustedIndex] ?? '';
            }
        }

        return '';
    }
    /**
     * 
     * Load the environment variables
     * 
     * @return void
     */
    public function loadEnv() : void {
        try {
            if (file_exists(__DIR__.'/../storage/.env')) {
                $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__.'/../storage/');
                $dotenv->load();
            } else {
                echo 'No .env file found';
                exit;
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    /**
     * 
     * Get the instance of the App class
     * 
     * @return \MythicalDash\App
     */
    public static function getInstance(bool $softBoot): App
    {
        if (!isset(self::$instance)) {
            self::$instance = new self($softBoot);
        }
        return self::$instance;
    }
}