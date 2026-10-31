<?php

declare(strict_types=1);

namespace AdaptiveCards\Action\Submit;

use AdaptiveCards\Node;
use AdaptiveCards\Support\HasKey;

/**
 * Represents feedback options for an Action.Submit.
 */
final class TeamsSubmitActionFeedback extends Node
{
    use HasKey;

    public function __construct(?bool $hide = null)
    {
        if ($hide !== null) {
            $this->hide($hide);
        }
    }

    public static function make(?bool $hide = null): self
    {
        return new self($hide);
    }

    /**
     * Defines if a feedback message should be displayed after the action is executed.
     */
    public function hide(bool $hide = true): self
    {
        return $this->set('hide', $hide);
    }

    public function getType(): ?string
    {
        return null;
    }
}
