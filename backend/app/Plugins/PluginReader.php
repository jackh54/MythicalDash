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

namespace MythicalDash\Plugins;

use MythicalDash\App;
use MythicalDash\Plugins\utils\PluginConfigReader;

class PluginReader
{
    public string $path;
    public string $name;

    public App $app;

    public function __construct(string $path)
    {
        $this->app = App::getInstance(true);
        $this->name = $path;
        $this->path = APP_ADDONS_DIR . '/' . $path;

        if ($this->exists()) {
            if ($this->configExist()) {
                if ($this->processRequiredValues()) {

                } else {
                    $this->app->getLogger()->error('Plugin at path: ' . $this->path . ' is missing required values.');
                }
            } else {
                $this->app->getLogger()->error('Plugin config not found at path: ' . $this->path);
            }
        } else {
            $this->app->getLogger()->error('Plugin not found at path: ' . $this->path);
        }
    }

    /**
     * Does the plugin config exist?
     */
    private function configExist(): bool
    {
        return file_exists($this->path . '/MythicalDash.yml');
    }

    /**
     * Does the plugin exist?
     *
     * @return bool
     */
    private function exists()
    {
        return file_exists($this->path);
    }

    /**
     * Get the value of the config.
     *
     * @return PluginConfigReader The value of the config
     */
    private function getConfig(): PluginConfigReader
    {
        return new PluginConfigReader($this->path . '/MythicalDash.yml');
    }

    /**
     *  Get the required values for the plugin.
     *
     * @return array The required values for the plugin
     */
    private function requiredValuesString(): array
    {
        return [
            'Plugin.name',
            'Plugin.description',
            'Plugin.identifier',
            'Plugin.stability',
        ];
    }

    /**
     * Get the required values for the plugin.
     */
    private function requiredValuesInt(): array
    {
        return [
            'Plugin.version',
        ];
    }

    /**
     * Get the required values for the plugin.
     */
    private function requiredValuesArray(): array
    {
        return [
            'Plugin.flags',
            'Plugin.authors',
            'Plugin.requirements',
        ];
    }

    /**
     * Process the required values for the plugin.
     */
    private function processRequiredValues(): bool
    {
        foreach ($this->requiredValuesString() as $value) {
            $awnserString = $this->getConfig()->getString($value);
            if (!is_string($awnserString) || strlen($awnserString) === 0) {
                $this->app->getLogger()->error("Required config value '{$value}' is not set or is empty in plugin at path: " . $this->path . ' got: ' . $awnserString);

                return false;
            }
            foreach ($this->requiredValuesArray() as $value) {
                $awnserArray = $this->getConfig()->getArray($value);
                if (!is_array($awnserArray) || count($awnserArray) === 0) {
                    $this->app->getLogger()->error("Required config value '{$value}' is not set or is empty in plugin at path: " . $this->path . ' got: ' . $awnserArray);

                    return false;
                }
                foreach ($this->requiredValuesInt() as $value) {
                    $awnserInt = $this->getConfig()->getInt($value);
                    if (!is_int($awnserInt) || $awnserInt <= 0) {
                        $this->app->getLogger()->error("Required config value '{$value}' is not set or is invalid in plugin at path: " . $this->path . ' got: ' . $awnserInt);

                        return false;
                    }
                }
            }
        }

        return true;
    }
}
