<?php

declare(strict_types=1);

namespace AdaptiveCards\Exception;

/**
 * Base exception for all errors raised while building an Adaptive Card,
 * e.g. an invalid enum value or a malformed property.
 */
class AdaptiveCardException extends \RuntimeException
{
}
