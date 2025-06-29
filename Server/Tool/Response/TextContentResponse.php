<?php
/**
 * Author: Łukasz Koc <lukasz.koc@rawlplug.com>
 * Date: 28.06.2025
 * Time: 00:32
 */

namespace MCP\Tool\Response;

/**
 * Class TextContent
 *
 * @package MCP\Response
 */
readonly class TextContentResponse implements ToolResponsable
{
    public function __construct(private string $text)
    {
    }

    public function response(): array
    {
        return [
            'type' => 'text',
            'text' => $this->text,
        ];
    }
}