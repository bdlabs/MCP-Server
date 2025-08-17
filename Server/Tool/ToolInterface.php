<?php

namespace MCP\Server\Tool;

use MCP\Server\Tool\Response\ToolResponsable;

/**
 * Interface ToolInterface
 *
 * @package MCP\Server\Tool
 */
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
