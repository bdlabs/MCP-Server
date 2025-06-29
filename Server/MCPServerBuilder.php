<?php

/**
 * Author: Łukasz Koc <lukasz.koc@rawlplug.com>
 * Date: 28.06.2025
 * Time: 15:46
 */

namespace MCP\Server;

use MCP\Config;
use MCP\Server\Registry\MethodRegistry;
use MCP\Server\Registry\ToolRegistry;

class MCPServerBuilder
{
    public static function build(): MCPServer
    {
        $toolRegistry = new ToolRegistry();
        $methodRegistry = new MethodRegistry();

        self::registerTools($toolRegistry);
        self::registerMethods($methodRegistry);

        return new MCPServer(
            $methodRegistry,
            $toolRegistry
        );
    }

    /**
     * @param \MCP\Server\Registry\ToolRegistry $toolRegistry
     *
     * @return void
     */
    protected static function registerTools(ToolRegistry $toolRegistry): void
    {
        $toolRegistry->register(new \MCP\Tools\Registration\Tool());
        $toolRegistry->register(new \MCP\Tools\Demo01\Tool());
    }

    /**
     * @param \MCP\Server\Registry\MethodRegistry $methodRegistry
     *
     * @return void
     */
    protected static function registerMethods(MethodRegistry $methodRegistry): void
    {
        $methodRegistry->register('initialize', static function (MCPServerMethodParams $MCPServerMethodParams) {
            $toolConfigs = $MCPServerMethodParams->toolRegistry->getAllToolConfigs();

            return [
                'protocolVersion' => Config::PROTOCOL_VERSION,
                'tools' => $toolConfigs,
                'capabilities' => (object)[],
                'serverInfo' => [
                    'name' => Config::SERVER_NAME,
                    'version' => Config::SERVER_VERSION,
                ],
            ];
        });

        $methodRegistry->register('tools/call', static function (MCPServerMethodParams $MCPServerMethodParams) {
            $toolName = $MCPServerMethodParams->params['name'] ?? '';
            $toolArgs = $MCPServerMethodParams->params['arguments'] ?? [];
            $tool = $MCPServerMethodParams->toolRegistry->getTool($toolName);
            if (!$tool) {
                throw new \Exception("Tool not found: {$toolName}");
            }

            $result = $tool->execute($toolArgs);

            return ['content' => [$result->response()]];
        });

        $methodRegistry->register('notifications/initialized', static function (MCPServerMethodParams $MCPServerMethodParams) {
            return [
                'jsonrpc' => '2.0',
            ];
        });

        $methodRegistry->register('notifications/cancelled', static function (MCPServerMethodParams $MCPServerMethodParams) {
            return [
                'jsonrpc' => '2.0',
            ];
        });

        $methodRegistry->register('tools/list', static function (MCPServerMethodParams $MCPServerMethodParams) {
            $toolConfigs = $MCPServerMethodParams->toolRegistry->getAllToolConfigs();

            return [
                'tools' => $toolConfigs,
            ];
        });
    }
}