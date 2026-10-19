<?php

declare(strict_types=1);

namespace AdaptiveCards\Tests;

use AdaptiveCards\Element\TextBlock;
use AdaptiveCards\Enum\AssociatedInputs;
use AdaptiveCards\Enum\Spacing;
use AdaptiveCards\Enum\TextSize;
use AdaptiveCards\Exception\AdaptiveCardException;
use PHPUnit\Framework\TestCase;

final class EnumTest extends TestCase
{
    public function testCoerceAcceptsStringAndEnum(): void
    {
        self::assertSame(TextSize::Large, TextSize::coerce('large'));
        self::assertSame(TextSize::Large, TextSize::coerce(TextSize::Large));
    }

    public function testValueReturnsBackingString(): void
    {
        self::assertSame('extraLarge', TextSize::value(TextSize::ExtraLarge));
        self::assertSame('padding', Spacing::value('padding'));
    }

    public function testAssociatedInputsUsesCapitalisedValues(): void
    {
        self::assertSame('Auto', AssociatedInputs::Auto->value);
        self::assertSame('None', AssociatedInputs::None->value);
    }

    public function testInvalidStringThrowsWithHelpfulMessage(): void
    {
        $this->expectException(AdaptiveCardException::class);
        $this->expectExceptionMessage('Invalid TextSize value "huge". Allowed values: default, small, medium, large, extraLarge');

        TextSize::coerce('huge');
    }

    public function testSetterAcceptsEnumCase(): void
    {
        $block = TextBlock::make('x')->size(TextSize::Medium)->toArray();

        self::assertSame('medium', $block['size']);
    }

    public function testValuesListsEveryCase(): void
    {
        self::assertSame(['default', 'small', 'medium', 'large', 'extraLarge'], TextSize::values());
    }
}
