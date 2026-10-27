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

    /**
     * The style of the container. Container styles control the colors of the background,
     * border and text inside the container, in such a way that contrast requirements are always met.
     * Valid values: "default", "emphasis", "accent", "good", "attention", "warning".
     */
    public function style(ContainerStyle $style): self
    {
        return $this->set('style', $style->value);
    }

    /**
     * Controls if a border should be displayed around the container.
     */
    public function showBorder(bool $showBorder = true): self
    {
        return $this->set('showBorder', $showBorder);
    }

    /**
     * Controls if the container should have rounded corners.
     */
    public function roundedCorners(bool $roundedCorners = true): self
    {
        return $this->set('roundedCorners', $roundedCorners);
    }

    /**
     * The minimum height, in pixels, of the container.
     */
    public function minHeight(string $minHeight): self
    {
        return $this->set('minHeight', $minHeight);
    }

    /**
     * The maximum height, in pixels, of the container. When the content of a container
     * exceeds the container's maximum height, a vertical scrollbar is displayed.
     */
    public function maxHeight(string $maxHeight): self
    {
        return $this->set('maxHeight', $maxHeight);
    }

    /**
     * Add a layout associated with the container.
     */
    public function addLayout(AbstractLayout $layout): self
    {
        return $this->push('layouts', $layout);
    }

    /**
     * Add multiple layouts associated with the container.
     *
     * @param iterable<AbstractLayout> $layouts
     */
    public function addLayouts(iterable $layouts): self
    {
        foreach ($layouts as $layout) {
            $this->addLayout($layout);
        }

        return $this;
    }

    /**
     * The layouts associated with the container. The container can dynamically switch
     * from one layout to another as the card's width changes.
     * Valid values: Layout.Stack, Layout.Flow, Layout.AreaGrid.
     *
     * @param iterable<AbstractLayout> $layouts
     */
    public function layouts(iterable $layouts): self
    {
        return $this->addLayouts($layouts);
    }

    /**
     * Controls how the container's content should be vertically aligned.
     * Valid values: "Top", "Center", "Bottom".
     */
    public function verticalContentAlignment(VerticalAlignment $alignment): self
    {
        return $this->set('verticalContentAlignment', $alignment->value);
    }

    /**
     * Controls if the content of the card is to be rendered left-to-right or right-to-left.
     */
    public function rtl(bool $rtl = true): self
    {
        return $this->set('rtl', $rtl);
    }

    /**
     * Defines the container's background image.
     * Valid values: BackgroundImage.
     */
    public function backgroundImage(BackgroundImage $backgroundImage): self
    {
        return $this->set('backgroundImage', $backgroundImage);
    }

    /**
     * An Action that will be invoked when the element is tapped or clicked.
     * Action.ShowCard is not supported.
     */
    public function selectAction(AbstractAction $action): self
    {
        return $this->set('selectAction', $action);
    }

    public function getType(): string
    {
        return 'CarouselPage';
    }
}
