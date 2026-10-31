<?php

declare(strict_types=1);

namespace AdaptiveCards\Shared;

use AdaptiveCards\Node;

/**
 * Defines a button as displayed when prompting a user to authenticate.
 */
final class AuthCardButton extends Node
{
    public function __construct(
        string $type = 'signin',
        ?string $title = null,
        ?string $value = null,
        ?string $image = null,
    ) {
        $this->type($type);
        if ($title !== null) {
            $this->title($title);
        }
        if ($value !== null) {
            $this->value($value);
        }
        if ($image !== null) {
            $this->image($image);
        }
    }

    public static function make(
        string $type = 'signin',
        ?string $title = null,
        ?string $value = null,
        ?string $image = null,
    ): self {
        return new self($type, $title, $value, $image);
    }

    /**
     *  Must be `signin`.
     */
    public function type(string $type): self
    {
        return $this->set('type', $type);
    }

    /**
     * The caption of the button.
     */
    public function title(string $title): self
    {
        return $this->set('title', $title);
    }

    /**
     * The value associated with the button. The meaning of `value` depends on the
     * button's type.
     */
    public function value(string $value): self
    {
        return $this->set('value', $value);
    }

    /**
     * A URL to an image to display alongside the button's caption.
     */
    public function image(string $image): self
    {
        return $this->set('image', $image);
    }

    public function getType(): ?string
    {
        return null;
    }
}
