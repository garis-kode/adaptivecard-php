<?php

declare(strict_types=1);

namespace AdaptiveCards\Action;

use AdaptiveCards\AdaptiveCard;

/**
 * Reveals an inline sub-card when invoked.
 */
final class ShowCardAction extends AbstractAction
{
    public function __construct(?string $title = null, ?AdaptiveCard $card = null)
    {
        $this->set('title', $title);
        $this->set('card', $card);
    }

    public static function make(string $title, ?AdaptiveCard $card = null): self
    {
        return new self($title, $card);
    }

    public function card(AdaptiveCard $card): self
    {
        return $this->set('card', $card);
    }

    public function getType(): string
    {
        return 'Action.ShowCard';
    }
}
