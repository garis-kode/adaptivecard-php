<?php

declare(strict_types=1);

namespace AdaptiveCards\Action\Submit;

use AdaptiveCards\Node;

/**
 * Represents Teams-specific data in an Action.Submit to send an Instant Message back to the Bot.
 */
final class ImBackSubmitActionData extends Node implements TeamsSubmitActionDataInterface
{
    public function __construct(?string $value = null)
    {
        if ($value !== null) {
            $this->value($value);
        }
    }

    public static function make(?string $value = null): self
    {
        return new self($value);
    }

    /**
     * The value that will be sent to the Bot.
     */
    public function value(string $value): self
    {
        return $this->set('value', $value);
    }

    public function getType(): string
    {
        return 'imBack';
    }
}
