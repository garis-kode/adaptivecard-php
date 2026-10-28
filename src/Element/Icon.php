<?php

declare(strict_types=1);

namespace AdaptiveCards\Element;

use AdaptiveCards\Action\AbstractAction;
use AdaptiveCards\Enum\Colors;
use AdaptiveCards\Enum\IconSize;
use AdaptiveCards\Enum\IconStyle;

/**
 * A standalone icon element. Icons can be picked from the vast Adaptive Card icon catalog.
 */
final class Icon extends AbstractBlockElement
{
    public static function make(): self
    {
        return new self();
    }

    /**
     * The name of the icon to display.
     */
    public function name(string $name): self
    {
        return $this->set('name', $name);
    }

    /**
     * The color of the icon.
     * Valid values: "Default", "Dark", "Light", "Accent", "Good", "Warning", "Attention".
     */
    public function color(Colors $color): self
    {
        return $this->set('color', $color->value);
    }

    /**
     * The size of the icon.
     * Valid values: "xxSmall", "xSmall", "Small", "Standard", "Medium", "Large", "xLarge", "xxLarge".
     */
    public function size(IconSize $size): self
    {
        return $this->set('size', $size->value);
    }

    /**
     * The style of the icon.
     * Valid values: "Regular", "Filled".
     */
    public function style(IconStyle $style): self
    {
        return $this->set('style', $style->value);
    }

    /**
     * An Action that will be invoked when the icon is tapped or clicked.
     * Action.ShowCard is not supported.
     * Valid values: "Action.Execute", "Action.InsertImage", "Action.OpenUrl", "Action.OpenUrlDialog",
     * "Action.Popover", "Action.ResetInputs", "Action.RunCommands", "Action.Submit", "Action.ToggleVisibility".
     */
    public function selectAction(AbstractAction $action): self
    {
        return $this->set('selectAction', $action);
    }

    public function getType(): string
    {
        return 'Icon';
    }
}
