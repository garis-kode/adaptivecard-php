<?php

declare(strict_types=1);

namespace AdaptiveCards\Element;

use AdaptiveCards\Node;

/**
 * A single playable source for a {@see Media} element. Has no `type` field.
 */
final class MediaSource extends Node
{
    public function __construct(string $url, ?string $mimeType = null)
    {
        $this->set('url', $url);
        $this->set('mimeType', $mimeType);
    }

    public static function make(string $url, ?string $mimeType = null): self
    {
        return new self($url, $mimeType);
    }

    public function getType(): ?string
    {
        return null;
    }
}
