<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Media;

use AdaptiveCards\Node;

/**
 * Defines a source URL for a video captions.
 */
final class CaptionSource extends Node
{
    public function __construct(string $url, string $mimeType, string $label)
    {
        $this->url($url);
        $this->mimeType($mimeType);
        $this->label($label);
    }

    public static function make(string $url, string $mimeType, string $label): self
    {
        return new self($url, $mimeType, $label);
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

    /**
     * The label of this caption source.
     */
    public function label(string $label): self
    {
        return $this->set('label', $label);
    }

    public function getType(): ?string
    {
        return null;
    }
}
