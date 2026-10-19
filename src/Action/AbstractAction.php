<?php

declare(strict_types=1);

namespace AdaptiveCards\Action;

use AdaptiveCards\Enum\ActionMode;
use AdaptiveCards\Enum\ActionStyle;
use AdaptiveCards\Node;

/**
 * Shared base for all Action.* types: title, iconUrl, id, style, tooltip,
 * mode, isEnabled, requires and fallback.
 */
abstract class AbstractAction extends Node
{
    public function title(string $title): static
    {
        return $this->set('title', $title);
    }

    public function iconUrl(string $url): static
    {
        return $this->set('iconUrl', $url);
    }

    public function id(string $id): static
    {
        return $this->set('id', $id);
    }

    public function style(string|ActionStyle $style): static
    {
        return $this->set('style', ActionStyle::value($style));
    }

    public function tooltip(string $tooltip): static
    {
        return $this->set('tooltip', $tooltip);
    }

    public function mode(string|ActionMode $mode): static
    {
        return $this->set('mode', ActionMode::value($mode));
    }

    public function isEnabled(bool $enabled = true): static
    {
        return $this->set('isEnabled', $enabled);
    }

    /**
     * @param array<string, string> $requires feature name => minimum version
     */
    public function requires(array $requires): static
    {
        return $this->set('requires', $requires);
    }

    public function fallback(string|AbstractAction $fallback): static
    {
        return $this->set('fallback', $fallback);
    }
}
