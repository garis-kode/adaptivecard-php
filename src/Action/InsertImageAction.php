<?php

declare(strict_types=1);

namespace AdaptiveCards\Action;

use AdaptiveCards\Enum\InsertPosition;

/**
 * Inserts an image into the host application's canvas.
 */
final class InsertImageAction extends AbstractAction
{
    public function __construct(string $url, string $altText, ?string $title = null)
    {
        $this->url($url);
        $this->altText($altText);
      
        if ($title !== null) {
            $this->title($title);
        }
    }

    public static function make(string $url, string $altText, ?string $title = null): self
    {
        return new self($url, $altText, $title);
    }

    /**
     * URL to the image to insert.
     */
    public function url(string $url): self
    {
        return $this->set('url', $url);
    }

    /**
     * Alternative text describing the image.
     */
    public function altText(string $altText): self
    {
        return $this->set('altText', $altText);
    }

    /**
     * Controls the position where the image should be inserted.
     * Valid values: "Selection", "Top", "Bottom".
     */
    public function insertPosition(InsertPosition $insertPosition): self
    {
        return $this->set('insertPosition', $insertPosition->value);
    }

    public function getType(): string
    {
        return 'Action.InsertImage';
    }
}
