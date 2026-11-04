<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Image;

use AdaptiveCards\Element\AbstractBlockElement;
use AdaptiveCards\Enum\ImageSetSize;
use AdaptiveCards\Support\HasHeight;
use AdaptiveCards\Support\HasHorizontalAlignment;
use AdaptiveCards\Support\HasSpacing;

/**
 * A set of images, displayed side-by-side and wrapped across multiple rows as needed.
 */
final class ImageSet extends AbstractBlockElement
{
    use HasHeight;
    use HasHorizontalAlignment;
    use HasSpacing;

    public static function make(): self
    {
        return new self();
    }

    /**
     * Add an image to the image set.
     *
     * @param Image|iterable<Image> $image
     */
    public function addImages(Image|iterable $image): self
    {
        if (is_iterable($image)) {
            foreach ($image as $item) {
                $this->push('images', $item);
            }

            return $this;
        }

        return $this->push('images', $image);
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
