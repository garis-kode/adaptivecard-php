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

    public function toggledIconUrl(string $url): static
    {
        return $this->set('iconUrl.toggled', $url);
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

    public function isEnabledDynamic(string $expression): static
    {
        return $this->set('isEnabled.dynamic', $expression);
    }

    public function isVisible(bool $visible = true): static
    {
        return $this->set('isVisible', $visible);
    }

    public function isVisibleDynamic(string $expression): static
    {
        return $this->set('isVisible.dynamic', $expression);
    }

    public function titleDynamic(string $expression): static
    {
        return $this->set('title.dynamic', $expression);
    }

    public function toggledTitle(string $title): static
    {
        return $this->set('title.toggled', $title);
    }

    public function tooltipDynamic(string $expression): static
    {
        return $this->set('tooltip.dynamic', $expression);
    }

    public function toggledTooltip(string $tooltip): static
    {
        return $this->set('tooltip.toggled', $tooltip);
    }

    /**
     * @param iterable<AbstractAction> $actions
     */
    public function menuActions(iterable $actions): static
    {
        foreach ($actions as $action) {
            $this->addMenuAction($action);
        }

        return $this;
    }

    public function addMenuAction(AbstractAction $action): static
    {
        return $this->push('menuActions', $action);
    }

    /**
     * @param array<string, string> $themedUrls
     */
    public function themedIconUrls(array $themedUrls): static
    {
        return $this->set('themedIconUrls', $themedUrls);
    }

    /**
     * @param array<string, string> $themedUrls
     */
    public function toggledThemedIconUrls(array $themedUrls): static
    {
        return $this->set('themedIconUrls.toggled', $themedUrls);
    }

    public function conditionallyEnabled(bool $enabled = true): static
    {
        return $this->set('conditionallyEnabled', $enabled);
    }

    public function behavior(string $behavior): static
    {
        return $this->set('behavior', $behavior);
    }

    public function initialState(string $state): static
    {
        return $this->set('initialState', $state);
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
