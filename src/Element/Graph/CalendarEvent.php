<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Graph;

/**
 * Displays information about a calendar event.
 */
final class CalendarEvent extends AbstractGraphComponent
{
    public static function make(): self
    {
        return new self();
    }

    protected function name(): string
    {
        return 'graph.microsoft.com/event';
    }

    /**
     * The properties of the event.
     * Valid values: "CalendarEventProperties".
     */
    public function properties(CalendarEventProperties $properties): self
    {
        return $this->set('properties', $properties);
    }
}
