<?php

declare(strict_types=1);

namespace AdaptiveCards\Action\Submit;

use AdaptiveCards\Node;

/**
 * Represents Teams-specific data in an Action.Submit to sign in a user.
 */
final class SigninSubmitActionData extends Node implements TeamsSubmitActionDataInterface
{
    public function __construct(?string $value = null)
    {
        if ($value !== null) {
            $this->value($value);
        }
    }

    public static function make(?string $value = null): self
    {
        return new self($value);
    }

    /**
     * The URL to redirect the end-user for signing in.
     */
    public function value(string $value): self
    {
        return $this->set('value', $value);
    }

    public function getType(): string
    {
        return 'signin';
    }
}
