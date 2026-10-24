<?php

declare(strict_types=1);

namespace AdaptiveCards\Action;

final class ResetInputsAction extends AbstractAction
{
    /**
     * @param list<string>|null $targetInputIds
     */
    public function __construct(?string $title = null, ?array $targetInputIds = null)
    {
        $this->set('title', $title);
        if ($targetInputIds !== null) {
            $this->targetInputIds($targetInputIds);
        }
    }

    /**
     * @param list<string>|null $targetInputIds
     */
    public static function make(?string $title = null, ?array $targetInputIds = null): self
    {
        return new self($title, $targetInputIds);
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
