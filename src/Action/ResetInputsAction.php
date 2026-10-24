<?php

declare(strict_types=1);

namespace AdaptiveCards\Action;

/**
 * Resets the values of the inputs in the card.
 */
final class ResetInputsAction extends AbstractAction
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
     * An array of IDs of the inputs that should be reset. If omitted, all inputs in the card are reset.
     *
     * @param list<string> $targetInputIds
     */
    public function targetInputIds(array $targetInputIds): self
    {
        return $this->set('targetInputIds', $targetInputIds);
    }

    /**
     * Add an input ID to the list of inputs that should be reset.
     */
    public function addTargetInputId(string $id): self
    {
        return $this->push('targetInputIds', $id);
    }

    public function getType(): string
    {
        return 'Action.ResetInputs';
    }
}
