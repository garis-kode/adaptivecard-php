<?php

declare(strict_types=1);

namespace AdaptiveCards\Shared;

use AdaptiveCards\Enum\HorizontalAlignment;
use AdaptiveCards\Enum\ImageFillMode;
use AdaptiveCards\Enum\VerticalAlignment;
use AdaptiveCards\Node;

/**
 * A background image for a card or container. Has no `type` field.
 */
final class BackgroundImage extends Node
{
    public function __construct(string $url)
    {
        $this->set('url', $url);
    }

    public static function make(string $url): self
    {
        return new self($url);
    }

    public function fillMode(string|ImageFillMode $fillMode): self
    {
        return $this->set('fillMode', ImageFillMode::value($fillMode));
    }

    public function horizontalAlignment(string|HorizontalAlignment $alignment): self
    {
        return $this->set('horizontalAlignment', HorizontalAlignment::value($alignment));
    }

    public function verticalAlignment(string|VerticalAlignment $alignment): self
    {
        return $this->set('verticalAlignment', VerticalAlignment::value($alignment));
    }

    public function getType(): ?string
    {
        return null;
    }
}
