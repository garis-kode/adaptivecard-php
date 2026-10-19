<?php

declare(strict_types=1);

namespace AdaptiveCards\Tests;

use AdaptiveCards\AdaptiveCard;
use AdaptiveCards\Action\SubmitAction;
use AdaptiveCards\Element\TextBlock;
use AdaptiveCards\Exception\ValidationException;
use AdaptiveCards\Input\TextInput;
use PHPUnit\Framework\TestCase;

final class ValidationTest extends TestCase
{
    public function testWellFormedCardIsValid(): void
    {
        $card = AdaptiveCard::make()
            ->addTextBlock('Hello', fn (TextBlock $t) => $t->wrap(true))
            ->addTextInput('name', fn (TextInput $i) => $i->label('Name')->isRequired(true)->errorMessage('Required'))
            ->addAction(SubmitAction::make('OK'));

        self::assertTrue($card->isValid());
        self::assertSame([], $card->getValidationErrors());
        self::assertSame($card, $card->validate());
    }

    public function testInvalidEnumValueFailsSchemaValidation(): void
    {
        $card = AdaptiveCard::make();
        $card->addItem(TextBlock::make('hi')->setProperty('size', 'humongous'));

        self::assertFalse($card->isValid());

        $this->expectException(ValidationException::class);
        $card->validate();
    }

    public function testMissingRequiredPropertyFailsValidation(): void
    {
        // Build a card, then strip the required `text` off its TextBlock to
        // simulate a malformed payload.
        $block = TextBlock::make('temp')->setProperty('text', 'temp');
        $card = AdaptiveCard::make()->addItem($block);

        $array = $card->toArray();
        unset($array['body'][0]['text']);

        $errors = (new \AdaptiveCards\Validation\SchemaValidator())->validate($array);

        self::assertNotEmpty($errors);
    }

    public function testValidationExceptionCarriesErrorList(): void
    {
        $card = AdaptiveCard::make();
        $card->addItem(TextBlock::make('hi')->setProperty('weight', 'nope'));

        try {
            $card->validate();
            self::fail('Expected ValidationException');
        } catch (ValidationException $e) {
            self::assertNotEmpty($e->getErrors());
            self::assertArrayHasKey('message', $e->getErrors()[0]);
        }
    }
}
