<?php

/**
 * Author: Łukasz Koc <lukasz.koc@rawlplug.com>
 * Date: 29.06.2025
 * Time: 01:21
 */

namespace MCP\Server\ResponseFormatter;

class JsonResponseFormatter implements ResponseFormatterInterface
{
    public function formatAndSendResponse(array $response): void
    {
        header('Content-Type: application/json');
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }
}
