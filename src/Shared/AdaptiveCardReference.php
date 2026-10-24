<?php

declare(strict_types=1);

namespace AdaptiveCards\Shared;

use AdaptiveCards\Node;

/**
 * A type of reference whose content is an Adaptive Card.
 */
final class AdaptiveCardReference extends Node
{
    public static function make(): self
    {
        return new self();
    }

    /**
     * The title of the reference.
     */
    public function title(string $title): self
    {
        return $this->set('title', $title);
    }

    /**
     * An abstract for the reference.
     */
    public function abstract(string $abstract): self
    {
        return $this->set('abstract', $abstract);
    }

    /**
     * The Adaptive Card content of the reference.
     */
    public function content(mixed $content): self
    {
        return $this->set('content', $content);
    }

    /**
     * An icon representing the reference.
     */
    public function icon(string $icon): self
    {
        return $this->set('icon', $icon);
    }

    /**
     * A list of up to three keywords associated with the reference.
     *
     * @param list<string> $keywords
     */
    public function keywords(array $keywords): self
    {
        return $this->set('keywords', array_slice($keywords, 0, 3));
    }

    /**
     * The URL of the reference.
     */
    public function url(string $url): self
    {
        return $this->set('url', $url);
    }

    public function getType(): string
    {
        return 'AdaptiveCardReference';
    }
}
