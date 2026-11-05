<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\RichTextBlock;

use AdaptiveCards\Action\AbstractAction;
use AdaptiveCards\Element\AbstractInlineElement;
use AdaptiveCards\Enum\ImageStyle;
use AdaptiveCards\Enum\TextSize;
use AdaptiveCards\Other\ThemedUrl;

/**
 * An inline image inside a RichTextBlock element.
 */
final class ImageRun extends AbstractInlineElement
{
    public function __construct(string $url)
    {
        $this->url($url);
    }

    public static function make(string $url): self
    {
        return new self($url);
    }

    /**
     * The URL (or Base64-encoded Data URI) of the image. Acceptable formats are PNG, JPEG, GIF and SVG.
     */
    public function url(string $url): self
    {
        return $this->set('url', $url);
    }

    /**
     * The size of the inline image.
     * Valid values: "Small", "Default", "Medium", "Large", "ExtraLarge".
     */
    public function size(TextSize $size): self
    {
        return $this->set('size', $size->value);
    }

    /**
     * The style of the inline image.
     * Valid values: "Default", "Person", "RoundedCorners".
     */
    public function style(ImageStyle $style): self
    {
        return $this->set('style', $style->value);
    }

    /**
     * Add a theme-specific image URLs.
     *
     * @param ThemedUrl|iterable<ThemedUrl> $themedUrl
     */
    public function addThemedUrls(ThemedUrl|iterable $themedUrl): self
    {
        if (is_iterable($themedUrl)) {
            foreach ($themedUrl as $item) {
                $this->push('themedUrls', $item);
            }

            return $this;
        }

        return $this->push('themedUrls', $themedUrl);
    }

    /**
     * A set of theme-specific image URLs.
     * Valid values: "ThemedUrl".
     *
     * @param iterable<ThemedUrl> $themedUrls
     */
    public function themedUrls(iterable $themedUrls): self
    {
        return $this->addThemedUrls($themedUrls);
    }

    /**
     * An Action that will be invoked when the image is tapped or clicked.
     * Action.ShowCard is not supported.
     * Valid values: "Action.Execute", "Action.InsertImage", "Action.OpenUrl", "Action.OpenUrlDialog",
     * "Action.Popover", "Action.ResetInputs", "Action.RunCommands", "Action.Submit", "Action.ToggleVisibility".
     */
    public function selectAction(AbstractAction $action): self
    {
        return $this->set('selectAction', $action);
    }

    public function getType(): string
    {
        return 'ImageRun';
    }
}
