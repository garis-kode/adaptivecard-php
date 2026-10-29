<?php

declare(strict_types=1);

namespace AdaptiveCards\Action\Submit;

use AdaptiveCards\Node;

/**
 * Data for invoking a collaboration stage action.
 */
final class CollabStageInvokeDataValue extends Node
{
    public function __construct(?TabInfo $tabInfo = null)
    {
        if ($tabInfo !== null) {
            $this->tabInfo($tabInfo);
        }
    }

    public static function make(?TabInfo $tabInfo = null): self
    {
        return new self($tabInfo);
    }

    /**
     * Provides information about the iFrame content, rendered in the collab stage popout window.
     * Valid values: "TabInfo".
     */
    public function tabInfo(TabInfo $tabInfo): self
    {
        return $this->set('tabInfo', $tabInfo);
    }

    public function getType(): string
    {
        return 'tab/tabInfoAction';
    }
}
