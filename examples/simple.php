<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use AdaptiveCards\AdaptiveCard;
use AdaptiveCards\Action\OpenUrl\OpenUrlAction;

/*
 * The smallest useful card: a heading, a paragraph and a link action.
 * Run with:  php examples/simple.php
 */
$card = AdaptiveCard::make()
    ->addTextBlock('Publish Adaptive Card schema', fn ($t) => $t
        ->size('medium')
        ->weight('bolder')
        ->wrap(true))
    ->addTextBlock('Now that we have defined the main rules and features of the format, '
        . 'we need to produce a schema and publish it.', fn ($t) => $t->wrap(true))
    ->addAction(OpenUrlAction::make('Learn more', 'https://adaptivecards.io'));

// Validate against the bundled 1.6 schema before printing (throws on error).
$card->validate();

echo $card->toJson(), "\n";
