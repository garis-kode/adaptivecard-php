<?php

declare(strict_types=1);

namespace AdaptiveCards\Exception;

/**
 * Thrown when a card fails validation against the Adaptive Card JSON schema.
 */
class ValidationException extends AdaptiveCardException
{
    /**
     * @param list<array{property: string, message: string}> $errors
     */
    public function __construct(private array $errors, string $message = '')
    {
        if ($message === '') {
            $lines = array_map(
                static fn (array $e): string => sprintf('  - %s: %s', $e['property'] ?: '(root)', $e['message']),
                $errors
            );
            $message = "Adaptive Card failed schema validation:\n" . implode("\n", $lines);
        }

        parent::__construct($message);
    }

    /**
     * @return list<array{property: string, message: string}>
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
