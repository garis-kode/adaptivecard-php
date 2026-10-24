<?php

declare(strict_types=1);

namespace AdaptiveCards\Shared;

use AdaptiveCards\Node;

/**
 * A button displayed in an Authentication prompt. Has no `type` discriminator in Adaptive Card schema.
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

    public function type(string $type): self
    {
        return $this->set('type', $type);
    }

    public function title(string $title): self
    {
        return $this->set('title', $title);
    }

    public function value(string $value): self
    {
        return $this->set('value', $value);
    }

    public function image(string $image): self
    {
        return $this->set('image', $image);
    }

    public function getType(): ?string
    {
        return null;
    }
}
