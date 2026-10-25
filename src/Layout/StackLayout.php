<?php

declare(strict_types=1);

namespace AdaptiveCards\Layout;

/**
 * Stack layout: displays elements vertically or horizontally in order.
 */
final class StackLayout extends AbstractLayout
{
    public static function make(): self
    {
        return new self();
    }

    public function getType(): string
    {
        return 'Layout.Stack';
    }
}
