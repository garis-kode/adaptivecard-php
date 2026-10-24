<?php

declare(strict_types=1);

namespace AdaptiveCards\Element;

use AdaptiveCards\Enum\Height;
use AdaptiveCards\Enum\HorizontalAlignment;
use AdaptiveCards\Enum\Spacing;
use AdaptiveCards\Enum\TargetWidth;
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

    public function horizontalAlignment(string|HorizontalAlignment $alignment): static
    {
        return $this->set('horizontalAlignment', HorizontalAlignment::value($alignment));
    }

    public function targetWidth(string|TargetWidth $targetWidth): static
    {
        return $this->set('targetWidth', TargetWidth::value($targetWidth));
    }

    public function gridArea(string $gridArea): static
    {
        return $this->set('grid.area', $gridArea);
    }

    public function isSortKey(bool $isSortKey = true): static
    {
        return $this->set('isSortKey', $isSortKey);
    }

    public function key(string $key): static
    {
        return $this->set('key', $key);
    }

    public function lang(string $lang): static
    {
        return $this->set('lang', $lang);
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
