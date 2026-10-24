<?php

declare(strict_types=1);

namespace AdaptiveCards\Shared;

use AdaptiveCards\Node;

/**
 * A reference whose content is an Adaptive Card.
 */
final class AdaptiveCardReference extends Node
{
    public static function make(): self
    {
        return new self();
    }

    public function title(string $title): self
    {
        return $this->set('title', $title);
    }

    public function abstract(string $abstract): self
    {
        return $this->set('abstract', $abstract);
    }

    public function content(mixed $content): self
    {
        return $this->set('content', $content);
    }

    public function icon(string $icon): self
    {
        return $this->set('icon', $icon);
    }

    /**
     * @param list<string> $keywords
     */
    public function keywords(array $keywords): self
    {
        return $this->set('keywords', array_slice($keywords, 0, 3));
    }

    public function url(string $url): self
    {
        return $this->set('url', $url);
    }

    public function getType(): string
    {
        return 'AdaptiveCardReference';
    }
}
