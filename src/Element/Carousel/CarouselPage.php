<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Carousel;

use AdaptiveCards\Action\AbstractAction;
use AdaptiveCards\Element\AbstractElement;
use AdaptiveCards\Enum\ContainerStyle;
use AdaptiveCards\Enum\VerticalAlignment;
use AdaptiveCards\Layout\AbstractLayout;
use AdaptiveCards\Shared\BackgroundImage;
use AdaptiveCards\Support\HasItems;

/**
 * A page inside a Carousel element.
 */
final class CarouselPage extends AbstractElement
{
    use HasItems;

    public static function make(): self
    {
        return new self();
    }

    public function style(string|ContainerStyle $style): self
    {
        return $this->set('style', ContainerStyle::value($style));
    }

    public function showBorder(bool $showBorder = true): self
    {
        return $this->set('showBorder', $showBorder);
    }

    public function roundedCorners(bool $roundedCorners = true): self
    {
        return $this->set('roundedCorners', $roundedCorners);
    }

    public function minHeight(string $minHeight): self
    {
        return $this->set('minHeight', $minHeight);
    }

    public function maxHeight(string $maxHeight): self
    {
        return $this->set('maxHeight', $maxHeight);
    }

    public function addLayout(AbstractLayout $layout): self
    {
        return $this->push('layouts', $layout);
    }

    /**
     * @param iterable<AbstractLayout> $layouts
     */
    public function layouts(iterable $layouts): self
    {
        foreach ($layouts as $layout) {
            $this->addLayout($layout);
        }

        return $this;
    }

    public function verticalContentAlignment(string|VerticalAlignment $alignment): self
    {
        return $this->set('verticalContentAlignment', VerticalAlignment::value($alignment));
    }

    public function rtl(bool $rtl = true): self
    {
        return $this->set('rtl', $rtl);
    }

    public function backgroundImage(string|BackgroundImage $backgroundImage): self
    {
        return $this->set('backgroundImage', $backgroundImage);
    }

    public function selectAction(AbstractAction $action): self
    {
        return $this->set('selectAction', $action);
    }

    public function getType(): string
    {
        return 'CarouselPage';
    }
}
