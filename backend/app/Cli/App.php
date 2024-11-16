<?php

/*
 * This file is part of MythicalDash.
 * Please view the LICENSE file that was distributed with this source code.
 *
 * MIT License
 *
 * (c) MythicalSystems <mythicalsystems.xyz> - All rights reserved
 * (c) NaysKutzu <nayskutzu.xyz> - All rights reserved
 * (c) Cassian Gherman <nayskutzu.xyz> - All rights reserved
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace MythicalDash\Cli;

class App extends \MythicalSystems\Utils\BungeeChatApi
{
    public $prefix = '&7[&5&lMythical&d&lDash&7] &8&l| &7';
    public $bars = '&7&m-----------------------------------------------------&r';
    public static App $instance;

    public function __construct(string $commandName, array $args)
    {
        self::$instance = $this;

        $commandName = ucfirst($commandName);
        $commandFile = __DIR__ . "/Commands/$commandName.php";

        if (!file_exists($commandFile)) {
            self::send('Command not found.');

            return;
        }

        require_once $commandFile;

        $commandClass = "MythicalDash\\Cli\\Commands\\$commandName";

        if (!class_exists($commandClass)) {
            self::send('Command not found.');

            return;
        }

        $commandClass::execute($args);
    }

    /**
     * Send a message to the console.
     *
     * @param string $message the message to send
     */
    public function send(string $message): void
    {
        self::sendOutputWithNewLine($this->prefix . $message);
    }

    /**
     * Get the instance of the App.
     */
    public static function getInstance(): App
    {
        return self::$instance;
    }
}
