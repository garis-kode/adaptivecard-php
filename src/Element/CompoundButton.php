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
        $this->set('title', $title);
        $this->set('description', $description);
    }

    public static function make(?string $title = null, ?string $description = null): self
    {
        return new self($title, $description);
    }

    public function title(string $title): self
    {
        return $this->set('title', $title);
    }

    public function description(string $description): self
    {
        return $this->set('description', $description);
    }

    public function badge(string $badge): self
    {
        return $this->set('badge', $badge);
    }

    /**
     * @param string|array{name: string, style?: string} $icon
     */
    public function icon(string|array $icon): self
    {
        if (is_string($icon)) {
            $icon = ['name' => $icon];
        }

        return $this->set('icon', $icon);
    }

    public function selectAction(AbstractAction $action): self
    {
        return $this->set('selectAction', $action);
    }

    public function getType(): string
    {
        return 'CompoundButton';
    }
}
