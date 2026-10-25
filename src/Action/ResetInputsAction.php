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
     * Add an input ID to the list of inputs that should be reset.
     */
    public function addTargetInputId(string $id): self
    {
        return $this->push('targetInputIds', $id);
    }

    /**
     * Add multiple input IDs to the list of inputs that should be reset.
     *
     * @param iterable<string> $targetInputIds
     */
    public function addTargetInputIds(iterable $targetInputIds): self
    {
        foreach ($targetInputIds as $id) {
            $this->addTargetInputId($id);
        }

        return $this;
    }

    /**
     * An array of IDs of the inputs that should be reset. If omitted, all inputs in the card are reset.
     *
     * @param iterable<string> $targetInputIds
     */
    public function targetInputIds(iterable $targetInputIds): self
    {
        return $this->addTargetInputIds($targetInputIds);
    }

    public function getType(): string
    {
        return 'Action.ResetInputs';
    }
}
