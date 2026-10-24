<?php

declare(strict_types=1);

namespace AdaptiveCards\Shared;

use AdaptiveCards\Enum\HorizontalAlignment;
use AdaptiveCards\Enum\ImageFillMode;
use AdaptiveCards\Enum\VerticalAlignment;
use AdaptiveCards\Node;

/**
 * Defines the container's background image.
 */
final class BackgroundImage extends Node
{
    public function __construct(string $url)
    {
        $this->url($url);
    }

    public static function make(string $url): self
    {
        return new self($url);
    }

    /**
     * The URL (or data url) of the image.
     */
    public function url(string $url): self
    {
        return $this->set('url', $url);
    }

    /**
     * Describes how the image should fill the area.
     * Valid values: "cover", "repeatHorizontally", "repeatVertically", "repeat".
     */
    public function fillMode(string|ImageFillMode $fillMode): self
    {
        return $this->set('fillMode', ImageFillMode::value($fillMode));
    }

    /**
     * Describes how the image should be aligned if it must be cropped or if using repeat streams.
     * Valid values: "left", "center", "right".
     */
    public function horizontalAlignment(string|HorizontalAlignment $alignment): self
    {
        return $this->set('horizontalAlignment', HorizontalAlignment::value($alignment));
    }

    /**
     * Describes how the image should be aligned if it must be cropped or if using repeat streams.
     * Valid values: "top", "center", "bottom".
     */
    public function verticalAlignment(string|VerticalAlignment $alignment): self
    {
        return $this->set('verticalAlignment', VerticalAlignment::value($alignment));
    }

    public function getType(): ?string
    {
        return null;
    }
}
