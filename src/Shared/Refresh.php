<?php

declare(strict_types=1);

namespace AdaptiveCards\Shared;

use AdaptiveCards\Action\ExecuteAction;
use AdaptiveCards\Node;

/**
 * Defines how a card refreshes itself (schema 1.4+). Has no `type` field.
 */
final class Refresh extends Node
{
    public static function make(): self
    {
        return new self();
    }

    public function action(ExecuteAction $action): self
    {
        return $this->set('action', $action);
    }

    public function expires(string $expires): self
    {
        return $this->set('expires', $expires);
    }

    /**
     * @param list<string> $userIds
     */
    public function userIds(array $userIds): self
    {
        return $this->set('userIds', $userIds);
    }

    public function getType(): ?string
    {
        return null;
    }
}
