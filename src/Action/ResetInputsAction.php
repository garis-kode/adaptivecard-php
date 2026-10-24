<?php

declare(strict_types=1);

namespace AdaptiveCards\Action;

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
     * @param list<string> $targetInputIds
     */
    public function targetInputIds(array $targetInputIds): self
    {
        return $this->set('targetInputIds', $targetInputIds);
    }

    public function addTargetInputId(string $id): self
    {
        return $this->push('targetInputIds', $id);
    }

    public function getType(): string
    {
        return 'Action.ResetInputs';
    }
}
