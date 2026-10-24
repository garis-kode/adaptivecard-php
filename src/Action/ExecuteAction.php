<?php

declare(strict_types=1);

namespace AdaptiveCards\Action;

use AdaptiveCards\Enum\AssociatedInputs;

/**
 * Gathers inputs and sends a Universal Action Model event to a bot
 * (schema 1.4+).
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

    public function verb(string $verb): self
    {
        return $this->set('verb', $verb);
    }

    /**
     * @param array<string, mixed>|string $data
     */
    public function data(array|string $data): self
    {
        return $this->set('data', $data);
    }

    public function associatedInputs(string|AssociatedInputs $associatedInputs): self
    {
        return $this->set('associatedInputs', AssociatedInputs::value($associatedInputs));
    }

    public function getType(): string
    {
        return 'Action.Execute';
    }
}
