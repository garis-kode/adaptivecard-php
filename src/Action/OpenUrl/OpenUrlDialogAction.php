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
        string|DialogSize $dialogHeight,
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
        string|DialogSize $dialogHeight,
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
     * The width of the dialog.
     * Valid values: "small", "medium", "large", "<number>px".
     */
    public function dialogWidth(string|DialogSize $dialogWidth): self
    {
        return $this->set('dialogWidth', $dialogWidth instanceof DialogSize ? $dialogWidth->value : $dialogWidth);
    }

    /**
     * The height of the dialog.
     * Valid values: "small", "medium", "large", "<number>px".
     */
    public function dialogHeight(string|DialogSize $dialogHeight): self
    {
        return $this->set('dialogHeight', $dialogHeight instanceof DialogSize ? $dialogHeight->value : $dialogHeight);
    }

    public function getType(): string
    {
        return 'Action.OpenUrlDialog';
    }
}
