<?php

declare(strict_types=1);

namespace AdaptiveCards\Action;

use AdaptiveCards\Enum\AssociatedInputs;

/**
 * Gathers input values, merges them with the `data` property if specified,
 * and sends them to the Bot via an Invoke activity. The Bot can only acknowledge
 * it has received the request.
 */
final class SubmitAction extends AbstractAction
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
     * The data to send to the Bot when the action is executed.
     *
     * @param array<string, mixed>|string $data
     */
    public function data(array|string $data): self
    {
        return $this->set('data', $data);
    }

    /**
     * The Ids of the inputs associated with the Action.Submit. When the action is executed,
     * the values of the associated inputs are sent to the Bot.
     * Valid values: "auto", "none".
     */
    public function associatedInputs(AssociatedInputs $associatedInputs): self
    {
        return $this->set('associatedInputs', $associatedInputs->value);
    }

    /**
     * Teams-specific metadata associated with the action.
     * Valid values: TeamsSubmitActionProperties.
     * Supported properties include `feedback` (e.g. `['hide' => true]` to hide the card after execution).
     *
     * @param array<string, mixed> $properties TeamsSubmitActionProperties (e.g. ['feedback' => ['hide' => true]])
     */
    public function msteams(array $properties, bool $useCamelCaseKey = false): self
    {
        if ($useCamelCaseKey) {
            return $this->set('msTeams', $properties);
        }

        return $this->set('msteams', $properties);
    }

    public function getType(): string
    {
        return 'Action.Submit';
    }
}
