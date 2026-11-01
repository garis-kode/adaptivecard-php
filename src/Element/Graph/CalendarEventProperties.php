<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Graph;

use AdaptiveCards\Node;
use AdaptiveCards\Support\HasKey;

/**
 * The properties of a calendar event.
 */
final class CalendarEventProperties extends Node
{
    use HasKey;

    public static function make(): self
    {
        return new self();
    }

    /**
     * Add attendees to the event (accepts a single item or an iterable of items).
     * Valid values: "CalendarEventAttendee".
     *
     * @param CalendarEventAttendee|iterable<CalendarEventAttendee> $attendee
     */
    public function addAttendees(CalendarEventAttendee|iterable $attendee): self
    {
        if (is_iterable($attendee)) {
            foreach ($attendee as $item) {
                $this->push('attendees', $item);
            }

            return $this;
        }

        return $this->push('attendees', $attendee);
    }

    /**
     * The end date and time of the event.
     */
    public function end(string $end): self
    {
        return $this->set('end', $end);
    }

    /**
     * The extension of the event.
     */
    public function extension(string $extension): self
    {
        return $this->set('extension', $extension);
    }

    /**
     * The ID of the event.
     */
    public function id(string $id): self
    {
        return $this->set('id', $id);
    }

    /**
     * Indicates if the event is all day.
     */
    public function isAllDay(bool $isAllDay = true): self
    {
        return $this->set('isAllDay', $isAllDay);
    }

    /**
     * Add locations to the event (accepts a single item or an iterable of items).
     *
     * @param string|iterable<string> $location
     */
    public function addLocations(string|iterable $location): self
    {
        if (is_iterable($location)) {
            foreach ($location as $item) {
                $this->push('locations', $item);
            }

            return $this;
        }

        return $this->push('locations', $location);
    }

    /**
     * The URL of the online meeting.
     */
    public function onlineMeetingUrl(string $onlineMeetingUrl): self
    {
        return $this->set('onlineMeetingUrl', $onlineMeetingUrl);
    }

    /**
     * The organizer of the event.
     * Valid values: "CalendarEventAttendee".
     */
    public function organizer(CalendarEventAttendee $organizer): self
    {
        return $this->set('organizer', $organizer);
    }

    /**
     * The start date and time of the event.
     */
    public function start(string $start): self
    {
        return $this->set('start', $start);
    }

    /**
     * The status of the event.
     */
    public function status(string $status): self
    {
        return $this->set('status', $status);
    }

    /**
     * The title of the event.
     */
    public function title(string $title): self
    {
        return $this->set('title', $title);
    }

    /**
     * The URL of the event.
     */
    public function url(string $url): self
    {
        return $this->set('url', $url);
    }

    public function getType(): ?string
    {
        return null;
    }
}
