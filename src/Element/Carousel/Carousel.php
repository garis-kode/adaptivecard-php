<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Carousel;

use AdaptiveCards\Element\AbstractElement;

/**
 * A carousel with sliding pages.
 */
final class Carousel extends AbstractElement
{
    public static function make(): self
    {
        return new self();
    }

    /**
     * Add a page to the carousel.
     */
    public function addPage(CarouselPage $page): self
    {
        return $this->push('pages', $page);
    }

    /**
     * The pages of the carousel.
     *
     * @param iterable<CarouselPage> $pages
     */
    public function pages(iterable $pages): self
    {
        foreach ($pages as $page) {
            $this->addPage($page);
        }

        return $this;
    }

    /**
     * Controls the duration of an auto loop interval in milliseconds.
     * When auto-loop is enabled, pages automatically advance after this interval.
     */
    public function autoLoopInterval(int $milliseconds): self
    {
        return $this->set('autoLoopInterval', $milliseconds);
    }

    /**
     * Controls the animation style between carousel pages.
     * Valid values: "Slide", "CrossFade", "None".
     *
     * @param "Slide"|"CrossFade"|"None"|string $animation
     */
    public function pageAnimation(string $animation): self
    {
        return $this->set('pageAnimation', $animation);
    }

    /**
     * Determines whether the element should bleed through its parent's padding.
     */
    public function bleed(bool $bleed = true): self
    {
        return $this->set('bleed', $bleed);
    }

    /**
     * The minimum height, in pixels, of the carousel, in the `<number>px` format.
     */
    public function minHeight(string $minHeight): self
    {
        return $this->set('minHeight', $minHeight);
    }

    public function getType(): string
    {
        return 'Carousel';
    }
}
