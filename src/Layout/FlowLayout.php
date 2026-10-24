<?php

declare(strict_types=1);

namespace AdaptiveCards\Layout;

/**
 * Flow layout: wraps child elements horizontally across rows.
 */
final class FlowLayout extends AbstractLayout
{
    public static function make(): self
    {
        return new self();
    }

    /**
     * The fixed width for all items in the flow layout.
     */
    public function itemWidth(string $itemWidth): self
    {
        return $this->set('itemWidth', $itemWidth);
    }

    /**
     * Controls how items fit within the flow layout.
     *
     * @param "Fit"|"Fill"|string $itemFit
     */
    public function itemFit(string $itemFit): self
    {
        return $this->set('itemFit', $itemFit);
    }

    /**
     * The minimum width of items in the flow layout.
     */
    public function minItemWidth(string $minItemWidth): self
    {
        return $this->set('minItemWidth', $minItemWidth);
    }

    /**
     * The maximum width of items in the flow layout.
     */
    public function maxItemWidth(string $maxItemWidth): self
    {
        return $this->set('maxItemWidth', $maxItemWidth);
    }

    /**
     * Controls horizontal alignment of items.
     *
     * @param "Left"|"Center"|"Right"|string $alignment
     */
    public function horizontalItemsAlignment(string $alignment): self
    {
        return $this->set('horizontalItemsAlignment', $alignment);
    }

    public function getType(): string
    {
        return 'Layout.Flow';
    }
}
