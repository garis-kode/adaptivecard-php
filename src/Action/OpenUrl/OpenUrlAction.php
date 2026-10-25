<?php

declare(strict_types=1);

namespace AdaptiveCards\Action\OpenUrl;

use AdaptiveCards\Action\AbstractAction;

/**
 * Opens the provided URL in either a separate browser tab or within the host application.
 */
final class OpenUrlAction extends AbstractAction
{
    public function __construct(string $url, ?string $title = null)
    {
        $this->url($url);

        if ($title !== null) {
            $this->title($title);
        }
    }

    public static function make(string $url, ?string $title = null): self
    {
        return new self($url, $title);
    }

    /**
     * The URL to open.
     */
    public function url(string $url): self
    {
        return $this->set('url', $url);
    }

    public function getType(): string
    {
        return 'Action.OpenUrl';
    }
}
