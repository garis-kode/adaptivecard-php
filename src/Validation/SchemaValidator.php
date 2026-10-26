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

    private static ?object $cachedSchema = null;

    private object $schema;

    public function __construct(?string $schemaPath = null)
    {
        if ($schemaPath !== null) {
            $this->schema = self::loadSchema($schemaPath);
            return;
        }

        if (self::$cachedSchema === null) {
            self::$cachedSchema = self::loadSchema(self::SCHEMA_PATH);
        }

        $this->schema = self::$cachedSchema;
    }

    private static function loadSchema(string $path): object
    {
        $contents = @file_get_contents($path);
        if ($contents === false) {
            throw new AdaptiveCardException(sprintf('Unable to read Adaptive Card schema at "%s".', $path));
        }

        $schema = json_decode($contents, false, 512, JSON_THROW_ON_ERROR);
        if (!is_object($schema)) {
            throw new AdaptiveCardException(sprintf('Adaptive Card schema at "%s" does not contain a valid JSON object.', $path));
        }

        return $schema;
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
                'justinrainbow/json-schema is not installed. Run "composer install" to install dependencies.'
            );
        }

        // Re-decode to stdClass graph, which the validator expects.
        $data = json_decode(json_encode($card, JSON_THROW_ON_ERROR), false, 512, JSON_THROW_ON_ERROR);

        $validator = new Validator();
        $validator->validate($data, $this->schema);

        $errors = [];
        /** @var list<array<string, mixed>> $rawErrors */
        $rawErrors = $validator->getErrors();
        foreach ($rawErrors as $error) {
            $property = isset($error['property']) && is_scalar($error['property']) ? (string) $error['property'] : '';
            $message = isset($error['message']) && is_scalar($error['message']) ? (string) $error['message'] : 'Unknown validation error';

            $errors[] = [
                'property' => $property,
                'message' => $message,
            ];
        }

        return $errors;
    }
}
