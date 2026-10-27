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
        DialogSize|string $dialogHeight,
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
        DialogSize|string $dialogHeight,
        string $url,
        ?string $title = null,
    ): self {
        return new self($dialogTitle, $dialogHeight, $url, $title);
    }

    /**
     * The URL to open.
     */
    public function url(string $url): self
    {
        return $this->set('url', $url);
    }

    /**
     * The title of the dialog to be displayed in the dialog header.
     */
    public function dialogTitle(string $dialogTitle): self
    {
        return $this->set('dialogTitle', $dialogTitle);
    }

    /**
     * The width of the dialog. To define width as a number of pixels, use the `<number>px` format.
     * Valid values: "small", "medium", "large", "<number>px".
     */
    public function dialogWidth(DialogSize|string $dialogWidth): self
    {
        $value = $dialogWidth instanceof DialogSize ? $dialogWidth->value : $dialogWidth;

        return $this->set('dialogWidth', $value);
    }

    /**
     * The height of the dialog. To define height as a number of pixels, use the `<number>px` format.
     * Valid values: "small", "medium", "large", "<number>px".
     */
    public function dialogHeight(DialogSize|string $dialogHeight): self
    {
        $value = $dialogHeight instanceof DialogSize ? $dialogHeight->value : $dialogHeight;

        return $this->set('dialogHeight', $value);
    }

    public function getType(): string
    {
        return 'Action.OpenUrlDialog';
    }
}
