<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Graph;

/**
 * Displays multiple users' information, including their profile pictures.
 */
final class PersonaSet extends AbstractGraphComponent
{
    public static function make(): self
    {
        return new self();
    }

    protected function name(): string
    {
        return 'graph.microsoft.com/users';
    }

    /**
     * The properties of the PersonaSet component.
     * Valid values: "PersonaSetProperties".
     */
    public function properties(PersonaSetProperties $properties): self
    {
        return $this->set('properties', $properties);
    }
}
