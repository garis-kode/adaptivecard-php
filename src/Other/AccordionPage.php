<?php

declare(strict_types=1);

namespace AdaptiveCards\Other;

use AdaptiveCards\Action\AbstractAction;
use AdaptiveCards\Element\AbstractElement;
use AdaptiveCards\Enum\ContainerStyle;
use AdaptiveCards\Enum\ExpandIconPosition;
use AdaptiveCards\Enum\HeaderSize;
use AdaptiveCards\Enum\VerticalAlignment;
use AdaptiveCards\Layout\AbstractLayout;
use AdaptiveCards\Shared\BackgroundImage;
use AdaptiveCards\Support\HasHorizontalAlignment;
use AdaptiveCards\Support\HasItems;

/**
 * A single page within an accordion.
 */
final class AccordionPage extends AbstractElement
{
    use HasHorizontalAlignment, HasItems;

    public function __construct(?string $headerTitle = null)
    {
        if ($headerTitle !== null) {
            $this->headerTitle($headerTitle);
        }
    }

    public static function make(?string $headerTitle = null): self
    {
        return new self($headerTitle);
    }

    /**
     * Controls the position of the expand/collapse icon.
     * Valid values: "Start", "Inline", "End".
     */
    public function expandIconPosition(ExpandIconPosition $position): self
    {
        return $this->set('expandIconPosition', $position->value);
    }

    /**
     * The name of the icon to display in the header.
     */
    public function headerIconName(string $name): self
    {
        return $this->set('headerIconName', $name);
    }

    /**
     * Controls the size of the header.
     * Valid values: "Small", "Medium", "Large", "XLarge".
     */
    public function headerSize(HeaderSize $size): self
    {
        return $this->set('headerSize', $size->value);
    }

    /**
     * The header text of the accordion page.
     */
    public function headerTitle(string $title): self
    {
        return $this->set('headerTitle', $title);
    }

    /**
     * Controls whether the header text is wrapped.
     */
    public function headerWrap(bool $wrap = true): self
    {
        return $this->set('headerWrap', $wrap);
    }

    /**
     * Controls whether the page is expanded.
     */
    public function isExpanded(bool $expanded = true): self
    {
        return $this->set('isExpanded', $expanded);
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
     * Controls how the container's content should be vertically aligned.
     * Valid values: "Top", "Center", "Bottom".
     */
    public function verticalContentAlignment(VerticalAlignment $alignment): self
    {
        return $this->set('verticalContentAlignment', $alignment->value);
    }

    /**
     * Controls if the container should bleed into its parent. A bleeding container extends into its parent's padding.
     */
    public function bleed(bool $bleed = true): self
    {
        return $this->set('bleed', $bleed);
    }

    /**
     * The minimum height, in pixels, of the container, in the `<number>px` format.
     * Valid values: "<number>px".
     */
    public function minHeight(string $minHeight): self
    {
        return $this->set('minHeight', $minHeight);
    }

    /**
     * The maximum height, in pixels, of the container, in the `<number>px` format. When the content of a container
     * exceeds the container's maximum height, a vertical scrollbar is displayed.
     * Valid values: "<number>px".
     */
    public function maxHeight(string $maxHeight): self
    {
        return $this->set('maxHeight', $maxHeight);
    }

    /**
     * Controls if the container should have rounded corners.
     */
    public function roundedCorners(bool $roundedCorners = true): self
    {
        return $this->set('roundedCorners', $roundedCorners);
    }

    /**
     * Controls if a border should be displayed around the container.
     */
    public function showBorder(bool $showBorder = true): self
    {
        return $this->set('showBorder', $showBorder);
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
     * Valid values: "Layout.Stack", "Layout.Flow", "Layout.AreaGrid".
     *
     * @param iterable<AbstractLayout> $layouts
     */
    public function layouts(iterable $layouts): self
    {
        return $this->addLayouts($layouts);
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
     * Valid values: "BackgroundImage".
     */
    public function backgroundImage(BackgroundImage $backgroundImage): self
    {
        return $this->set('backgroundImage', $backgroundImage);
    }

    /**
     * An Action that will be invoked when the element is tapped or clicked.
     * Action.ShowCard is not supported.
     * Valid values: "Action.Execute", "Action.InsertImage", "Action.OpenUrl", "Action.OpenUrlDialog",
     * "Action.Popover", "Action.ResetInputs", "Action.RunCommands", "Action.Submit", "Action.ToggleVisibility".
     */
    public function selectAction(AbstractAction $action): self
    {
        return $this->set('selectAction', $action);
    }

    public function getType(): string
    {
        return 'AccordionPage';
    }
}
