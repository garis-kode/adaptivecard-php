<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Graph;

/**
 * Displays a user's information, including their profile picture.
 */
final class Persona extends AbstractGraphComponent
{
    public static function make(): self
    {
        return new self();
    }

    protected function name(): string
    {
        return 'graph.microsoft.com/user';
    }

    /**
     * The properties of the Persona component.
     * Valid values: "PersonaProperties".
     */
    public function properties(PersonaProperties $properties): self
    {
        return $this->set('properties', $properties);
    }
}
