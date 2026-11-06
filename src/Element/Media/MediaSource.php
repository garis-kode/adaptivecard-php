<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Media;

use AdaptiveCards\Node;
use AdaptiveCards\Support\HasKey;

/**
 * Defines the source URL of a media stream. YouTube, Dailymotion, Vimeo, and Microsoft Stream URLs are supported.
 */
final class MediaSource extends Node
{
    use HasKey;

    public function __construct(?string $url = null, ?string $mimeType = null)
    {
        if ($url !== null) {
            $this->url($url);
        }
        if ($mimeType !== null) {
            $this->mimeType($mimeType);
        }
    }

    public static function make(?string $url = null, ?string $mimeType = null): self
    {
        return new self($url, $mimeType);
    }

    /**
     * The URL of the source.
     */
    public function url(string $url): self
    {
        return $this->set('url', $url);
    }

    /**
     * The MIME type of the source.
     */
    public function mimeType(string $mimeType): self
    {
        return $this->set('mimeType', $mimeType);
    }

    public function getType(): ?string
    {
        return null;
    }
}
