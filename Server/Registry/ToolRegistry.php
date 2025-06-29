<?php

namespace MCP\Server\Registry;

use MCP\Server\Tool\ToolInterface;

class ToolRegistry
{
    private array $tools = [];

    public function register(ToolInterface $tool): void
    {
        $name = $tool->getName();
        $this->tools[$name] = $tool;
    }

    public function getTool(string $name): ?ToolInterface
    {
        return $this->tools[$name] ?? null;
    }

    public function getAllTools(): array
    {
        return $this->tools;
    }

    public function getAllToolConfigs(): array
    {
        $configs = [];
        foreach ($this->tools as $name => $tool) {
            $configs[] = $tool->getConfig();
        }

        return $configs;
    }
}
