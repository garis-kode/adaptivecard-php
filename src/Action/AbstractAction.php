<?php

declare(strict_types=1);

namespace AdaptiveCards\Action;

use AdaptiveCards\Enum\ActionMode;
use AdaptiveCards\Enum\ActionStyle;
use AdaptiveCards\Node;

abstract class AbstractAction extends Node
{
    /**
     * Label for button or control.
     */
    public function title(string $title): static
    {
        return $this->set('title', $title);
    }

    /**
     * Optional icon to be shown on the action in conjunction with the title.
     * Supports data: URI in version 1.2+.
     */
    public function iconUrl(string $url): static
    {
        return $this->set('iconUrl', $url);
    }

    /**
     * Controls the icon to display on the action when toggled.
     */
    public function toggledIconUrl(string $url): static
    {
        return $this->set('iconUrl.toggled', $url);
    }

    /**
     * A unique identifier associated with this Action.
     */
    public function id(string $id): static
    {
        return $this->set('id', $id);
    }

    /**
     * Controls the style of an Action, which influences how the action is
     * displayed, spoken, etc. Valid values: "default", "positive", "destructive".
     */
    public function style(ActionStyle $style): static
    {
        return $this->set('style', $style->value);
    }

    /**
     * Defines text that should be displayed to the end user as they hover
     * the mouse over the action, and read when using narration software.
     */
    public function tooltip(string $tooltip): static
    {
        return $this->set('tooltip', $tooltip);
    }

    /**
     * Determines whether the action should be displayed as a button or in
     * the overflow menu. Valid values: "primary", "secondary".
     */
    public function mode(ActionMode $mode): static
    {
        return $this->set('mode', $mode->value);
    }

    /**
     * Determines whether the action should be enabled.
     */
    public function isEnabled(bool $enabled = true): static
    {
        return $this->set('isEnabled', $enabled);
    }

    /**
     * Defines an expression whose evaluated value will be used to update
     * the `isEnabled` property of the action at runtime.
     */
    public function isEnabledDynamic(string $expression): static
    {
        return $this->set('isEnabled.dynamic', $expression);
    }

    /**
     * Determines whether the action should be displayed.
     */
    public function isVisible(bool $visible = true): static
    {
        return $this->set('isVisible', $visible);
    }

    /**
     * Defines an expression whose evaluated value will be used to update
     * the `isVisible` property of the action at runtime.
     */
    public function isVisibleDynamic(string $expression): static
    {
        return $this->set('isVisible.dynamic', $expression);
    }

    /**
     * Defines an expression whose evaluated value will be used to update
     * the `title` property of the action at runtime.
     */
    public function titleDynamic(string $expression): static
    {
        return $this->set('title.dynamic', $expression);
    }

    /**
     * Controls the title to display on the action when toggled.
     */
    public function toggledTitle(string $title): static
    {
        return $this->set('title.toggled', $title);
    }

    /**
     * Defines an expression whose evaluated value will be used to update
     * the `tooltip` property of the action at runtime.
     */
    public function tooltipDynamic(string $expression): static
    {
        return $this->set('tooltip.dynamic', $expression);
    }

    /**
     * Controls the tooltip to display on the action when toggled.
     */
    public function toggledTooltip(string $tooltip): static
    {
        return $this->set('tooltip.toggled', $tooltip);
    }

    /**
     * A list of actions that should be displayed in a flyout menu when the user clicks this action.
     *
     * @param iterable<AbstractAction> $actions
     */
    public function menuActions(iterable $actions): static
    {
        foreach ($actions as $action) {
            $this->addMenuAction($action);
        }

        return $this;
    }

    /**
     * Add an action to the flyout menu.
     */
    public function addMenuAction(AbstractAction $action): static
    {
        return $this->push('menuActions', $action);
    }

    /**
     * Controls the icons to display on the action based on the current theme.
     *
     * @param array<string, string> $themedUrls
     */
    public function themedIconUrls(array $themedUrls): static
    {
        return $this->set('themedIconUrls', $themedUrls);
    }

    /**
     * Controls the icons to display on the action when toggled based on the current theme.
     *
     * @param array<string, string> $themedUrls
     */
    public function toggledThemedIconUrls(array $themedUrls): static
    {
        return $this->set('themedIconUrls.toggled', $themedUrls);
    }

    /**
     * Controls whether the action should be conditionally enabled based on input validation.
     */
    public function conditionallyEnabled(bool $enabled = true): static
    {
        return $this->set('conditionallyEnabled', $enabled);
    }

    /**
     * Controls the behavior of the action (e.g. "toggle").
     */
    public function behavior(string $behavior): static
    {
        return $this->set('behavior', $behavior);
    }

    /**
     * Controls the initial state of the action when behavior is "toggle".
     * Valid values: "untoggled", "toggled".
     */
    public function initialState(string $state): static
    {
        return $this->set('initialState', $state);
    }

    /**
     * A list of capabilities the action requires the host application to support.
     *
     * @param array<string, string> $requires feature name => minimum version
     */
    public function requires(array $requires): static
    {
        return $this->set('requires', $requires);
    }

    /**
     * An alternate action to render if the type of this one is unsupported or
     * if the host application doesn't support all the capabilities specified in
     * the `requires` property. Either the literal "drop" or an action.
     */
    public function fallback(string|AbstractAction $fallback): static
    {
        return $this->set('fallback', $fallback);
    }
}
