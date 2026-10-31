<?php

declare(strict_types=1);

namespace AdaptiveCards\Action\Submit;

use AdaptiveCards\Node;

/**
 * Represents Teams-specific data in an Action.Submit to open a task module.
 */
final class TaskFetchSubmitActionData extends Node implements TeamsSubmitActionDataInterface
{
    public static function make(): self
    {
        return new self();
    }

    public function getType(): string
    {
        return 'task/fetch';
    }
}
