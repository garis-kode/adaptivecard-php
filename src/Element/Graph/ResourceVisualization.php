<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Graph;

use AdaptiveCards\Node;
use AdaptiveCards\Support\HasKey;

/**
 * Represents a visualization of a resource.
 */
final class ResourceVisualization extends Node
{
    use HasKey;

    public static function make(): self
    {
        return new self();
    }

    /**
     * The media associated with the resource.
     */
    public function media(string $media): self
    {
        return $this->set('media', $media);
    }

    public function getType(): ?string
    {
        return null;
    }
}
