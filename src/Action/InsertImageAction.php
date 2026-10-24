<?php

declare(strict_types=1);

namespace AdaptiveCards\Action;

final class InsertImageAction extends AbstractAction
{
    public function __construct(?string $title = null, ?string $url = null)
    {
        $this->set('title', $title);
        $this->set('url', $url);
    }

    public static function make(?string $title = null, ?string $url = null): self
    {
        return new self($title, $url);
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
