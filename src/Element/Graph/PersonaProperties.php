<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Graph;

use AdaptiveCards\Enum\PersonaIconStyle;
use AdaptiveCards\Enum\PersonaStyle;
use AdaptiveCards\Node;
use AdaptiveCards\Support\HasKey;

/**
 * Represents the properties of a Persona component.
 */
final class PersonaProperties extends Node
{
    use HasKey;

    public static function make(): self
    {
        return new self();
    }

    /**
     * The display name of the persona.
     */
    public function displayName(string $displayName): self
    {
        return $this->set('displayName', $displayName);
    }

    /**
     * Defines the style of the icon for the persona.
     * Valid values: "profilePicture", "contactCard", "none".
     */
    public function iconStyle(PersonaIconStyle $iconStyle): self
    {
        return $this->set('iconStyle', $iconStyle->value);
    }

    /**
     * The Id of the persona.
     */
    public function id(string $id): self
    {
        return $this->set('id', $id);
    }

    /**
     * Defines how the persona should be displayed.
     * Valid values: "iconAndName", "iconOnly", "nameOnly".
     */
    public function style(PersonaStyle $style): self
    {
        return $this->set('style', $style->value);
    }

    /**
     * The UPN of the persona.
     */
    public function userPrincipalName(string $userPrincipalName): self
    {
        return $this->set('userPrincipalName', $userPrincipalName);
    }

    public function getType(): ?string
    {
        return null;
    }
}
