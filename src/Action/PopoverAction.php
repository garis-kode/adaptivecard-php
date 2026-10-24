<?php

declare(strict_types=1);

namespace AdaptiveCards\Action;

use AdaptiveCards\Element\AbstractElement;
use AdaptiveCards\Enum\PopoverPosition;
use AdaptiveCards\Node;

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

    public function content(Node|AbstractElement $content): self
    {
        return $this->set('content', $content);
    }

    public function position(string|PopoverPosition $position): self
    {
        return $this->set('position', PopoverPosition::value($position));
    }

    public function displayArrow(bool $displayArrow = true): self
    {
        return $this->set('displayArrow', $displayArrow);
    }

    public function maxPopoverWidth(string $maxPopoverWidth): self
    {
        return $this->set('maxPopoverWidth', $maxPopoverWidth);
    }

    public function popoverTitle(string $popoverTitle): self
    {
        return $this->set('popoverTitle', $popoverTitle);
    }

    public function getType(): string
    {
        return 'Action.Popover';
    }
}
