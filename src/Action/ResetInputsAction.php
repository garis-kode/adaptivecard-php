<?php

declare(strict_types=1);

namespace AdaptiveCards\Action;

use AdaptiveCards\Support\HasMenuActions;

/**
 * Resets the values of the inputs in the card.
 */
final class ResetInputsAction extends AbstractAction
{
    use HasMenuActions;

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
     * Add the Ids of the inputs that should be reset.
     *
     * @param string|iterable<string> $id
     */
    public function addTargetInputIds(string|iterable $id): self
    {
        if (is_iterable($id)) {
            foreach ($id as $item) {
                $this->push('targetInputIds', $item);
            }

            return $this;
        }

        return $this->push('targetInputIds', $id);
    }

    /**
     * The Ids of the inputs that should be reset.
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
