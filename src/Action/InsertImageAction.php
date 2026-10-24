<?php

declare(strict_types=1);

namespace AdaptiveCards\Action;

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

    public function url(string $url): self
    {
        return $this->set('url', $url);
    }

    public function altText(string $altText): self
    {
        return $this->set('altText', $altText);
    }

    /**
     * @param "Selection"|"Top"|"Bottom"|string $insertPosition
     */
    public function insertPosition(string $insertPosition): self
    {
        return $this->set('insertPosition', $insertPosition);
    }

    public function getType(): string
    {
        return 'Action.InsertImage';
    }
}
