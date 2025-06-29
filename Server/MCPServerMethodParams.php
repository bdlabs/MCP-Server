<?php

/**
 * Author: Łukasz Koc <lukasz.koc@rawlplug.com>
 * Date: 28.06.2025
 * Time: 15:30
 */

namespace MCP\Server;

use MCP\Server\Registry\ToolRegistry;

readonly class MCPServerMethodParams
{
    public function __construct(
        public ToolRegistry $toolRegistry,
        public int $id,
        public array $params
    ) {
    }
}