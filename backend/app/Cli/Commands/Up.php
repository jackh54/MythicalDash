<?php

namespace MythicalDash\Cli\Commands;

use MythicalDash\Cli\CommandBuilder;


class Up implements CommandBuilder
{

    /**
     * @inheritDoc
     */
    public static function execute(array $args): void
    {
    }
    /**
     * @inheritDoc
     */
    public static function getDescription(): string
    {
        return "Remove the server from maintenance mode";
    }
    /**
     * @inheritDoc
     */
    public static function getSubCommands(int $index): array
    {
        return [];
    }
}