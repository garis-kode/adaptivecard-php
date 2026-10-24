<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Media;

use AdaptiveCards\Element\AbstractElement;

/**
 * Plays audio or video.
 */
final class Media extends AbstractElement
{
    public static function make(): self
    {
        return new self();
    }

    public function addSource(MediaSource $source): self
    {
        return $this->push('sources', $source);
    }

    public function addCaptionSource(CaptionSource $source): self
    {
        return $this->push('captionSources', $source);
    }

    public function poster(string $url): self
    {
        return $this->set('poster', $url);
    }

    public function altText(string $altText): self
    {
        return $this->set('altText', $altText);
    }

    public function getType(): string
    {
        return 'Media';
    }
}
