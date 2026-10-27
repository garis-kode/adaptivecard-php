<?php

declare(strict_types=1);

namespace AdaptiveCards\Action;

use AdaptiveCards\Enum\ActionBehavior;
use AdaptiveCards\Enum\ActionInitialState;
use AdaptiveCards\Enum\ActionMode;
use AdaptiveCards\Enum\ActionStyle;
use AdaptiveCards\Node;

abstract class AbstractAction extends Node
{
    /**
     * The title of the action, as it appears on buttons.
     */
    public function title(string $title): static
    {
        return $this->set('title', $title);
    }

    /**
     * A URL (or Base64-encoded Data URI) to a PNG, GIF, JPEG or SVG image to be displayed
     * on the left of the action's title.
     */
    public function iconUrl(string $url): static
    {
        return $this->set('iconUrl', $url);
    }

    /**
     * The icon URL to use when the action is in the toggled state. Accepts the same formats
     * as `iconUrl`. Only applies when `behavior` is set to `Toggle`.
     */
    public function toggledIconUrl(string $url): static
    {
        return $this->set('iconUrl.toggled', $url);
    }

    /**
     * A unique identifier for the element or action.
     */
    public function id(string $id): static
    {
        return $this->set('id', $id);
    }

    /**
     * Control the style of the action, affecting its visual and spoken representations.
     * Valid values: "default", "positive", "destructive".
     */
    public function style(ActionStyle $style): static
    {
        return $this->set('style', $style->value);
    }

    /**
     * The tooltip text to display when the action is hovered over.
     */
    public function tooltip(string $tooltip): static
    {
        return $this->set('tooltip', $tooltip);
    }

    /**
     * Controls if the action is primary or secondary. Secondary actions appear in an overflow menu.
     * Valid values: "primary", "secondary".
     */
    public function mode(ActionMode $mode): static
    {
        return $this->set('mode', $mode->value);
    }

    /**
     * Controls the enabled state of the action. A disabled action cannot be clicked.
     * If the action is represented as a button, the button's style will reflect this state.
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
     * Controls the visibility of the action.
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
     * The title to display when the action is in the toggled state. Only applies
     * when `behavior` is set to `Toggle`.
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
     * The tooltip to display when the action is in the toggled state. Only applies
     * when `behavior` is set to `Toggle`.
     */
    public function toggledTooltip(string $tooltip): static
    {
        return $this->set('tooltip.toggled', $tooltip);
    }

    /**
     * Add an action to the flyout menu.
     */
    public function addMenuAction(AbstractAction $action): static
    {
        return $this->push('menuActions', $action);
    }

    /**
     * Add multiple actions to the flyout menu.
     *
     * @param iterable<AbstractAction> $actions
     */
    public function addMenuActions(iterable $actions): static
    {
        foreach ($actions as $action) {
            $this->addMenuAction($action);
        }

        return $this;
    }

    /**
     * The actions to display in the overflow menu of a Split action button.
     * Valid values: "Action.Execute", "Action.InsertImage", "Action.OpenUrl", "Action.OpenUrlDialog",
     * "Action.ResetInputs", "Action.RunCommands", "Action.Submit", "Action.ToggleVisibility".
     *
     * @param iterable<AbstractAction> $actions
     */
    public function menuActions(iterable $actions): static
    {
        return $this->addMenuActions($actions);
    }

    /**
     * A set of theme-specific icon URLs.
     * Valid values: "ThemedUrl".
     *
     * @param array<string, string> $themedUrls
     */
    public function themedIconUrls(array $themedUrls): static
    {
        return $this->set('themedIconUrls', $themedUrls);
    }

    /**
     * A set of theme-specific icon URLs to use when the action is in the toggled state.
     * Only applies when `behavior` is set to `Toggle`.
     * Valid values: "ThemedUrl".
     *
     * @param array<string, string> $themedUrls
     */
    public function toggledThemedIconUrls(array $themedUrls): static
    {
        return $this->set('themedIconUrls.toggled', $themedUrls);
    }

    /**
     * Controls if the action is enabled only if at least one required input has been filled by the user.
     */
    public function conditionallyEnabled(bool $enabled = true): static
    {
        return $this->set('conditionallyEnabled', $enabled);
    }

    /**
     * Controls the behavior of the action. When set to Toggle, the action acts as a toggle
     * that alternates between the normal and toggled states each time it's executed.
     * Valid values: "Default", "Toggle".
     */
    public function behavior(ActionBehavior $behavior): static
    {
        return $this->set('behavior', $behavior->value);
    }

    /**
     * Controls the initial toggle state of the action. Only applies when `behavior` is set to `Toggle`.
     * Valid values: "Normal", "Toggled".
     */
    public function initialState(ActionInitialState $state): static
    {
        return $this->set('initialState', $state->value);
    }

    /**
     * A list of capabilities the element requires the host application to support.
     * If the host application doesn't support at least one of the listed capabilities,
     * the element is not rendered (or its fallback is rendered if provided).
     * Valid values: "HostCapabilities".
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
