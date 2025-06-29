<?php

namespace MCP\Server\Tool;

use MCP\Tools\Response\ToolResponsable;

interface ToolInterface
{
    /**
     * Zwraca nazwę narzędzia
     */
    public function getName(): string;

    /**
     * Zwraca pełną konfigurację narzędzia zgodną z MCP
     */
    public function getConfig(): array;

    /**
     * Wykonuje operację narzędzia
     */
    public function execute(array $params): ToolResponsable;
}
