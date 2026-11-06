<?php

declare(strict_types=1);

namespace AdaptiveCards\Support;

use AdaptiveCards\Layout\AbstractLayout;
use AdaptiveCards\Layout\AreaGridLayout;
use AdaptiveCards\Layout\FlowLayout;
use AdaptiveCards\Layout\StackLayout;

trait HasLayouts
{
    /**
     * Add layouts associated with the container. The container can dynamically switch from one layout to
     * another as the card's width changes.
     *
     * @param AbstractLayout|iterable<AbstractLayout> $layout
     */
    public function addLayouts(AbstractLayout|iterable $layout): static
    {
        if (is_iterable($layout)) {
            foreach ($layout as $item) {
                $this->push('layouts', $item);
            }

            return $this;
        }

        return $this->push('layouts', $layout);
    }

    /**
     * The layouts associated with the container. The container can dynamically switch
     * from one layout to another as the card's width changes.
     * Valid values: "Layout.Stack", "Layout.Flow", "Layout.AreaGrid".
     *
     * @param iterable<AbstractLayout> $layouts
     */
    public function layouts(iterable $layouts): static
    {
        return $this->addLayouts($layouts);
    }

    /**
     * Add a layout that stacks elements on top of each other (the default layout) to the container's
     * layouts.
     *
     * @param (\Closure(StackLayout): void)|null $callback
     */
    public function addStackLayout(?\Closure $callback = null): static
    {
        $layout = StackLayout::make();
        if ($callback !== null) {
            $callback($layout);
        }

        return $this->addLayouts($layout);
    }

    /**
     * Add a layout that spreads elements horizontally and wraps them across multiple rows, as needed, to the
     * container's layouts.
     *
     * @param (\Closure(FlowLayout): void)|null $callback
     */
    public function addFlowLayout(?\Closure $callback = null): static
    {
        $layout = FlowLayout::make();
        if ($callback !== null) {
            $callback($layout);
        }

        return $this->addLayouts($layout);
    }

    /**
     * Add a layout that divides the container into named areas, into which elements can be placed via the
     * `grid.area` property, to the container's layouts.
     *
     * @param (\Closure(AreaGridLayout): void)|null $callback
     */
    public function addAreaGridLayout(?\Closure $callback = null): static
    {
        $layout = AreaGridLayout::make();
        if ($callback !== null) {
            $callback($layout);
        }

        return $this->addLayouts($layout);
    }
}
