<?php

declare(strict_types=1);

namespace AdaptiveCards\Action;

use AdaptiveCards\Enum\InsertPosition;
use AdaptiveCards\Support\HasMenuActions;

/**
 * Inserts an image into the host application's canvas.
 */
final class InsertImageAction extends AbstractAction
{
    use HasMenuActions;

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
     * The URL of the image to insert.
     */
    public function url(string $url): self
    {
        return $this->set('url', $url);
    }

    /**
     * The alternate text for the image.
     */
    public function altText(string $altText): self
    {
        return $this->set('altText', $altText);
    }

    /**
     * The position at which to insert the image.
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
