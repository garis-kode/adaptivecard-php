<?php

declare(strict_types=1);

namespace AdaptiveCards\Action;

use AdaptiveCards\AdaptiveCard;

/**
 * Expands or collapses an embedded card within the main card.
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

    /**
     * The card that should be displayed when the action is executed.
     * Valid values: "AdaptiveCard".
     */
    public function card(AdaptiveCard $card): self
    {
        return $this->set('card', $card);
    }

    public function getType(): string
    {
        return 'Action.ShowCard';
    }
}
