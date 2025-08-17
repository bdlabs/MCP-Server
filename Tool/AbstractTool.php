<?php

namespace MCP\Tool;

use MCP\Server\Tool\ToolInterface;
use MCP\Server\Tool\Response\ToolResponsable;

abstract class AbstractTool implements ToolInterface
{
    protected string $name;
    protected string $description;
    protected string $version = '1.0.0';
    protected bool $enabled = true;
    protected array $inputSchema = [];

    public function getName(): string
    {
        return $this->name;
    }

    public function getConfig(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'type' => 'http',
            'version' => $this->version,
            'enabled' => $this->enabled,
            'inputSchema' => $this->inputSchema,
        ];
    }

    abstract public function execute(array $params): ToolResponsable;
}
