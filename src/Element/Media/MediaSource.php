<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Media;

use AdaptiveCards\Node;

/**
 * A single playable source for a {@see Media} element. Has no `type` field.
 */
final class MediaSource extends Node
{
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

    public function url(string $url): self
    {
        return $this->set('url', $url);
    }

    public function mimeType(string $mimeType): self
    {
        return $this->set('mimeType', $mimeType);
    }

    public function getType(): ?string
    {
        return null;
    }
}
