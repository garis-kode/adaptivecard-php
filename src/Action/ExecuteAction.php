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
     * The card author-defined verb associated with this action.
     */
    public function verb(string $verb): self
    {
        return $this->set('verb', $verb);
    }

    /**
     * Initial data that input fields will be combined with. These are essentially 'hidden' fields.
     *
     * @param array<string, mixed>|string $data
     */
    public function data(array|string $data): self
    {
        return $this->set('data', $data);
    }

    /**
     * Controls which inputs are associated with the action.
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
