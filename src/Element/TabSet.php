<?php

declare(strict_types=1);

namespace AdaptiveCards\Element;

use AdaptiveCards\Enum\TabSetSize;
use AdaptiveCards\Other\TabPage;
use AdaptiveCards\Support\HasHeight;
use AdaptiveCards\Support\HasSpacing;

/**
 * An element that allows the end-user to navigate through pages using a tabbed interface.
 */
final class TabSet extends AbstractBlockElement
{
    use HasHeight;
    use HasSpacing;

    public static function make(): self
    {
        return new self();
    }

    /**
     * Add a page to the tab set.
     *
     * @param TabPage|iterable<TabPage> $page
     */
    public function addPages(TabPage|iterable $page): self
    {
        if (is_iterable($page)) {
            foreach ($page as $item) {
                $this->push('pages', $item);
            }

            return $this;
        }

        return $this->push('pages', $page);
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
