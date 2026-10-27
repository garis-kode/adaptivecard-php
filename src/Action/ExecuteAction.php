<?php

declare(strict_types=1);

namespace AdaptiveCards\Action;

use AdaptiveCards\Enum\AssociatedInputs;

/**
 * Gathers input values, merges them with the `data` property if specified,
 * and sends them to the Bot via an Invoke activity.
 */
final class ExecuteAction extends AbstractAction
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
     * The verb of the action.
     */
    public function verb(string $verb): self
    {
        return $this->set('verb', $verb);
    }

    /**
     * The data to send to the Bot when the action is executed.
     * Valid values: "SubmitActionData".
     *
     * @param array<string, mixed>|string $data
     */
    public function data(array|string $data): self
    {
        return $this->set('data', $data);
    }

    /**
     * The Ids of the inputs associated with the action. When the action is executed,
     * the values of the associated inputs are sent to the Bot. See **Input validation** for more details.
     * Valid values: "auto", "none".
     */
    public function associatedInputs(AssociatedInputs $associatedInputs): self
    {
        return $this->set('associatedInputs', $associatedInputs->value);
    }

    public function getType(): string
    {
        return 'Action.Execute';
    }
}
