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
     * Title of the reference.
     */
    public function title(string $title): self
    {
        return $this->set('title', $title);
    }

    /**
     * The abstract of the reference, providing a short summary of the reference's content.
     */
    public function abstract(string $abstract): self
    {
        return $this->set('abstract', $abstract);
    }

    /**
     * Must be an Adaptive Card payload.
     */
    public function content(mixed $content): self
    {
        return $this->set('content', $content);
    }

    /**
     * Icon to be displayed in the reference.
     * Valid values: "msWord", "msExcel", "msPowerPoint", "msOneNote", "msSharePoint",
     * "msVisio", "msLoop", "msWhiteboard", "code", "sketch", "adobeIllustrator",
     * "adobePhotoshop", "adobeInDesign", "adobeFlash", "image", "gif", "video",
     * "sound", "zip", "text", "pdf".
     */
    public function icon(string $icon): self
    {
        return $this->set('icon', $icon);
    }

    /**
     * Keywords for the reference. Maximum allowed is 3.
     *
     * @param list<string> $keywords
     */
    public function keywords(array $keywords): self
    {
        return $this->set('keywords', array_slice($keywords, 0, 3));
    }

    /**
     * Optional URL for the reference title.
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
