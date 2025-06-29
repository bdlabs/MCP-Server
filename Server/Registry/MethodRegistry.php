<?php

/**
 * Author: Łukasz Koc <lukasz.koc@rawlplug.com>
 * Date: 28.06.2025
 * Time: 15:23
 */

namespace MCP\Server\Registry;

use MCP\Server\MCPServerMethodParams;

class MethodRegistry
{
    private $methods = [];

    public function register(string $methodName, callable $handler): void
    {
        $this->methods[$methodName] = $handler;
    }

    public function hasMethod(string $methodName): bool
    {
        return isset($this->methods[$methodName]);
    }

    public function execute(string $methodName, MCPServerMethodParams $methodParams): ?array
    {
        $handler = $this->methods[$methodName];

        return $handler($methodParams);
    }
}
