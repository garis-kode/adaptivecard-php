<?php

declare(strict_types=1);

namespace AdaptiveCards\Element;

use AdaptiveCards\Other\AccordionPage;
use AdaptiveCards\Support\HasHeight;

/**
 * An element that allows the end-user to toggle the display of content by expanding
 * or collapsing pages.
 */
final class Accordion extends AbstractBlockElement
{
    use HasHeight;

    public static function make(): self
    {
        return new self();
    }

    /**
     * Controls whether all accordion pages can be collapsed at the same time.
     */
    public function allowCollapseAllPages(bool $allow = true): self
    {
        return $this->set('allowCollapseAllPages', $allow);
    }

    /**
     * Controls whether multiple accordion pages can be expanded at the same time.
     */
    public function allowMultipleExpandedPages(bool $allow = true): self
    {
        return $this->set('allowMultipleExpandedPages', $allow);
    }

    /**
     * Add a page to the accordion.
     */
    public function addPage(AccordionPage $page): self
    {
        return $this->push('pages', $page);
    }

    /**
     * Add multiple pages to the accordion.
     *
     * @param iterable<AccordionPage> $pages
     */
    public function addPages(iterable $pages): self
    {
        foreach ($pages as $page) {
            $this->addPage($page);
        }

        return $this;
    }

    /**
     * The pages in the accordion.
     * Valid values: "AccordionPage".
     *
     * @param iterable<AccordionPage> $pages
     */
    public function pages(iterable $pages): self
    {
        return $this->addPages($pages);
    }

    /**
     * The minimum height, in pixels, of the container, in the `<number>px` format.
     * Valid values: "<number>px".
     */
    public function minHeight(string $minHeight): self
    {
        return $this->set('minHeight', $minHeight);
    }

    public function getType(): string
    {
        return 'Accordion';
    }
}
