<?php

declare(strict_types=1);

namespace AdaptiveCards\Element;

use AdaptiveCards\Enum\Height;
use AdaptiveCards\Enum\HorizontalAlignment;
use AdaptiveCards\Enum\Spacing;
use AdaptiveCards\Enum\TargetWidth;
use AdaptiveCards\Node;

/**
 * Shared base for every card element. Provides the properties defined on the
 * schema's `Element` type: id, isVisible, spacing, separator, height,
 * requires and fallback.
 */
abstract class AbstractElement extends Node
{
    /**
     * A unique identifier for the element or action. Input elements must have
     * an `id`, otherwise they will not be validated and their values will not
     * be sent to the Bot.
     */
    public function id(string $id): static
    {
        return $this->set('id', $id);
    }

    /**
     * Controls the visibility of the element.
     */
    public function isVisible(bool $visible = true): static
    {
        return $this->set('isVisible', $visible);
    }

    /**
     * Defines an expression whose evaluated value will be used to update the
     * `isVisible` property of the element at runtime.
     */
    public function isVisibleDynamic(string $expression): static
    {
        return $this->set('isVisible.dynamic', $expression);
    }

    /**
     * Controls the amount of space between this element and the previous one.
     * No space will be added for the first element in a container.
     * Valid values: "None", "ExtraSmall", "Small", "Default", "Medium", "Large", "ExtraLarge", "Padding".
     */
    public function spacing(Spacing $spacing): static
    {
        return $this->set('spacing', $spacing->value);
    }

    /**
     * Controls whether a separator line should be displayed above the element
     * to visually separate it from the previous element. No separator will be
     * displayed for the first element in a container, even if this property is
     * set to true.
     */
    public function separator(bool $separator = true): static
    {
        return $this->set('separator', $separator);
    }

    /**
     * The height of the element. When set to `stretch`, the element will use
     * the remaining vertical space in its container.
     * Valid values: "auto", "stretch".
     */
    public function height(Height $height): static
    {
        return $this->set('height', $height->value);
    }

    /**
     * Controls how the element should be horizontally aligned.
     * Valid values: "Left", "Center", "Right".
     */
    public function horizontalAlignment(HorizontalAlignment $alignment): static
    {
        return $this->set('horizontalAlignment', $alignment->value);
    }

    /**
     * Controls for which card width the element should be displayed. If
     * `targetWidth` isn't specified, the element is rendered at all card
     * widths. Using `targetWidth` makes it possible to author responsive
     * cards that adapt their layout to the available horizontal space. For
     * more details, see **Responsive layout**.
     * Valid values: "VeryNarrow", "Narrow", "Standard", "Wide",
     * "atLeast:VeryNarrow", "atMost:VeryNarrow", "atLeast:Narrow", "atMost:Narrow",
     * "atLeast:Standard", "atMost:Standard", "atLeast:Wide", "atMost:Wide".
     */
    public function targetWidth(TargetWidth $targetWidth): static
    {
        return $this->set('targetWidth', $targetWidth->value);
    }

    /**
     * The area of a `Layout.AreaGrid` layout in which an element should be displayed.
     */
    public function gridArea(string $gridArea): static
    {
        return $this->set('grid.area', $gridArea);
    }

    /**
     * Controls whether the element should be used as a sort key by elements
     * that allow sorting across a collection of elements.
     */
    public function isSortKey(bool $isSortKey = true): static
    {
        return $this->set('isSortKey', $isSortKey);
    }

    /**
     * The locale associated with the element.
     */
    public function lang(string $lang): static
    {
        return $this->set('lang', $lang);
    }

    /**
     * A list of capabilities the element requires the host application to support.
     * If the host application doesn't support at least one of the listed
     * capabilities, the element is not rendered (or its fallback is rendered
     * if provided).
     * Valid values: "HostCapabilities".
     *
     * @param array<string, string> $requires feature name => minimum version
     */
    public function requires(array $requires): static
    {
        return $this->set('requires', $requires);
    }

    /**
     * An alternate element to render if the type of this one is unsupported or
     * if the host application doesn't support all the capabilities specified in
     * the `requires` property.
     * Valid values: "Container", "ActionSet", "ColumnSet", "Media", "RichTextBlock", "Table",
     * "TextBlock", "FactSet", "ImageSet", "Image", "Input.Text", "Input.Date", "Input.Time",
     * "Input.Number", "Input.Toggle", "Input.ChoiceSet", "Input.Rating", "Rating", "CompoundButton",
     * "Icon", "Carousel", "TabSet", "Accordion", "Badge", "ProgressRing", "ProgressBar",
     * "LoopComponent", "Chart.Donut", "Chart.Pie", "Chart.VerticalBar.Grouped", "Chart.VerticalBar",
     * "Chart.HorizontalBar", "Chart.HorizontalBar.Stacked", "Chart.Line", "Chart.Gauge",
     * "CodeBlock", "Persona", "PersonaSet", "Graph resource", "File", "Calendar event", "drop".
     */
    public function fallback(string|AbstractElement $fallback): static
    {
        return $this->set('fallback', $fallback);
    }
}
