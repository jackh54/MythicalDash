<?php

/*
 * This file is part of MythicalClient.
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

namespace MythicalClient\Plugins;

class PluginCompiler
{
    public string $plugins_dir = __DIR__ . '/../../storage/addons';

    public function __construct()
    {
        foreach ($this->getPluginsName() as $pluginName) {
            new PluginReader($pluginName);
        }
    }

    /**
     * Get all the plugins name.
     *
     * @return array The plugins name
     */
    public function getPluginsName(): array
    {
        $plugins = [];
        $directories = scandir($this->plugins_dir);
        foreach ($directories as $directory) {
            if ($directory === '.' || $directory === '..') {
                continue;
            }
            $pluginPath = $this->plugins_dir . '/' . $directory;
            if (is_dir($pluginPath) && file_exists($pluginPath . '/MythicalClient.yml')) {
                $plugins[] = basename($directory);
            }
        }

        return $plugins;
    }
}
