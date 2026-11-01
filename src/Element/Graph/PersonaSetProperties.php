<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Graph;

use AdaptiveCards\Enum\PersonaIconStyle;
use AdaptiveCards\Enum\PersonaStyle;
use AdaptiveCards\Node;
use AdaptiveCards\Support\HasKey;

/**
 * Represents the properties of a PersonaSet component.
 */
final class PersonaSetProperties extends Node
{
    use HasKey;

    public static function make(): self
    {
        return new self();
    }

    /**
     * Defines the style of the icon for the personas in the set.
     * Valid values: "profilePicture", "contactCard", "none".
     */
    public function iconStyle(PersonaIconStyle $iconStyle): self
    {
        return $this->set('iconStyle', $iconStyle->value);
    }

    /**
     * Defines how each persona in the set should be displayed.
     * Valid values: "iconAndName", "iconOnly", "nameOnly".
     */
    public function style(PersonaStyle $style): self
    {
        return $this->set('style', $style->value);
    }

    /**
     * Add the users a PersonaSet component should display (accepts a single item or an iterable of items).
     * Valid values: "PersonaProperties".
     *
     * @param PersonaProperties|iterable<PersonaProperties> $user
     */
    public function addUsers(PersonaProperties|iterable $user): self
    {
        if (is_iterable($user)) {
            foreach ($user as $item) {
                $this->push('users', $item);
            }

            return $this;
        }

        return $this->push('users', $user);
    }

    public function getType(): ?string
    {
        return null;
    }
}
