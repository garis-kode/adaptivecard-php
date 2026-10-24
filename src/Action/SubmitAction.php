<?php

declare(strict_types=1);

namespace AdaptiveCards\Action;

use AdaptiveCards\Enum\AssociatedInputs;

/**
 * Gathers the card's input values and sends them back to the host.
 */
final class SubmitAction extends AbstractAction
{
    public function __construct(?string $title = null)
    {
        $this->set('title', $title);
    }

    public static function make(?string $title = null): self
    {
        return new self($title);
    }

    /**
     * Initial/hidden data merged with the gathered inputs on submit.
     *
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

    /**
     * @param array<string, mixed> $properties
     */
    public function msteams(array $properties): self
    {
        return $this->set('msteams', $properties);
    }

    public function getType(): string
    {
        return 'Action.Submit';
    }
}
