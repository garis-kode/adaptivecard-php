<?php

declare(strict_types=1);

namespace AdaptiveCards\Action\OpenUrl;

use AdaptiveCards\Action\AbstractAction;
use AdaptiveCards\Enum\DialogSize;

/**
 * Opens a task module in a modal dialog hosting the content at a provided URL.
 */
final class OpenUrlDialogAction extends AbstractAction
{
    public function __construct(
        string $dialogTitle,
        string $dialogHeight,
        string $url,
        ?string $title = null,
    ) {
        $this->dialogTitle($dialogTitle);
        $this->dialogHeight($dialogHeight);
        $this->url($url);
       
        if ($title !== null) {
            $this->title($title);
        }
    }

    public static function make(
        string $dialogTitle,
        string $dialogHeight,
        string $url,
        ?string $title = null,
    ): self {
        return new self($dialogTitle, $dialogHeight, $url, $title);
    }

    /**
     * The URL of the webpage to load in the modal dialog.
     */
    public function url(string $url): self
    {
        return $this->set('url', $url);
    }

    /**
     * The title of the modal dialog.
     */
    public function dialogTitle(string $dialogTitle): self
    {
        return $this->set('dialogTitle', $dialogTitle);
    }

    /**
     * The size of the modal dialog.
     * Valid values: "small", "medium", "large".
     */
    public function dialogSize(DialogSize $dialogSize): self
    {
        return $this->set('dialogSize', $dialogSize->value);
    }

    /**
     * The width of the modal dialog in pixels.
     */
    public function dialogWidth(string $dialogWidth): self
    {
        return $this->set('dialogWidth', $dialogWidth);
    }

    /**
     * The height of the modal dialog in pixels.
     */
    public function dialogHeight(string $dialogHeight): self
    {
        return $this->set('dialogHeight', $dialogHeight);
    }

    public function getType(): string
    {
        return 'Action.OpenUrlDialog';
    }
}
