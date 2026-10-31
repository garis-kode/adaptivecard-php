<?php

declare(strict_types=1);

namespace AdaptiveCards\Action\Submit;

use AdaptiveCards\Node;

/**
 * Represents Teams-specific data in an Action.Submit to make an Invoke request to the Bot.
 */
final class InvokeSubmitActionData extends Node implements TeamsSubmitActionDataInterface
{
    public function __construct(CollabStageInvokeDataValue|string|int|float|bool|null $value = null)
    {
        if ($value !== null) {
            $this->value($value);
        }
    }

    public static function make(CollabStageInvokeDataValue|string|int|float|bool|null $value = null): self
    {
        return new self($value);
    }

    /**
     * The object to send to the Bot with the Invoke request. Can be strongly typed as
     * one of the below values to trigger a specific action in Teams.
     * Valid values: "CollabStageInvokeDataValue".
     */
    public function value(CollabStageInvokeDataValue|string|int|float|bool $value): self
    {
        return $this->set('value', $value);
    }

    public function getType(): string
    {
        return 'invoke';
    }
}
