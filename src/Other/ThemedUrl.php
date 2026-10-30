<?php

declare(strict_types=1);

namespace AdaptiveCards\Other;

use AdaptiveCards\Enum\Theme;
use AdaptiveCards\Node;

/**
 * Defines a theme-specific URL.
 */
final class ThemedUrl extends Node
{
    public function __construct(?Theme $theme = null, ?string $url = null)
    {
        if ($theme !== null) {
            $this->theme($theme);
        }
        if ($url !== null) {
            $this->url($url);
        }
    }

    public static function make(?Theme $theme = null, ?string $url = null): self
    {
        return new self($theme, $url);
    }

    /**
     * The theme this URL applies to.
     * Valid values: "Light", "Dark".
     */
    public function theme(Theme $theme): self
    {
        return $this->set('theme', $theme->value);
    }

    /**
     * The URL to use for the associated theme.
     */
    public function url(string $url): self
    {
        return $this->set('url', $url);
    }

    public function getType(): ?string
    {
        return null;
    }
}
