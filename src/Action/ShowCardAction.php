<?php

declare(strict_types=1);

namespace AdaptiveCards\Action;

use AdaptiveCards\AdaptiveCard;

/**
 * Reveals an inline sub-card when invoked.
 */
final class ShowCardAction extends AbstractAction
{
    public function __construct(AdaptiveCard $card, ?string $title = null)
    {
        $this->card($card);
       
        if ($title !== null) {
            $this->title($title);
        }
    }

    public static function make(AdaptiveCard $card, ?string $title = null): self
    {
        return new self($card, $title);
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
