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

namespace MythicalClient\Plugins\utils;

use Symfony\Component\Yaml\Yaml;

class PluginConfigReader
{
    public string $file;

    /**
     * The PluginConfigReader!
     *
     * @param string $file The file to read
     *
     * @throws \Exception If the file is not found
     */
    public function __construct(string $file)
    {
        $this->file = $file;
        if (file_exists($this->file)) {
            $this->checkSyntax();

        } else {
            throw new \Exception("File '$file' not found.");
        }
    }

    /**
     * Get a string.
     *
     * @param string $key key
     *
     * @return string|null The string value
     */
    public function getString(string $key): string
    {
        $yaml = Yaml::parseFile($this->file);
        $keys = explode('.', $key);
        $value = $yaml;
        foreach ($keys as $part) {
            if (isset($value[$part])) {
                $value = $value[$part];
            } else {
                return null;
            }
        }

        return $value;
    }

    /**
     * Get an integer.
     *
     * @param string $key key
     *
     * @return int|null The integer value
     */
    public function getInt(string $key): ?int
    {
        $yaml = Yaml::parseFile($this->file);
        $keys = explode('.', $key);
        $value = $yaml;
        foreach ($keys as $part) {
            if (isset($value[$part])) {
                $value = $value[$part];
            } else {
                return null;
            }
        }

        return (int) $value;
    }

    /**
     * Get a boolean.
     *
     * @param string $key key
     *
     * @return bool|null The boolean value
     */
    public function getBool(string $key): ?bool
    {
        $yaml = Yaml::parseFile($this->file);
        $keys = explode('.', $key);
        $value = $yaml;
        foreach ($keys as $part) {
            if (isset($value[$part])) {
                $value = $value[$part];
            } else {
                return null;
            }
        }

        return $value;
    }

    /**
     * Get an array.
     *
     * @param string $key key
     *
     * @return array|null The array value
     */
    public function getArray(string $key): ?array
    {
        $yaml = Yaml::parseFile($this->file);
        $keys = explode('.', $key);
        $value = $yaml;
        foreach ($keys as $part) {
            if (isset($value[$part])) {
                $value = $value[$part];
            } else {
                return null;
            }
        }

        return $value;
    }

    /**
     * Get a value from the YAML file.
     *
     * @param string $key The key to get
     *
     * @return mixed The value
     */
    public function get(string $key): mixed
    {
        $yaml = Yaml::parseFile($this->file);
        $keys = explode('.', $key);
        $value = $yaml;
        foreach ($keys as $part) {
            if (isset($value[$part])) {
                $value = $value[$part];
            } else {
                return null;
            }
        }

        return $value;
    }

    /**
     * Set a value in the YAML file.
     *
     * @param string $key The key to set
     * @param mixed $value The value to set
     */
    public function set(string $key, mixed $value): void
    {
        $yaml = Yaml::parseFile($this->file);
        $keys = explode('.', $key);
        $value = $yaml;
        foreach ($keys as $part) {
            if (isset($value[$part])) {
                $value = $value[$part];
            } else {
                return;
            }
        }
        $yaml[$key] = $value;
        file_put_contents($this->file, Yaml::dump($yaml));
    }

    /**
     * Set a string.
     *
     * @param string $key key
     * @param string $value value
     */
    public function setString(string $key, string $value): void
    {
        $yaml = Yaml::parseFile($this->file);
        $keys = explode('.', $key);
        $value = $yaml;
        foreach ($keys as $part) {
            if (isset($value[$part])) {
                $value = $value[$part];
            } else {
                return;
            }
        }
        $yaml[$key] = $value;
        file_put_contents($this->file, Yaml::dump($yaml));
    }

    /**
     * Set an integer.
     *
     * @param string $key key
     * @param int $value value
     */
    public function setInt(string $key, int $value): void
    {
        $yaml = Yaml::parseFile($this->file);
        $keys = explode('.', $key);
        $value = $yaml;
        foreach ($keys as $part) {
            if (isset($value[$part])) {
                $value = $value[$part];
            } else {
                return;
            }
        }
        $yaml[$key] = $value;
        file_put_contents($this->file, Yaml::dump($yaml));
    }

    /**
     * Set a boolean.
     *
     * @param string $key key
     * @param bool $value value
     */
    public function setBool(string $key, bool $value): void
    {
        $yaml = Yaml::parseFile($this->file);
        $keys = explode('.', $key);
        $value = $yaml;
        foreach ($keys as $part) {
            if (isset($value[$part])) {
                $value = $value[$part];
            } else {
                return;
            }
        }
        $yaml[$key] = $value;
        file_put_contents($this->file, Yaml::dump($yaml));
    }

    /**
     * Set an array.
     *
     * @param string $key key
     * @param array $value value
     */
    public function setArray(string $key, array $value): void
    {
        $yaml = Yaml::parseFile($this->file);
        $keys = explode('.', $key);
        $value = $yaml;
        foreach ($keys as $part) {
            if (isset($value[$part])) {
                $value = $value[$part];
            } else {
                return;
            }
        }
        $yaml[$key] = $value;
        file_put_contents($this->file, Yaml::dump($yaml));
    }

    /**
     * Check the syntax of the file!
     *
     * @throws \Exception If the syntax is invalid
     */
    private function checkSyntax(): void
    {
        $yaml = Yaml::parseFile($this->file);
        if ($yaml == null) {
            throw new \Exception('Language file syntax is invalid!');
        }
    }
}
