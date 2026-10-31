<?php

declare(strict_types=1);

namespace AdaptiveCards\Support;

use AdaptiveCards\Layout\AbstractLayout;
use AdaptiveCards\Layout\AreaGridLayout;
use AdaptiveCards\Layout\FlowLayout;
use AdaptiveCards\Layout\StackLayout;
use Closure;

trait HasLayouts
{
    /**
     * Add a layout associated with the container.
     */
    public function addLayout(AbstractLayout $layout): static
    {
        return $this->push('layouts', $layout);
    }

    /**
     * Add multiple layouts associated with the container.
     *
     * @param iterable<AbstractLayout> $layouts
     */
    public function addLayouts(iterable $layouts): static
    {
        foreach ($layouts as $layout) {
            $this->addLayout($layout);
        }

        return $this;
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
     * Add a StackLayout to the container.
     *
     * @param (Closure(StackLayout): void)|null $callback
     */
    public function addStackLayout(?Closure $callback = null): static
    {
        $layout = StackLayout::make();
        if ($callback !== null) {
            $callback($layout);
        }

        return $this->addLayout($layout);
    }

    /**
     * Add a FlowLayout to the container.
     *
     * @param (Closure(FlowLayout): void)|null $callback
     */
    public function addFlowLayout(?Closure $callback = null): static
    {
        $layout = FlowLayout::make();
        if ($callback !== null) {
            $callback($layout);
        }

        return $this->addLayout($layout);
    }

    /**
     * Add an AreaGridLayout to the container.
     *
     * @param (Closure(AreaGridLayout): void)|null $callback
     */
    public function addAreaGridLayout(?Closure $callback = null): static
    {
        $layout = AreaGridLayout::make();
        if ($callback !== null) {
            $callback($layout);
        }

        return $this->addLayout($layout);
    }
}
