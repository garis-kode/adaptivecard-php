<?php

declare(strict_types=1);

namespace AdaptiveCards\Element;

use AdaptiveCards\Enum\Height;
use AdaptiveCards\Enum\Spacing;
use AdaptiveCards\Node;

/**
 * Shared base for every card element. Provides the properties defined on the
 * schema's `Element` type: id, isVisible, spacing, separator, height,
 * requires and fallback.
 */
abstract class AbstractElement extends Node
{
    public function id(string $id): static
    {
        return $this->set('id', $id);
    }

    public function isVisible(bool $visible = true): static
    {
        return $this->set('isVisible', $visible);
    }

    public function spacing(string|Spacing $spacing): static
    {
        return $this->set('spacing', Spacing::value($spacing));
    }

    public function separator(bool $separator = true): static
    {
        return $this->set('separator', $separator);
    }

    public function height(string|Height $height): static
    {
        return $this->set('height', Height::value($height));
    }

    /**
     * @param array<string, string> $requires feature name => minimum version
     */
    public function requires(array $requires): static
    {
        return $this->set('requires', $requires);
    }

    /**
     * Fallback behaviour when the host cannot render this element: either the
     * literal "drop" or a replacement element.
     */
    public function fallback(string|AbstractElement $fallback): static
    {
        return $this->set('fallback', $fallback);
    }
}
