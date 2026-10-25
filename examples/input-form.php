<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use AdaptiveCards\AdaptiveCard;
use AdaptiveCards\Action\SubmitAction;
use AdaptiveCards\Input\ChoiceSet\ChoiceSetInput;
use AdaptiveCards\Input\TextInput;
use AdaptiveCards\Input\ToggleInput;

/*
 * An input form that gathers values and submits them.
 * Run with:  php examples/input-form.php
 */
$card = AdaptiveCard::make()
    ->addTextBlock('Tell us about yourself', fn ($t) => $t->size('large')->weight('bolder')->wrap(true))
    ->addTextInput('name', fn (TextInput $i) => $i
        ->label('Your name')
        ->placeholder('Jane Doe')
        ->isRequired(true)
        ->errorMessage('Name is required'))
    ->addTextInput('email', fn (TextInput $i) => $i
        ->label('Email')
        ->style('email')
        ->placeholder('jane@example.com'))
    ->addChoiceSetInput('color', fn (ChoiceSetInput $i) => $i
        ->label('Favourite colour')
        ->style('expanded')
        ->choices(['Red' => 'red', 'Green' => 'green', 'Blue' => 'blue'])
        ->value('green'))
    ->addToggleInput('subscribe', 'Subscribe to the newsletter', fn (ToggleInput $i) => $i
        ->value('false'))
    ->addAction(SubmitAction::make('Submit')->associatedInputs('Auto'));

$card->validate();

echo $card->toJson(), "\n";
