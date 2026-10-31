<?php

declare(strict_types=1);

namespace AdaptiveCards\Layout;

use AdaptiveCards\Enum\HorizontalAlignment;
use AdaptiveCards\Enum\ItemFit;
use AdaptiveCards\Enum\Spacing;
use AdaptiveCards\Enum\VerticalAlignment;

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
     * Valid values: "<number>px".
     */
    public function itemWidth(string $itemWidth): self
    {
        return $this->set('itemWidth', $itemWidth);
    }

    /**
     * Controls how items fit within the flow layout.
     * Valid values: "Fit", "Fill".
     */
    public function itemFit(ItemFit $itemFit): self
    {
        return $this->set('itemFit', $itemFit->value);
    }

    /**
     * The minimum width of items in the flow layout, in pixels.
     * Valid values: "<number>px".
     */
    public function minItemWidth(string $minItemWidth): self
    {
        return $this->set('minItemWidth', $minItemWidth);
    }

    /**
     * The maximum width of items in the flow layout, in pixels.
     * Valid values: "<number>px".
     */
    public function maxItemWidth(string $maxItemWidth): self
    {
        return $this->set('maxItemWidth', $maxItemWidth);
    }

    /**
     * The space between items.
     * Valid values: "None", "ExtraSmall", "Small", "Default", "Medium", "Large", "ExtraLarge", "Padding".
     */
    public function columnSpacing(Spacing $spacing): self
    {
        return $this->set('columnSpacing', $spacing->value);
    }

    /**
     * The space between rows of items.
     * Valid values: "None", "ExtraSmall", "Small", "Default", "Medium", "Large", "ExtraLarge", "Padding".
     */
    public function rowSpacing(Spacing $spacing): self
    {
        return $this->set('rowSpacing', $spacing->value);
    }

    /**
     * Controls horizontal alignment of items.
     * Valid values: "Left", "Center", "Right".
     */
    public function horizontalItemsAlignment(HorizontalAlignment $alignment): self
    {
        return $this->set('horizontalItemsAlignment', $alignment->value);
    }

    /**
     * Controls how the content of the container should be vertically aligned.
     * Valid values: "Top", "Center", "Bottom".
     */
    public function verticalItemsAlignment(VerticalAlignment $alignment): self
    {
        return $this->set('verticalItemsAlignment', $alignment->value);
    }

    public function getType(): string
    {
        return 'Layout.Flow';
    }
}
