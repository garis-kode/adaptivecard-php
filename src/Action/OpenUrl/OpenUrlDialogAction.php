<?php

declare(strict_types=1);

namespace AdaptiveCards\Action\OpenUrl;

use AdaptiveCards\Action\AbstractAction;

final class OpenUrlDialogAction extends AbstractAction
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

    public function dialogTitle(string $dialogTitle): self
    {
        return $this->set('dialogTitle', $dialogTitle);
    }

    /**
     * @param "small"|"medium"|"large"|string $dialogSize
     */
    public function dialogSize(string $dialogSize): self
    {
        return $this->set('dialogSize', $dialogSize);
    }

    public function dialogWidth(string $dialogWidth): self
    {
        return $this->set('dialogWidth', $dialogWidth);
    }

    public function dialogHeight(string $dialogHeight): self
    {
        return $this->set('dialogHeight', $dialogHeight);
    }

    public function getType(): string
    {
        return 'Action.OpenUrlDialog';
    }
}
