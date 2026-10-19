<?php

declare(strict_types=1);

namespace AdaptiveCards\Element;

/**
 * Plays audio or video.
 */
final class Media extends AbstractElement
{
    public static function make(): self
    {
        return new self();
    }

    public function addSource(MediaSource|string $source, ?string $mimeType = null): self
    {
        return $this->push('sources', $source instanceof MediaSource ? $source : new MediaSource($source, $mimeType));
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
