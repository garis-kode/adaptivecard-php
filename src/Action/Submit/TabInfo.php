<?php

declare(strict_types=1);

namespace AdaptiveCards\Action\Submit;

use AdaptiveCards\Node;

/**
 * Represents information about the iFrame content, rendered in the collab stage popout window.
 */
final class TabInfo extends Node
{
    public function __construct(
        ?string $contentUrl = null,
        ?string $websiteUrl = null,
        ?string $name = null,
        ?string $entityId = null,
    ) {
        if ($contentUrl !== null) {
            $this->contentUrl($contentUrl);
        }
        if ($websiteUrl !== null) {
            $this->websiteUrl($websiteUrl);
        }
        if ($name !== null) {
            $this->name($name);
        }
        if ($entityId !== null) {
            $this->entityId($entityId);
        }
    }

    public static function make(
        ?string $contentUrl = null,
        ?string $websiteUrl = null,
        ?string $name = null,
        ?string $entityId = null,
    ): self {
        return new self($contentUrl, $websiteUrl, $name, $entityId);
    }

    /**
     * The URL to open in an iFrame.
     */
    public function contentUrl(string $url): self
    {
        return $this->set('contentUrl', $url);
    }

    /**
     * An optional website URL to the content, allowing users to open this content in the browser (if they prefer).
     */
    public function websiteUrl(string $url): self
    {
        return $this->set('websiteUrl', $url);
    }

    /**
     * The name for the content. This will be displayed as the title of the window hosting the iFrame.
     */
    public function name(string $name): self
    {
        return $this->set('name', $name);
    }

    /**
     * The unique entity id for this content (e.g., random UUID).
     */
    public function entityId(string $id): self
    {
        return $this->set('entityId', $id);
    }

    public function getType(): ?string
    {
        return null;
    }
}
