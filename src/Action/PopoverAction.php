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
     * The content to display inside the popover.
     */
    public function content(Node|AbstractElement $content): self
    {
        return $this->set('content', $content);
    }

    /**
     * Controls where the popover should be positioned relative to the target element.
     * Valid values: "Above", "Below", "Before", "After".
     */
    public function position(string|PopoverPosition $position): self
    {
        return $this->set('position', PopoverPosition::value($position));
    }

    /**
     * Controls whether an arrow pointing to the target element is displayed.
     */
    public function displayArrow(bool $displayArrow = true): self
    {
        return $this->set('displayArrow', $displayArrow);
    }

    /**
     * Controls the maximum width of the popover.
     */
    public function maxPopoverWidth(string $maxPopoverWidth): self
    {
        return $this->set('maxPopoverWidth', $maxPopoverWidth);
    }

    /**
     * Title text to display in the popover header.
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
