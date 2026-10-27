<h1 align="center">garis-kode/adaptivecard-php</h1>

<p align="center">
    <strong>Microsoft Adaptive Cards builder for PHP</strong>
</p>

<p align="center">
    <a href="https://packagist.org/packages/garis-kode/adaptivecard-php"><img src="https://img.shields.io/packagist/v/garis-kode/adaptivecard-php.svg?style=flat-square" alt="Latest Version on Packagist"></a>
    <a href="LICENSE"><img src="https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square" alt="Software License"></a>
    <a href="https://php.net"><img src="https://img.shields.io/badge/php-%3E%3D8.1-8892BF.svg?style=flat-square" alt="PHP Version"></a>
    <a href="https://packagist.org/packages/garis-kode/adaptivecard-php"><img src="https://img.shields.io/packagist/dt/garis-kode/adaptivecard-php.svg?style=flat-square" alt="Total Downloads"></a>
</p>

---

## Overview

A fluent, fully typed PHP builder for Microsoft Adaptive Cards.

---

## Requirements

- **PHP**: `>= 8.1`
- **Extensions**: `ext-json`

---

## Installation

Install the package via Composer:

```bash
composer require garis-kode/adaptivecard-php
```

---

## Quick Start

Create an Adaptive Card with a formatted text block and an action button, and export to JSON:

```php
<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use AdaptiveCards\Action\OpenUrl\OpenUrlAction;
use AdaptiveCards\AdaptiveCard;
use AdaptiveCards\Element\TextBlock;
use AdaptiveCards\Enum\TextSize;
use AdaptiveCards\Enum\TextWeight;

$card = AdaptiveCard::make('1.6') // Version defaults to '1.6' if omitted
    ->addTextBlock('Hello from Adaptive Cards!', function (TextBlock $t): void {
        $t->size(TextSize::Large)
            ->weight(TextWeight::Bolder);
    })
    ->addAction(OpenUrlAction::make('https://adaptivecards.io/', 'Learn More'));

// Output JSON string
echo $card->toJson();
```

### Expected Output

```json
{
    "$schema": "http://adaptivecards.io/schemas/adaptive-card.json",
    "type": "AdaptiveCard",
    "version": "1.6",
    "body": [
        {
            "type": "TextBlock",
            "text": "Hello from Adaptive Cards!",
            "size": "Large",
            "weight": "Bolder"
        }
    ],
    "actions": [
        {
            "type": "Action.OpenUrl",
            "url": "https://adaptivecards.io/",
            "title": "Learn More"
        }
    ]
}
```

---

## Documentation

For comprehensive schema specifications, interactive designer, and payload samples, refer to the official [Adaptive Cards Documentation](https://adaptivecards.microsoft.com/).

---

## Changelog

This project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html). For a complete record of updates and release notes, visit the [GitHub Releases](https://github.com/garis-kode/adaptivecard-php/releases) page.

---

## License & Credits

- **License**: Released under the [MIT License](LICENSE). Copyright &copy; 2026 [Garis Kode](https://github.com/garis-kode).
- **Adaptive Cards Specification**: Adaptive Cards is an open card exchange format developed by Microsoft. Learn more at [Adaptive Cards](https://adaptivecards.microsoft.com).
