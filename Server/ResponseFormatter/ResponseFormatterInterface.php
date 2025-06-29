<?php

/**
 * Author: Łukasz Koc <lukasz.koc@rawlplug.com>
 * Date: 29.06.2025
 * Time: 01:20
 */

namespace MCP\Server\ResponseFormatter;

interface ResponseFormatterInterface
{
    public function formatAndSendResponse(array $response): void;
}