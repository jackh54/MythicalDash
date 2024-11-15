<?php

namespace MythicalDash\Cli;

class App extends \MythicalSystems\Utils\BungeeChatApi {
    public $prefix = "&7[&5&lMythical&d&lDash&7] &8&l| &7";
    public $bars = "&7&m-----------------------------------------------------&r";
    public static App $instance;
        
    public function __construct(string $commandName, array $args) {
        self::$instance = $this;

        $commandName = ucfirst($commandName);
        $commandFile = __DIR__. "/Commands/$commandName.php";

        if (!file_exists($commandFile)) {
            self::send("Command not found.");
            return;
        }

        require_once $commandFile;

        $commandClass = "MythicalDash\\Cli\\Commands\\$commandName";

        if (!class_exists($commandClass)) {
            self::send("Command not found.");
            return;
        }

        $commandClass::execute($args);
    }


    /**
     * Send a message to the console.
     * 
     * @param string $message The message to send.
     * 
     * @return void   
     */
    public function send(string $message) : void  {
        self::sendOutputWithNewLine($this->prefix . $message);
    }   
    /**
     * Get the instance of the App.
     */
    public static function getInstance() : App {
        return self::$instance;
    }
}