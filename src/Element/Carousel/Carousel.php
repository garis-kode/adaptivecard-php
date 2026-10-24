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

    public function addPage(CarouselPage $page): self
    {
        return $this->push('pages', $page);
    }

    /**
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
     * Preview: milliseconds between automatic advances; minimum 1000.
     */
    public function autoLoopInterval(int $milliseconds): self
    {
        return $this->set('autoLoopInterval', $milliseconds);
    }

    /**
     * @param "Slide"|"CrossFade"|"None"|string $animation
     */
    public function pageAnimation(string $animation): self
    {
        return $this->set('pageAnimation', $animation);
    }

    public function bleed(bool $bleed = true): self
    {
        return $this->set('bleed', $bleed);
    }

    public function minHeight(string $minHeight): self
    {
        return $this->set('minHeight', $minHeight);
    }

    public function getType(): string
    {
        return 'Carousel';
    }
}
