<?php

namespace MythicalDash\Cli\Commands;

use MythicalDash\Cli\CommandBuilder;
use MythicalDash\Cli\App;


class Help extends App implements CommandBuilder
{

    /**
     * @inheritDoc
     */
    public static function execute(array $args): void
    {
        $cmdInstance = self::getInstance();
        $cmdInstance->send($cmdInstance->bars);
        $cmdInstance->send("&5&lMythical&d&lDash &7- &d&lHelp");
        $cmdInstance->send("");

        $commands = scandir(__DIR__);

        foreach ($commands as $command) {
            if ($command === '.' || $command === '..' || $command === 'Command.php') {
                continue;
            }

            $command = str_replace('.php', '', $command);
            $commandClass = "MythicalDash\\Cli\\Commands\\$command";
            $commandFile = __DIR__ . "/$command.php";

            require_once $commandFile;
    
            if (!class_exists($commandClass)) {
                return;
            }
    
            $description = $commandClass::getDescription();
            $command = lcfirst($command);

            $cmdInstance->send("&b{$command} &8> &7{$description}");
        }
        $cmdInstance->send("");
        $cmdInstance->send($cmdInstance->bars);
    }
    /**
     * @inheritDoc
     */
    public static function getDescription(): string
    {
        return "Get help for all commands";
    }
    /**
     * @inheritDoc
     */
    public static function getSubCommands(int $index): array
    {
        return [];
    }
}