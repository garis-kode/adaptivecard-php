<?php

declare(strict_types=1);

namespace AdaptiveCards\Element;

use AdaptiveCards\Action\AbstractAction;

/**
 * A special type of button with an icon, title and description.
 */
final class CompoundButton extends AbstractElement
{
    public function __construct(?string $title = null, ?string $description = null)
    {
        if ($title !== null) {
            $this->title($title);
        }
        if ($description !== null) {
            $this->description($description);
        }
    }

    public static function make(?string $title = null, ?string $description = null): self
    {
        return new self($title, $description);
    }

    /**
     * The title of the button.
     */
    public function title(string $title): self
    {
        return $this->set('title', $title);
    }

    /**
     * The description of the button.
     */
    public function description(string $description): self
    {
        return $this->set('description', $description);
    }

    /**
     * Optional badge text to display on the button.
     */
    public function badge(string $badge): self
    {
        return $this->set('badge', $badge);
    }

    /**
     * The icon to display on the button.
     *
     * @param string|array{name: string, style?: string} $icon
     */
    public function icon(string|array $icon): self
    {
        if (is_string($icon)) {
            $icon = ['name' => $icon];
        }

        return $this->set('icon', $icon);
    }

    /**
     * An Action that will be invoked when the button is tapped or clicked.
     */
    public function selectAction(AbstractAction $action): self
    {
        return $this->set('selectAction', $action);
    }

    public function getType(): string
    {
        return 'CompoundButton';
    }
}
