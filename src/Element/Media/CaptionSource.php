<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Media;

use AdaptiveCards\Node;

/**
 * A closed-caption track for a {@see Media} element (schema 1.6+). No `type`.
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

    public function url(string $url): self
    {
        return $this->set('url', $url);
    }

    public function mimeType(string $mimeType): self
    {
        return $this->set('mimeType', $mimeType);
    }

    public function label(string $label): self
    {
        return $this->set('label', $label);
    }

    public function getType(): ?string
    {
        return null;
    }
}
