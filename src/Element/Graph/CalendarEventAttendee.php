<?php

declare(strict_types=1);

namespace AdaptiveCards\Element\Graph;

use AdaptiveCards\Node;
use AdaptiveCards\Support\HasKey;

/**
 * Represents a calendar event attendee.
 */
final class CalendarEventAttendee extends Node
{
    use HasKey;

    public static function make(): self
    {
        return new self();
    }

    /**
     * The type of the attendee.
     */
    public function type(string $type): self
    {
        return $this->set('type', $type);
    }

    /**
     * The email address of the attendee.
     */
    public function email(string $email): self
    {
        return $this->set('email', $email);
    }

    /**
     * The name of the attendee.
     */
    public function name(string $name): self
    {
        return $this->set('name', $name);
    }

    /**
     * The status of the attendee.
     */
    public function status(string $status): self
    {
        return $this->set('status', $status);
    }

    /**
     * The title of the attendee.
     */
    public function title(string $title): self
    {
        return $this->set('title', $title);
    }

    public function getType(): ?string
    {
        return null;
    }
}
