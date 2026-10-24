<?php

declare(strict_types=1);

namespace AdaptiveCards\Action\OpenUrl;

use AdaptiveCards\Action\AbstractAction;

/**
 * Opens a URL in an external browser.
 */
final class OpenUrlAction extends AbstractAction
{
    public function __construct(string $title, string $url)
    {
        $this->title($title);
        $this->url($url);
    }

    public static function make(string $title, string $url): self
    {
        return new self($title, $url);
    }

    public function url(string $url): self
    {
        return $this->set('url', $url);
    }

    public function getType(): string
    {
        return 'Action.OpenUrl';
    }
}
