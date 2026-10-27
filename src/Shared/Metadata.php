<?php

declare(strict_types=1);

namespace AdaptiveCards\Shared;

use AdaptiveCards\Node;

/**
 * Card-level metadata.
 */
final class Metadata extends Node
{
    public function __construct(?string $webUrl = null)
    {
        if ($webUrl !== null) {
            $this->webUrl($webUrl);
        }
    }

    public static function make(?string $webUrl = null): self
    {
        return new self($webUrl);
    }

    /**
     * The URL the card originates from. When `webUrl` is set, the card is dubbed an
     * Adaptive Card-based Loop Component and, when pasted in Teams or other Loop
     * Component-capable host applications, the URL will unfurl to the same exact card.
     */
    public function webUrl(string $webUrl): self
    {
        return $this->set('webUrl', $webUrl);
    }

    public function getType(): ?string
    {
        return null;
    }
}
