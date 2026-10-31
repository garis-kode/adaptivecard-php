<?php

declare(strict_types=1);

namespace AdaptiveCards\Action\Submit;

use AdaptiveCards\Node;

/**
 * Teams-specific properties associated with the action.
 */
final class TeamsSubmitActionProperties extends Node
{
    public function __construct(?TeamsSubmitActionFeedback $feedback = null)
    {
        if ($feedback !== null) {
            $this->feedback($feedback);
        }
    }

    public static function make(?TeamsSubmitActionFeedback $feedback = null): self
    {
        return new self($feedback);
    }

    /**
     * Defines how feedback is provided to the end-user when the action is executed.
     * Valid values: "TeamsSubmitActionFeedback".
     */
    public function feedback(TeamsSubmitActionFeedback $feedback): self
    {
        return $this->set('feedback', $feedback);
    }

    public function getType(): ?string
    {
        return null;
    }
}
