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

namespace MythicalDash\Cli\Commands;

use MythicalDash\Cli\App;
use MythicalDash\Cli\CommandBuilder;

class Up extends App implements CommandBuilder
{
    public static function execute(array $args): void
    {
        $app = App::getInstance();
        if (file_exists(__DIR__ . '/../../../storage/caches/maintenance.php')) {
            unlink(__DIR__ . '/../../../storage/caches/maintenance.php');
            $app->send('&aThe server is no longer in maintenance mode!');
            \MythicalDash\App::getInstance(true)->getLogger()->info('The server is no longer in maintenance mode!');
            exit;
        }
        \MythicalDash\App::getInstance(true)->getLogger()->error('The server is not in maintenance mode!');
        $app->send('&cThe server is not in maintenance mode!');
        exit;

    }

    public static function getDescription(): string
    {
        return 'Remove the server from maintenance mode';
    }

    public static function getSubCommands(int $index): array
    {
        return [];
    }
}
