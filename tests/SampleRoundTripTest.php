<?php

declare(strict_types=1);

namespace AdaptiveCards\Tests;

use AdaptiveCards\AdaptiveCard;
use AdaptiveCards\Action\OpenUrlAction;
use AdaptiveCards\Element\Column;
use AdaptiveCards\Enum\ImageStyle;
use AdaptiveCards\Validation\SchemaValidator;
use PHPUnit\Framework\TestCase;

/**
 * Proves the builder produces schema-valid JSON by (a) validating canonical
 * samples shipped in this repo against our bundled schema, and (b) rebuilding
 * an equivalent card with the fluent API and asserting it validates too.
 */
final class SampleRoundTripTest extends TestCase
{
    private const REPO_ROOT = __DIR__ . '/../../..';

    private SchemaValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new SchemaValidator();
    }

    /**
     * @return array<string, array{string}>
     */
    public static function sampleProvider(): array
    {
        return [
            'ActivityUpdate' => ['/samples/v1.5/Scenarios/ActivityUpdate.json'],
            'TextBlock.Style' => ['/samples/v1.5/Elements/TextBlock.Style.json'],
        ];
    }

    /**
     * @dataProvider sampleProvider
     */
    public function testRepoSamplesValidateAgainstBundledSchema(string $relativePath): void
    {
        $path = self::REPO_ROOT . $relativePath;
        self::assertFileExists($path, "Sample not found: {$relativePath}");

        $card = json_decode((string) file_get_contents($path), true, 512, JSON_THROW_ON_ERROR);

        self::assertSame([], $this->validator->validate($card));
    }

    public function testRebuiltActivityUpdateIsValid(): void
    {
        // Equivalent of samples/v1.5/Scenarios/ActivityUpdate.json, built fluently.
        $card = AdaptiveCard::make()
            ->addTextBlock('Publish Adaptive Card schema', fn ($t) => $t
                ->weight('bolder')->size('medium')->wrap(true)->style('heading'))
            ->addColumnSet(fn ($cs) => $cs
                ->column('auto', fn (Column $c) => $c
                    ->addImage('https://adaptivecards.io/content/cats/1.png', fn ($img) => $img
                        ->size('small')->style(ImageStyle::Person)->altText('Matt Hidinger')))
                ->column('stretch', fn (Column $c) => $c
                    ->addTextBlock('Matt Hidinger', fn ($t) => $t->weight('bolder')->wrap(true))
                    ->addTextBlock('Created today', fn ($t) => $t->isSubtle(true)->spacing('none')->wrap(true))))
            ->addFactSet([
                'Board:' => 'Adaptive Cards',
                'List:' => 'Backlog',
                'Assigned to:' => 'Matt Hidinger',
            ])
            ->addAction(OpenUrlAction::make('View', 'https://adaptivecards.io'));

        self::assertSame([], $card->getValidationErrors());
        self::assertTrue($card->isValid());
    }
}
