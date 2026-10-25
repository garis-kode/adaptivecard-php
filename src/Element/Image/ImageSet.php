<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Image;

use AdaptiveCards\Element\AbstractElement;
use AdaptiveCards\Enum\ImageSize;

/**
 * A set of images, displayed side-by-side and wrapped across multiple rows as needed.
 */
final class ImageSet extends AbstractElement
{
    public static function make(): self
    {
        return new self();
    }

    /**
     * Add an image to the image set.
     */
    public function addImage(Image $image): self
    {
        return $this->push('images', $image);
    }

    /**
     * Controls the approximate size of each image in the set.
     * Valid values: "Auto", "Stretch", "Small", "Medium", "Large".
     */
    public function imageSize(ImageSize $size): self
    {
        return $this->set('imageSize', $size->value);
    }

    public function getType(): string
    {
        return 'ImageSet';
    }
}
