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
    public function fillMode(ImageFillMode $fillMode): self
    {
        return $this->set('fillMode', $fillMode->value);
    }

    /**
     * Describes how the image should be aligned if it must be cropped or if using repeat streams.
     * Valid values: "Left", "Center", "Right".
     */
    public function horizontalAlignment(HorizontalAlignment $alignment): self
    {
        return $this->set('horizontalAlignment', $alignment->value);
    }

    /**
     * Describes how the image should be aligned if it must be cropped or if using repeat streams.
     * Valid values: "Top", "Center", "Bottom".
     */
    public function verticalAlignment(VerticalAlignment $alignment): self
    {
        return $this->set('verticalAlignment', $alignment->value);
    }

    public function getType(): ?string
    {
        return null;
    }
}
