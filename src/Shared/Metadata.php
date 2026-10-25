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
     * The URL of the webpage that this card is associated with.
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
