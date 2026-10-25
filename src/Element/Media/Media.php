<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Media;

use AdaptiveCards\Element\AbstractElement;

/**
 * A media element that makes it possible to embed videos inside cards.
 */
final class Media extends AbstractElement
{
    public static function make(): self
    {
        return new self();
    }

    /**
     * Add a media source URL.
     */
    public function addSource(MediaSource $source): self
    {
        return $this->push('sources', $source);
    }

    /**
     * Add a caption source URL.
     */
    public function addCaptionSource(CaptionSource $source): self
    {
        return $this->push('captionSources', $source);
    }

    /**
     * The URL of an image to display before the media plays.
     */
    public function poster(string $url): self
    {
        return $this->set('poster', $url);
    }

    /**
     * Alternative text for this media element.
     */
    public function altText(string $altText): self
    {
        return $this->set('altText', $altText);
    }

    public function getType(): string
    {
        return 'Media';
    }
}
