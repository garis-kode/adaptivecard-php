<?php

declare(strict_types=1);

namespace AdaptiveCards\Shared;

use AdaptiveCards\Node;

/**
 * Non-rendered metadata about a card (schema 1.6+). Has no `type` field.
 */
final class Metadata extends Node
{
    public function __construct(?string $webUrl = null)
    {
        $this->set('webUrl', $webUrl);
    }

    public static function make(?string $webUrl = null): self
    {
        return new self($webUrl);
    }

    public function webUrl(string $webUrl): self
    {
        return $this->set('webUrl', $webUrl);
    }

    public function getType(): ?string
    {
        return null;
    }
}
