<?php

namespace MCP\Server;

use MCP\Server\Registry\MethodRegistry;
use MCP\Server\Registry\ToolRegistry;
use MCP\Server\ResponseFormatter\EventStreamResponseFormatter;
use MCP\Server\ResponseFormatter\JsonResponseFormatter;
use MCP\Server\ResponseFormatter\ResponseFormatterInterface;

readonly class MCPServer
{
    /** @var array<string, ResponseFormatterInterface> */
    private array $responseFormatters;

    public function __construct(
        private MethodRegistry $methodRegistry,
        private ToolRegistry $toolRegistry
    ) {
        $this->responseFormatters = [
            'text/event-stream' => new EventStreamResponseFormatter(),
            'application/json' => new JsonResponseFormatter(),
            // Tutaj można łatwo dodać kolejne formaty
        ];
    }

    /**
     * Przetwarza żądanie MCP
     */
    public function handleRequest(): void
    {
        $rawInput = file_get_contents('php://input');
        $request = json_decode($rawInput, true);
        $method = $request['method'] ?? null;
        $id = $request['id'] ?? 0;
        $params = $request['params'] ?? [];

        file_put_contents('a1.txt', json_encode($request) . PHP_EOL, FILE_APPEND);

        $mcpParams = new MCPServerMethodParams(
            $this->toolRegistry,
            $id,
            $params
        );

        if ($method && $this->methodRegistry->hasMethod($method)) {
            $this->sendResponse($id, $this->methodRegistry->execute($method, $mcpParams));

            return;
        }

        $this->sendError($id, $method . ': Method not found');
    }

    private function sendResponse(string $id, $result): void
    {
        $response = [
            'jsonrpc' => '2.0',
            'id' => $id,
            'result' => $result,
        ];

        $formatter = $this->getResponseFormatter();
        $formatter->formatAndSendResponse($response);

        file_put_contents('a1.txt', json_encode($response) . PHP_EOL, FILE_APPEND);
        // Ważne: opróżnij bufor wyjściowy, aby natychmiast wysłać dane
        ob_flush();
        flush();
    }

    /**
     * Wysyła błąd
     */
    private function sendError(string $id, string $message): void
    {
        $response = [
            'jsonrpc' => '2.0',
            'id' => $id,
            'error' => [
                'code' => -32000,
                'message' => $message,
            ],
        ];
        $formatter = $this->getResponseFormatter();
        $formatter->formatAndSendResponse($response);
    }

    private function getResponseFormatter(): ResponseFormatterInterface
    {
        $acceptHeader = $_SERVER['HTTP_ACCEPT'] ?? '';

        foreach (explode(',', $acceptHeader) as $acceptType) {
            $mediaType = trim(explode(';', $acceptType)[0]);

            if (isset($this->responseFormatters[$mediaType])) {
                return $this->responseFormatters[$mediaType];
            }
        }

        // Domyślny format, gdy żaden pasujący nie został znaleziony
        return $this->responseFormatters['application/json'];
    }
}
