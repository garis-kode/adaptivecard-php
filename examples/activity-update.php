<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use AdaptiveCards\AdaptiveCard;
use AdaptiveCards\Action\OpenUrl\OpenUrlAction;
use AdaptiveCards\Element\Column\Column;
use AdaptiveCards\Enum\ImageSize;
use AdaptiveCards\Enum\ImageStyle;
use AdaptiveCards\Enum\Spacing;
use AdaptiveCards\Enum\TextBlockStyle;
use AdaptiveCards\Enum\TextSize;
use AdaptiveCards\Enum\TextWeight;

/*
 * A richer card using a ColumnSet (avatar + author), a FactSet and actions —
 * modelled after samples/v1.5/Scenarios/ActivityUpdate.json.
 *
 * Run with:  php examples/activity-update.php
 */
$card = AdaptiveCard::make()
    ->addTextBlock('Publish Adaptive Card schema', fn ($t) => $t
        ->weight(TextWeight::Bolder)
        ->size(TextSize::Medium)
        ->wrap(true)
        ->style(TextBlockStyle::Heading))
    ->addColumnSet(fn ($cs) => $cs
        ->column('auto', fn (Column $c) => $c
            ->addImage('https://adaptivecards.io/content/cats/1.png', fn ($img) => $img
                ->size(ImageSize::Small)
                ->style(ImageStyle::Person)
                ->altText('Matt Hidinger')))
        ->column('stretch', fn (Column $c) => $c
            ->addTextBlock('Matt Hidinger', fn ($t) => $t->weight(TextWeight::Bolder)->wrap(true))
            ->addTextBlock('Created today', fn ($t) => $t->isSubtle(true)->spacing(Spacing::None)->wrap(true))))
    ->addFactSet([
        'Board:' => 'Adaptive Cards',
        'List:' => 'Backlog',
        'Assigned to:' => 'Matt Hidinger',
        'Due date:' => 'Not set',
    ])
    ->addAction(OpenUrlAction::make('https://adaptivecards.io', 'View'));

$card->validate();

echo $card->toJson(), "\n";
