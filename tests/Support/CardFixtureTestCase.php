<?php

declare(strict_types=1);

namespace AdaptiveCards\Tests\Support;

use AdaptiveCards\AdaptiveCard;
use PHPUnit\Framework\TestCase;

abstract class CardFixtureTestCase extends TestCase
{
    /**
     * Asserts that the card serialises to the stored JSON fixture.
     *
     * @param string $fixture Fixture name, without the ".json" extension
     */
    protected function assertMatchesFixture(AdaptiveCard $card, string $fixture): void
    {
        $path = dirname(__DIR__) . '/fixtures/cards/' . $fixture . '.json';

        self::assertFileExists($path);

        $json = file_get_contents($path);
        self::assertIsString($json);

        $expected = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        self::assertIsArray($expected);

        self::assertEquals(
            $expected,
            $card->toArray(),
            sprintf('Card output does not match the "%s" fixture.', $fixture)
        );
    }
}
