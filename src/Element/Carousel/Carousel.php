<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Carousel;

use AdaptiveCards\Element\AbstractElement;
use AdaptiveCards\Enum\PageAnimation;

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
     * Add multiple pages to the carousel.
     *
     * @param iterable<CarouselPage> $pages
     */
    public function addPages(iterable $pages): self
    {
        foreach ($pages as $page) {
            $this->addPage($page);
        }

        return $this;
    }

    /**
     * The pages in the carousel.
     * Valid values: "CarouselPage".
     *
     * @param iterable<CarouselPage> $pages
     */
    public function pages(iterable $pages): self
    {
        return $this->addPages($pages);
    }

    /**
     * The interval, in milliseconds, between automatic page advances. Leave undefined to disable
     * auto-rotation; the minimum accepted value is 1000.
     */
    public function autoLoopInterval(int $milliseconds): self
    {
        return $this->set('autoLoopInterval', $milliseconds);
    }

    /**
     * Controls the type of animation to use to navigate between pages.
     * Valid values: "Slide", "CrossFade", "None".
     */
    public function pageAnimation(PageAnimation $animation): self
    {
        return $this->set('pageAnimation', $animation->value);
    }

    /**
     * Controls if the container should bleed into its parent. A bleeding container extends into its parent's padding.
     * See **Edge-to-edge content** for more information.
     */
    public function bleed(bool $bleed = true): self
    {
        return $this->set('bleed', $bleed);
    }

    /**
     * The minimum height, in pixels, of the container, in the `<number>px` format.
     * Valid values: "<number>px".
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
