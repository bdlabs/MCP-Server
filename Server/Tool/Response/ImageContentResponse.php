<?php

namespace MCP\Tools\Response;

class ImageContentResponse implements ToolResponsable
{
    protected string $type = 'image';

    /**
     * @param string $data Dane obrazu zakodowane w base64
     * @param string $mimeType Typ MIME obrazu (np. image/jpeg)
     */
    public function __construct(private readonly string $data, private readonly string $mimeType)
    {
    }

    ///**
    // * Tworzy odpowiedź z obrazem na podstawie ścieżki do pliku
    // */
    //public static function fromFile(string $filePath): self
    //{
    //    if (!file_exists($filePath)) {
    //        throw new \InvalidArgumentException("Plik $filePath nie istnieje");
    //    }
    //
    //    $data = base64_encode(file_get_contents($filePath));
    //    $mimeType = mime_content_type($filePath) ?: 'image/jpeg';
    //
    //    return new self($data, $mimeType);
    //}

    public function response(): array
    {
        return [
            'type' => $this->type,
            'data' => $this->data,
            'mimeType' => $this->mimeType
        ];
    }
}