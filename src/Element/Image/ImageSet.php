<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Image;

use AdaptiveCards\Element\AbstractElement;
use AdaptiveCards\Enum\ImageSize;

/**
 * Displays a collection of {@see Image}s as a gallery.
 */
final class ImageSet extends AbstractElement
{
    public static function make(): self
    {
        return new self();
    }

    public function addImage(Image|string $image): self
    {
        return $this->push('images', $image instanceof Image ? $image : (new Image())->url($image));
    }

    public function imageSize(string|ImageSize $size): self
    {
        return $this->set('imageSize', ImageSize::value($size));
    }

    public function getType(): string
    {
        return 'ImageSet';
    }
}
