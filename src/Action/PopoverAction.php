<?php

declare(strict_types=1);

namespace AdaptiveCards\Action;

use AdaptiveCards\Element\AbstractElement;
use AdaptiveCards\Enum\PopoverPosition;
use AdaptiveCards\Node;

/**
 * Shows a popover to display more information to the user.
 */
final class PopoverAction extends AbstractAction
{
    public function __construct(?string $title = null)
    {
        if ($title !== null) {
            $this->title($title);
        }
    }

    public static function make(?string $title = null): self
    {
        return new self($title);
    }

    /**
     * The content of the popover, which can be any element.
     * Valid values: "Accordion", "ActionSet", "Badge", "Carousel", "Chart.Donut", "Chart.Gauge",
     * "Chart.HorizontalBar", "Chart.HorizontalBar.Stacked", "Chart.Line", "Chart.Pie",
     * "Chart.VerticalBar", "Chart.VerticalBar.Grouped", "CitationRun", "CodeBlock", "ColumnSet",
     * "Calendar event", "File", "Graph resource", "Persona", "PersonaSet", "CompoundButton",
     * "Container", "FactSet", "Icon", "IconRun", "Image", "ImageRun", "ImageSet", "Input.ChoiceSet",
     * "Input.Date", "Input.Number", "Input.Rating", "Input.Text", "Input.Time", "Input.Toggle",
     * "LoopComponent", "Media", "ProgressBar", "ProgressRing", "Rating", "RichTextBlock", "Table",
     * "TabSet", "TextBlock", "TextRun".
     */
    public function content(Node|AbstractElement $content): self
    {
        return $this->set('content', $content);
    }

    /**
     * Controls where the popover should be displayed with regards to the element that triggered it.
     * Valid values: "Above", "Below", "Before", "After".
     */
    public function position(PopoverPosition $position): self
    {
        return $this->set('position', $position->value);
    }

    /**
     * Controls if an arrow should be displayed towards the element that triggered the popover.
     */
    public function displayArrow(bool $displayArrow = true): self
    {
        return $this->set('displayArrow', $displayArrow);
    }

    /**
     * The maximum width of the popover in pixels, in the `<number>px` format.
     * Valid values: "<number>px".
     */
    public function maxPopoverWidth(string $maxPopoverWidth): self
    {
        return $this->set('maxPopoverWidth', $maxPopoverWidth);
    }

    /**
     * The optional title of the popover, which will only be displayed on mobile devices.
     */
    public function popoverTitle(string $popoverTitle): self
    {
        return $this->set('popoverTitle', $popoverTitle);
    }

    public function getType(): string
    {
        return 'Action.Popover';
    }
}
