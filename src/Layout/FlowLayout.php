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

    public function itemWidth(string $itemWidth): self
    {
        return $this->set('itemWidth', $itemWidth);
    }

    /**
     * @param "Fit"|"Fill"|string $itemFit
     */
    public function itemFit(string $itemFit): self
    {
        return $this->set('itemFit', $itemFit);
    }

    public function minItemWidth(string $minItemWidth): self
    {
        return $this->set('minItemWidth', $minItemWidth);
    }

    public function maxItemWidth(string $maxItemWidth): self
    {
        return $this->set('maxItemWidth', $maxItemWidth);
    }

    /**
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
