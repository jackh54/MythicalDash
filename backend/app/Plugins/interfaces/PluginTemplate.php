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

namespace MythicalClient\Plugins\interfaces;

use MythicalClient\Plugins\PluginEvent;

/**
 * Interface PluginTemplate.
 *
 * This interface defines the structure for plugin lifecycle events.
 */
interface PluginTemplate
{
    /**
     * Handle a plugin event.
     *
     * @param PluginEvent $event the event to handle
     *
     * @return void
     */
    public function Event(PluginEvent $event);

    /**
     * Called when the plugin is enabled.
     *
     * @return void
     */
    public function onEnable();

    /**
     * Called when the plugin is disabled.
     *
     * @return void
     */
    public function onDisable();

    /**
     * Called when the plugin is installed.
     *
     * @return void
     */
    public function onInstall();

    /**
     * Called when the plugin is uninstalled.
     *
     * @return void
     */
    public function onUninstall();
}
