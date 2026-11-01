<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Media;

use AdaptiveCards\Element\AbstractBlockElement;
use AdaptiveCards\Support\HasHeight;
use AdaptiveCards\Support\HasSpacing;

/**
 * A media element that makes it possible to embed videos inside a card.
 */
final class Media extends AbstractBlockElement
{
    use HasHeight, HasSpacing;

    public static function make(): self
    {
        return new self();
    }

    /**
     * Add a media source URL.
     *
     * @param MediaSource|iterable<MediaSource> $source
     */
    public function addSources(MediaSource|iterable $source): self
    {
        if (is_iterable($source)) {
            foreach ($source as $item) {
                $this->push('sources', $item);
            }

            return $this;
        }

        return $this->push('sources', $source);
    }

    /**
     * The sources for the media. For YouTube, Dailymotion and Vimeo, only one source can be specified.
     * Valid values: "MediaSource".
     *
     * @param iterable<MediaSource> $sources
     */
    public function sources(iterable $sources): self
    {
        return $this->addSources($sources);
    }

    /**
     * Add a caption source URL.
     *
     * @param CaptionSource|iterable<CaptionSource> $source
     */
    public function addCaptionSources(CaptionSource|iterable $source): self
    {
        if (is_iterable($source)) {
            foreach ($source as $item) {
                $this->push('captionSources', $item);
            }

            return $this;
        }

        return $this->push('captionSources', $source);
    }

    /**
     * The caption sources for the media. Caption sources are not used for YouTube, Dailymotion or Vimeo sources.
     * Valid values: "CaptionSource".
     *
     * @param iterable<CaptionSource> $captionSources
     */
    public function captionSources(iterable $captionSources): self
    {
        return $this->addCaptionSources($captionSources);
    }

    /**
     * The URL of the poster image to display.
     */
    public function poster(string $url): self
    {
        return $this->set('poster', $url);
    }

    /**
     * The alternate text for the media, used for accessibility purposes.
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
