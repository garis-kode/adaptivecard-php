<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

use AdaptiveCards\Exception\AdaptiveCardException;

trait EnumValue
{
    /**
     * Coerce a string or enum case into the enum, throwing on an unknown value.
     */
    public static function coerce(string|self $value): self
    {
        if ($value instanceof self) {
            return $value;
        }

        $resolved = self::tryFrom($value);
        if ($resolved === null) {
            throw new AdaptiveCardException(sprintf(
                'Invalid %s value "%s". Allowed values: %s',
                (new \ReflectionClass(self::class))->getShortName(),
                $value,
                implode(', ', self::values())
            ));
        }

        return $resolved;
    }

    /**
     * Normalise a string|enum into the raw JSON string value.
     */
    public static function value(string|self $value): string
    {
        return self::coerce($value)->value;
    }

    /**
     * @return list<string>
     */
    public static function values(): array
    {
        return array_map(static fn (self $case): string => $case->value, self::cases());
    }
}
