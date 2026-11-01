<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Graph;

use AdaptiveCards\Element\AbstractBlockElement;
use AdaptiveCards\Support\HasHeight;
use AdaptiveCards\Support\HasHorizontalAlignment;
use AdaptiveCards\Support\HasSpacing;

abstract class AbstractGraphComponent extends AbstractBlockElement
{
    use HasHeight, HasHorizontalAlignment, HasSpacing;

    public function __construct()
    {
        $this->set('name', $this->name());
    }

    abstract protected function name(): string;

    public function getType(): string
    {
        return 'Component';
    }
}
