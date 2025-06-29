<?php
/**
 * Author: Łukasz Koc <lukasz.koc@rawlplug.com>
 * Date: 28.06.2025
 * Time: 00:47
 */

namespace MCP\Tools\Response;

class AudioContentResponse implements ToolResponsable
{
    private string $type = 'audio';

    /**
     * @param string $data Dane audio zakodowane w base64
     * @param string $mimeType Typ MIME audio (np. audio/mp3)
     */
    public function __construct(private readonly string $data, private readonly string $mimeType)
    {
    }

    ///**
    // * Tworzy odpowiedź audio na podstawie ścieżki do pliku
    // */
    //public static function fromFile(string $filePath): self
    //{
    //    if (!file_exists($filePath)) {
    //        throw new \InvalidArgumentException("Plik $filePath nie istnieje");
    //    }
    //
    //    $data = base64_encode(file_get_contents($filePath));
    //    $mimeType = mime_content_type($filePath) ?: 'audio/mpeg';
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