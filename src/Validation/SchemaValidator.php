<?php

declare(strict_types=1);

namespace AdaptiveCards\Validation;

use AdaptiveCards\Exception\AdaptiveCardException;
use JsonSchema\Validator;

/**
 * Validates a card payload against the bundled Adaptive Card 1.6 JSON schema
 * (a verbatim copy of schemas/1.6.0/adaptive-card.json from this repo).
 */
final class SchemaValidator
{
    private const SCHEMA_PATH = __DIR__ . '/../Resources/adaptive-card-1.6.json';

    private object $schema;

    public function __construct(?string $schemaPath = null)
    {
        $path = $schemaPath ?? self::SCHEMA_PATH;
        $contents = @file_get_contents($path);
        if ($contents === false) {
            throw new AdaptiveCardException(sprintf('Unable to read Adaptive Card schema at "%s".', $path));
        }

        $this->schema = json_decode($contents, false, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * Validate a card array and return any schema violations.
     *
     * @param array<string, mixed> $card
     * @return list<array{property: string, message: string}>
     */
    public function validate(array $card): array
    {
        if (!class_exists(Validator::class)) {
            throw new AdaptiveCardException(
                'justinrainbow/json-schema is not installed. Run "composer install" in source/php.'
            );
        }

        // Re-decode to stdClass graph, which the validator expects.
        $data = json_decode(json_encode($card, JSON_THROW_ON_ERROR), false, 512, JSON_THROW_ON_ERROR);

        $validator = new Validator();
        $validator->validate($data, $this->schema);

        $errors = [];
        foreach ($validator->getErrors() as $error) {
            $errors[] = [
                'property' => (string) ($error['property'] ?? ''),
                'message' => (string) ($error['message'] ?? 'Unknown validation error'),
            ];
        }

        return $errors;
    }
}
