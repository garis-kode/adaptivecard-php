<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Image;

use AdaptiveCards\Action\AbstractAction;
use AdaptiveCards\Element\AbstractElement;
use AdaptiveCards\Enum\ImageSize;
use AdaptiveCards\Enum\ImageStyle;

/**
 * Displays an image.
 */
final class Image extends AbstractElement
{
    public function __construct(string $url)
    {
        $this->set('url', $url);
    }

    public static function make(string $url): self
    {
        return new self($url);
    }

    public function url(string $url): self
    {
        return $this->set('url', $url);
    }

    public function altText(string $altText): self
    {
        return $this->set('altText', $altText);
    }

    public function size(string|ImageSize $size): self
    {
        return $this->set('size', ImageSize::value($size));
    }

    public function style(string|ImageStyle $style): self
    {
        return $this->set('style', ImageStyle::value($style));
    }

    public function backgroundColor(string $color): self
    {
        return $this->set('backgroundColor', $color);
    }

    /**
     * Explicit width, e.g. "50px".
     */
    public function width(string $width): self
    {
        return $this->set('width', $width);
    }

    /**
     * Explicit height, e.g. "50px" (overrides the element height enum).
     */
    public function pixelHeight(string $height): self
    {
        return $this->set('height', $height);
    }

    public function selectAction(AbstractAction $action): self
    {
        return $this->set('selectAction', $action);
    }

    public function getType(): string
    {
        return 'Image';
    }
}
