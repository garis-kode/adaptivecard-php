<?php

declare(strict_types=1);

namespace AdaptiveCards\Element;

use AdaptiveCards\Enum\TabSetSize;
use AdaptiveCards\Other\TabPage;

/**
 * An element that allows the end-user to navigate through pages using a tabbed interface.
 */
final class TabSet extends AbstractBlockElement
{
    public static function make(): self
    {
        return new self();
    }

    /**
     * Add a page to the tab set.
     */
    public function addPage(TabPage $page): self
    {
        return $this->push('pages', $page);
    }

    /**
     * Add multiple pages to the tab set.
     *
     * @param iterable<TabPage> $pages
     */
    public function addPages(iterable $pages): self
    {
        foreach ($pages as $page) {
            $this->addPage($page);
        }

        return $this;
    }

    /**
     * The pages in the tab set.
     * Valid values: "TabPage".
     *
     * @param iterable<TabPage> $pages
     */
    public function pages(iterable $pages): self
    {
        return $this->addPages($pages);
    }

    /**
     * Controls the size of tab icons and titles.
     * Valid values: "Small", "Medium", "Large".
     */
    public function size(TabSetSize $size): self
    {
        return $this->set('size', $size->value);
    }

    /**
     * Controls if the container should bleed into its parent. A bleeding container extends
     * into its parent's padding.
     */
    public function bleed(bool $bleed = true): self
    {
        return $this->set('bleed', $bleed);
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
        return 'TabSet';
    }
}
