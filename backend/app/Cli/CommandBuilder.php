<?php
namespace MythicalDash\Cli;

interface CommandBuilder
{
    /**
     * The description of the command.
     * 
     * @var string
     */
    public static function getDescription(): string;
    /**
     * 
     * The subcommands of the command.
     * 
     * @return array
     */
    public static function getSubCommands(int $index): array;

    
    /**
     * Execute the command.
     *
     * @param array $args the arguments passed to the command
     */
    public static function execute(array $args): void;
}