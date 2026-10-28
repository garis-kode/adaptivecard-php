<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Image;

use AdaptiveCards\Element\AbstractBlockElement;
use AdaptiveCards\Enum\ImageSetSize;

/**
 * A set of images, displayed side-by-side and wrapped across multiple rows as needed.
 */
final class ImageSet extends AbstractBlockElement
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
     * Add multiple images to the image set.
     *
     * @param iterable<Image> $images
     */
    public function addImages(iterable $images): self
    {
        foreach ($images as $image) {
            $this->addImage($image);
        }

        return $this;
    }

    /**
     * The images in the set.
     * Valid values: "Image".
     *
     * @param iterable<Image> $images
     */
    public function images(iterable $images): self
    {
        return $this->addImages($images);
    }

    /**
     * The size to use to render all images in the set.
     * Valid values: "Small", "Medium", "Large".
     */
    public function imageSize(ImageSetSize $size): self
    {
        return $this->set('imageSize', $size->value);
    }

    public function getType(): string
    {
        return 'ImageSet';
    }
}
