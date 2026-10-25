<?php

declare(strict_types=1);

namespace AdaptiveCards\Shared;

use AdaptiveCards\Enum\DocumentReferenceIcon;
use AdaptiveCards\Node;

/**
 * A Document type reference.
 */
final class DocumentReference extends Node
{
    public static function make(): self
    {
        return new self();
    }

    /**
     * The title of the document.
     */
    public function title(string $title): self
    {
        return $this->set('title', $title);
    }

    /**
     * An abstract for the document.
     */
    public function abstract(string $abstract): self
    {
        return $this->set('abstract', $abstract);
    }

    /**
     * An icon representing the document.
     * Valid values: "msWord", "msExcel", "msPowerPoint", "msOneNote", "msSharePoint",
     * "msVisio", "msLoop", "msWhiteboard", "code", "sketch", "adobeIllustrator",
     * "adobePhotoshop", "adobeInDesign", "adobeFlash", "image", "gif", "video",
     * "sound", "zip", "text", "pdf".
     */
    public function icon(DocumentReferenceIcon $icon): self
    {
        return $this->set('icon', $icon->value);
    }

    /**
     * A list of up to three keywords associated with the document.
     *
     * @param list<string> $keywords
     */
    public function keywords(array $keywords): self
    {
        return $this->set('keywords', array_slice($keywords, 0, 3));
    }

    /**
     * The URL of the document.
     */
    public function url(string $url): self
    {
        return $this->set('url', $url);
    }

    public function getType(): string
    {
        return 'DocumentReference';
    }
}
