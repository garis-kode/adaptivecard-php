<?php

declare(strict_types=1);

namespace AdaptiveCards\Element;

use AdaptiveCards\Node;

/**
 * A closed-caption track for a {@see Media} element (schema 1.6+). No `type`.
 */
final class CaptionSource extends Node
{
    public function __construct(string $url, string $mimeType, ?string $label = null)
    {
        $this->set('url', $url);
        $this->set('mimeType', $mimeType);
        $this->set('label', $label);
    }

    public static function make(string $url, string $mimeType, ?string $label = null): self
    {
        return new self($url, $mimeType, $label);
    }

    public function getType(): ?string
    {
        return null;
    }
}
