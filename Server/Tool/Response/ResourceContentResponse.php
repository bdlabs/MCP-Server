<?php
/**
 * Author: Łukasz Koc <lukasz.koc@rawlplug.com>
 * Date: 28.06.2025
 * Time: 00:48
 */

namespace MCP\Tools\Response;

class ResourceContentResponse implements ToolResponsable
{
    protected string $type = 'resource';
    /**
     * @param array $resource Obiekt zasobu
     */
    public function __construct(private readonly array $resource)
    {
    }

    public function response(): array
    {
        return [
            'type' => $this->type,
            'resource' => $this->resource
        ];
    }
}