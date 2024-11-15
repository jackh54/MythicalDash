<?php

namespace MythicalDash\Cli\Commands;

use MythicalDash\Cli\CommandBuilder;


class Migrate implements CommandBuilder
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
        return "Migrate the database to the latest version";
    }
    /**
     * @inheritDoc
     */
    public static function getSubCommands(int $index): array
    {
        return [];
    }
}