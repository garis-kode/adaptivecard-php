<?php

declare(strict_types=1);

namespace AdaptiveCards\Element;

use AdaptiveCards\Node;
use AdaptiveCards\Support\HasKey;

abstract class AbstractInlineElement extends Node
{
    use HasKey;

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
