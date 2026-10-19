# Adaptive Cards PHP Builder

[![Latest Version on Packagist](https://img.shields.io/packagist/v/garis-kode/adaptivecard-php.svg?style=flat-square)](https://packagist.org/packages/garis-kode/adaptivecard-php)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![PHP Version](https://img.shields.io/badge/php-%3E%3D8.1-8892BF.svg?style=flat-square)](https://php.net)

A fluent, strictly typed PHP library for programmatically constructing Microsoft [Adaptive Cards](https://adaptivecards.io/) (v1.6) JSON payloads with built-in official schema validation.

---

## Features

- **Fluent & Declarative Builder**: Construct cards, containers, columns, tables, and actions using expressive method chains or closure-based nested builders.
- **Strictly Typed (PHP 8.1+)**: Full support for typed properties, backed enums, and constructor promotion.
- **Built-in Schema Validation**: Validates payloads directly against the bundled official Adaptive Cards v1.6 JSON Schema via `justinrainbow/json-schema`. No network calls needed.
- **Clean JSON Serialization**: Automatically strips `null` and default properties to emit compact payloads matching official .NET/JavaScript SDK output.
- **Rich Elements & Actions**: First-class support for Containers, ColumnSets, FactSets, ImageSets, Tables, Media, Inputs, and Actions (`OpenUrl`, `Submit`, `ShowCard`, `Execute`, `ToggleVisibility`).

---

## Requirements

- PHP 8.1 or higher
- `ext-json`

---

## Installation

Install the package via Composer:

```bash
composer require garis-kode/adaptivecard-php
```

---

## Quickstart

```php
use AdaptiveCards\AdaptiveCard;
use AdaptiveCards\Action\OpenUrlAction;
use AdaptiveCards\Element\TextBlock;

$card = AdaptiveCard::make()
    ->addTextBlock('Publish Adaptive Card schema', fn (TextBlock $t) => $t
        ->weight('bolder')
        ->size('medium')
        ->wrap(true)
    )
    ->addTextBlock('Now that we have defined the main rules, we need to produce a schema.')
    ->addAction(OpenUrlAction::make('Learn more', 'https://adaptivecards.io'));

// Validate against official v1.6 schema
$card->validate();

// Render JSON string
echo $card->toJson();
```

---

## Usage Examples

### 1. Columns & Layouts

```php
use AdaptiveCards\AdaptiveCard;
use AdaptiveCards\Element\Column;
use AdaptiveCards\Enum\ImageStyle;

$card = AdaptiveCard::make()
    ->addColumnSet(fn ($cs) => $cs
        ->column('auto', fn (Column $c) => $c
            ->addImage('https://adaptivecards.io/content/cats/1.png', fn ($img) => $img
                ->size('small')
                ->style(ImageStyle::Person)
                ->altText('Avatar')
            )
        )
        ->column('stretch', fn (Column $c) => $c
            ->addTextBlock('Jane Doe', fn ($t) => $t->weight('bolder')->wrap(true))
            ->addTextBlock('Software Engineer', fn ($t) => $t->isSubtle(true)->spacing('none'))
        )
    );

echo $card->toJson();
```

### 2. Interactive Input Forms

```php
use AdaptiveCards\AdaptiveCard;
use AdaptiveCards\Action\SubmitAction;
use AdaptiveCards\Input\Choice;
use AdaptiveCards\Input\ChoiceSetInput;
use AdaptiveCards\Input\TextInput;
use AdaptiveCards\Input\ToggleInput;

$card = AdaptiveCard::make()
    ->addTextBlock('Feedback Form', fn ($t) => $t->size('large')->weight('bolder'))
    ->addTextInput('name', fn (TextInput $i) => $i
        ->label('Your Name')
        ->placeholder('Jane Doe')
        ->isRequired(true)
        ->errorMessage('Name is required')
    )
    ->addTextInput('email', fn (TextInput $i) => $i
        ->label('Email Address')
        ->style('email')
    )
    ->addChoiceSetInput('rating', fn (ChoiceSetInput $c) => $c
        ->label('Rating')
        ->choices([
            Choice::make('Great', '5'),
            Choice::make('Good', '4'),
            Choice::make('Average', '3'),
        ])
        ->value('5')
    )
    ->addToggleInput('newsletter', 'Subscribe to updates', fn (ToggleInput $t) => $t
        ->value('true')
    )
    ->addAction(SubmitAction::make('Submit Feedback'));

echo $card->toJson();
```

### 3. Tables & FactSets

```php
use AdaptiveCards\AdaptiveCard;
use AdaptiveCards\Element\Table;
use AdaptiveCards\Element\TableColumnDefinition;

$card = AdaptiveCard::make()
    // FactSet
    ->addFactSet([
        'Order ID:' => '#98765',
        'Status:'   => 'Shipped',
        'Delivery:' => '2-3 business days',
    ])
    // Table
    ->addTable(fn (Table $t) => $t
        ->columns([
            TableColumnDefinition::make(2),
            TableColumnDefinition::make(1),
        ])
        ->addTextRow(['Item', 'Qty'])
        ->addTextRow(['Mechanical Keyboard', '1'])
        ->addTextRow(['USB-C Cable', '2'])
    );

echo $card->toJson();
```

---

## Schema Validation

This library bundles the official Adaptive Cards v1.6 schema and provides methods to check card compliance before sending it to clients or Microsoft Teams webhooks:

```php
// Check if card is valid (boolean)
if ($card->isValid()) {
    // Send to webhook...
}

// Inspect specific schema errors without throwing
$errors = $card->getValidationErrors();
foreach ($errors as $error) {
    echo "{$error['property']}: {$error['message']}\n";
}

// Throw ValidationException if invalid
try {
    $card->validate();
} catch (\AdaptiveCards\Exception\ValidationException $e) {
    print_r($e->getErrors());
}
```

---

## Development & Testing

Run unit tests with PHPUnit:

```bash
composer test
```

Run static analysis with PHPStan (Level 8):

```bash
composer analyse
```

Run both test and analysis checks:

```bash
composer check
```

---

## Security

If you discover any security-related issues, please open an issue or email `office@gariskode.com`.

---

## License

The MIT License (MIT). Please see [LICENSE](LICENSE) for more information.
