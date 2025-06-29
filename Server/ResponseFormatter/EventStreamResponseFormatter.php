<?php

/**
 * Author: Łukasz Koc <lukasz.koc@rawlplug.com>
 * Date: 29.06.2025
 * Time: 01:21
 */

namespace MCP\Server\ResponseFormatter;

class EventStreamResponseFormatter implements ResponseFormatterInterface
{
    public function formatAndSendResponse(array $response): void
    {
        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');
        header('Connection: keep-alive');
        header('X-Accel-Buffering: no'); // Wyłącza buforowanie dla NGINX

        echo "data: " . json_encode($response, JSON_UNESCAPED_UNICODE) . "\n\n";
        ob_flush();
        flush();
    }
}
