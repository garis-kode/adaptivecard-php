<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\RichTextBlock;

use AdaptiveCards\Action\AbstractAction;
use AdaptiveCards\Element\AbstractElement;

/**
 * An inline image inside a RichTextBlock element.
 */
final class ImageRun extends AbstractElement
{
    public function __construct(string $url)
    {
        $this->url($url);
    }

    public static function make(string $url): self
    {
        return new self($url);
    }

    public function url(string $url): self
    {
        return $this->set('url', $url);
    }

    /**
     * @param "Small"|"Default"|"Medium"|"Large"|"ExtraLarge"|string $size
     */
    public function size(string $size): self
    {
        return $this->set('size', $size);
    }

    /**
     * @param "Default"|"Person"|"RoundedCorners"|string $style
     */
    public function style(string $style): self
    {
        return $this->set('style', $style);
    }

    /**
     * @param list<array{imageBaseUrl: string, mimeType: string}> $themedUrls
     */
    public function themedUrls(array $themedUrls): self
    {
        return $this->set('themedUrls', $themedUrls);
    }

    public function selectAction(AbstractAction $action): self
    {
        return $this->set('selectAction', $action);
    }

    public function getType(): string
    {
        return 'ImageRun';
    }
}
