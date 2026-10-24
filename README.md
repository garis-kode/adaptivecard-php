# Adaptive Cards Builder for PHP

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
use AdaptiveCards\Enum\TextSize;
use AdaptiveCards\Enum\TextWeight;

$card = AdaptiveCard::make()
    ->addTextBlock('Publish Adaptive Card schema', fn (TextBlock $t) => $t
        ->weight(TextWeight::Bolder)
        ->size(TextSize::Medium)
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
use AdaptiveCards\Enum\ImageSize;
use AdaptiveCards\Enum\ImageStyle;
use AdaptiveCards\Enum\Spacing;
use AdaptiveCards\Enum\TextWeight;

$card = AdaptiveCard::make()
    ->addColumnSet(fn ($cs) => $cs
        ->column('auto', fn (Column $c) => $c
            ->addImage('https://adaptivecards.io/content/cats/1.png', fn ($img) => $img
                ->size(ImageSize::Small)
                ->style(ImageStyle::Person)
                ->altText('Avatar')
            )
        )
        ->column('stretch', fn (Column $c) => $c
            ->addTextBlock('Jane Doe', fn ($t) => $t->weight(TextWeight::Bolder)->wrap(true))
            ->addTextBlock('Software Engineer', fn ($t) => $t->isSubtle(true)->spacing(Spacing::None))
        )
    );

echo $card->toJson();
```

### 2. Interactive Input Forms

```php
use AdaptiveCards\AdaptiveCard;
use AdaptiveCards\Action\SubmitAction;
use AdaptiveCards\Enum\TextInputStyle;
use AdaptiveCards\Enum\TextSize;
use AdaptiveCards\Enum\TextWeight;
use AdaptiveCards\Input\Choice;
use AdaptiveCards\Input\ChoiceSetInput;
use AdaptiveCards\Input\TextInput;
use AdaptiveCards\Input\ToggleInput;

$card = AdaptiveCard::make()
    ->addTextBlock('Feedback Form', fn ($t) => $t->size(TextSize::Large)->weight(TextWeight::Bolder))
    ->addTextInput('name', fn (TextInput $i) => $i
        ->label('Your Name')
        ->placeholder('Jane Doe')
        ->isRequired(true)
        ->errorMessage('Name is required')
    )
    ->addTextInput('email', fn (TextInput $i) => $i
        ->label('Email Address')
        ->style(TextInputStyle::Email)
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

## Component Reference

Every Adaptive Cards v1.6 component is available as a strictly typed class with a static `make()` factory and fluent setters that return `$this` for chaining. This section documents each one with a short snippet and its properties.

**Conventions used throughout:**

- Enum-backed setters strictly accept the backed enum case — e.g. `->size(TextSize::Large)`.
- Container-like types (`AdaptiveCard`, `Container`, `Column`, `TableCell`) share the `addTextBlock()`, `addImage()`, `addContainer()`, … builder helpers (see [Builder Helpers](#builder-helpers)). Each `add*` helper accepts an optional trailing closure that receives the newly created, typed child for configuration.
- All snippets assume a `$card = AdaptiveCard::make()` and the relevant `use` imports.

**Contents**

- [The Card](#the-card) · [Builder Helpers](#builder-helpers) · [Common Properties](#common-properties)
- **Elements** — [TextBlock](#textblock) · [RichTextBlock](#richtextblock) · [Image](#image) · [ImageSet](#imageset) · [Media](#media)
- **Containers & Layout** — [Container](#container) · [ColumnSet & Column](#columnset--column) · [FactSet](#factset) · [Table](#table) · [ActionSet](#actionset)
- **Actions** — [Action.OpenUrl](#actionopenurl) · [Action.Submit](#actionsubmit) · [Action.ShowCard](#actionshowcard) · [Action.Execute](#actionexecute) · [Action.ToggleVisibility](#actiontogglevisibility)
- **Inputs** — [Input.Text](#inputtext) · [Input.Number](#inputnumber) · [Input.Date](#inputdate) · [Input.Time](#inputtime) · [Input.Toggle](#inputtoggle) · [Input.ChoiceSet](#inputchoiceset)
- **Supporting Types** — [BackgroundImage](#backgroundimage) · [Refresh](#refresh) · [Authentication](#authentication) · [Metadata](#metadata)
- [Enums Appendix](#enums-appendix)

---

### The Card

The root `AdaptiveCard`. Created with `AdaptiveCard::make(string $version = '1.6')`.

```php
use AdaptiveCards\AdaptiveCard;

$card = AdaptiveCard::make('1.6')
    ->lang('en')
    ->speak('You have a new notification')
    ->minHeight('150px')
    ->verticalContentAlignment('center')
    ->addTextBlock('Hello world');
```

| Method | Description |
| --- | --- |
| `version(string)` | Schema version (default `'1.6'`). |
| `fallbackText(string)` | Text shown by hosts that cannot render the card. |
| `backgroundImage(string\|BackgroundImage)` | Card background (URL or [BackgroundImage](#backgroundimage)). |
| `minHeight(string)` | Minimum card height, e.g. `'150px'`. |
| `verticalContentAlignment(VerticalAlignment)` | `top` / `center` / `bottom`. |
| `rtl(bool = true)` | Right-to-left layout. |
| `speak(string)` | Text-to-speech / SSML. |
| `lang(string)` | ISO-639-1 language code. |
| `selectAction(AbstractAction)` | Action invoked when the card is tapped. |
| `addAction(AbstractAction)` / `addActions(iterable)` | Add action(s) to the card's action bar. |
| `refresh(Refresh)` | [Refresh](#refresh) behaviour. |
| `authentication(Authentication)` | [Authentication](#authentication) details. |
| `metadata(Metadata)` | [Metadata](#metadata). |
| `toArray()` / `toJson()` | Serialize the card. |
| `validate()` / `isValid()` / `getValidationErrors()` | Schema validation (see [Schema Validation](#schema-validation)). |

The card body is filled with the [Builder Helpers](#builder-helpers) below.

---

### Builder Helpers

`AdaptiveCard`, `Container`, `Column`, and `TableCell` share these helpers (via the `HasItems` trait). Each creates a child, optionally configures it through the closure, appends it, and returns the parent for chaining.

```php
$card
    ->addTextBlock('Title', fn ($t) => $t->weight('bolder'))
    ->addContainer(fn ($c) => $c
        ->style('emphasis')
        ->addTextBlock('Nested inside a container')
    );
```

| Helper | Child type |
| --- | --- |
| `addItem(AbstractElement)` / `addItems(iterable)` | any element (no closure) |
| `addTextBlock(string $text, ?callable)` | [TextBlock](#textblock) |
| `addRichTextBlock(?callable)` | [RichTextBlock](#richtextblock) |
| `addImage(string $url, ?callable)` | [Image](#image) |
| `addImageSet(?callable)` | [ImageSet](#imageset) |
| `addMedia(?callable)` | [Media](#media) |
| `addContainer(?callable)` | [Container](#container) |
| `addColumnSet(?callable)` | [ColumnSet](#columnset--column) |
| `addFactSet(array\|list $facts = [], ?callable)` | [FactSet](#factset) |
| `addTable(?callable)` | [Table](#table) |
| `addActionSet(?callable)` | [ActionSet](#actionset) |
| `addTextInput(string $id, ?callable)` | [Input.Text](#inputtext) |
| `addNumberInput(string $id, ?callable)` | [Input.Number](#inputnumber) |
| `addDateInput(string $id, ?callable)` | [Input.Date](#inputdate) |
| `addTimeInput(string $id, ?callable)` | [Input.Time](#inputtime) |
| `addToggleInput(string $id, string $title, ?callable)` | [Input.Toggle](#inputtoggle) |
| `addChoiceSetInput(string $id, ?callable)` | [Input.ChoiceSet](#inputchoiceset) |

Every component can also be built explicitly with its `make()` factory and added via `addItem()`:

```php
use AdaptiveCards\Element\TextBlock;

$card->addItem(TextBlock::make('Built explicitly')->weight('bolder'));
```

---

### Common Properties

To keep the per-component tables short, these shared setters are listed once here.

**Element properties** — available on every element (`TextBlock`, `Image`, `Container`, inputs, …):

| Method | Description |
| --- | --- |
| `id(string)` | Unique element id (required for `targetElements`, input values). |
| `isVisible(bool = true)` | Initial visibility. |
| `spacing(Spacing)` | Space above the element. |
| `separator(bool = true)` | Draw a separating line above. |
| `height(Height)` | `auto` or `stretch`. |
| `requires(array)` | Host-capability requirements, e.g. `['adaptiveCards' => '1.3']`. |
| `fallback(string\|AbstractElement)` | Fallback element or `'drop'`. |

**Action properties** — available on every action:

| Method | Description |
| --- | --- |
| `title(string)` | Button label. |
| `iconUrl(string)` | Icon URL. |
| `id(string)` | Unique id. |
| `style(ActionStyle)` | `default` / `positive` / `destructive`. |
| `tooltip(string)` | Hover tooltip. |
| `mode(ActionMode)` | `primary` / `secondary`. |
| `isEnabled(bool = true)` | Enable/disable the action. |
| `requires(array)` / `fallback(string\|AbstractAction)` | As above. |

**Input properties** — available on every input (in addition to the element properties):

| Method | Description |
| --- | --- |
| `label(string)` | Visible label. |
| `isRequired(bool = true)` | Mark as required. |
| `errorMessage(string)` | Message shown when validation fails. |
| `labelPosition(InputLabelPosition)` | `inline` / `above`. |
| `labelWidth(string\|int)` | e.g. `'40%'` or `40`. |
| `value(...)` | Initial value. |

---

## Elements

### TextBlock

Displays text with optional styling and markdown. `TextBlock::make(?string $text = null, ?bool $wrap = null)`.

```php
use AdaptiveCards\Enum\TextSize;

$card->addTextBlock('Important heading', fn ($t) => $t
    ->size(TextSize::Large)
    ->weight('bolder')
    ->color('accent')
    ->wrap(true)
    ->style('heading')
);
```

| Method | Description |
| --- | --- |
| `text(string)` | The text (supports a markdown subset). |
| `size(TextSize)` | `default`/`small`/`medium`/`large`/`extraLarge`. |
| `weight(TextWeight)` | `default`/`lighter`/`bolder`. |
| `color(Colors)` | `default`/`dark`/`light`/`accent`/`good`/`warning`/`attention`. |
| `fontType(FontType)` | `default`/`monospace`. |
| `horizontalAlignment(HorizontalAlignment)` | `left`/`center`/`right`. |
| `isSubtle(bool = true)` | Render in a subtler color. |
| `maxLines(int)` | Maximum lines before truncation. |
| `wrap(bool = true)` | Allow wrapping. |
| `style(TextBlockStyle)` | `default`/`heading`. |

_+ [common element properties](#common-properties)._

---

### RichTextBlock

Displays a run of inline `TextRun`s with independent formatting. `RichTextBlock::make()`; add inlines with `addTextRun()` (closure receives a `TextRun`) or `addInline()`.

```php
use AdaptiveCards\Element\RichTextBlock;
use AdaptiveCards\Enum\Colors;
use AdaptiveCards\Enum\HorizontalAlignment;
use AdaptiveCards\Enum\TextWeight;

$card->addRichTextBlock(fn (RichTextBlock $r) => $r
    ->addTextRun('Warning: ', fn ($run) => $run->weight(TextWeight::Bolder)->color(Colors::Attention))
    ->addTextRun('disk almost full.')
    ->horizontalAlignment(HorizontalAlignment::Left)
);
```

**RichTextBlock:** `addTextRun(string $text, ?callable)`, `addInline(TextRun|string)`, `horizontalAlignment(HorizontalAlignment)` _+ [common element properties](#common-properties)._

**TextRun** (`TextRun::make(string $text)`): `color`, `fontType`, `size`, `weight`, `isSubtle(bool)`, `italic(bool)`, `strikethrough(bool)`, `highlight(bool)`, `underline(bool)`, `selectAction(AbstractAction)`.

---

### Image

A single image. `Image::make()`.

```php
use AdaptiveCards\Enum\ImageSize;
use AdaptiveCards\Enum\ImageStyle;

$card->addImage('https://adaptivecards.io/content/cats/1.png', fn ($img) => $img
    ->altText('A cat')
    ->size(ImageSize::Medium)
    ->style(ImageStyle::Person)
    ->selectAction(\AdaptiveCards\Action\OpenUrlAction::make('Open', 'https://example.com'))
);
```

| Method | Description |
| --- | --- |
| `url(string)` | Image URL (supports data URIs). |
| `altText(string)` | Alternate text. |
| `size(ImageSize)` | `auto`/`stretch`/`small`/`medium`/`large`. |
| `style(ImageStyle)` | `default`/`person`. |
| `backgroundColor(string)` | Hex background, e.g. `'#DDDDDD'`. |
| `horizontalAlignment(HorizontalAlignment)` | Alignment. |
| `width(string)` | Explicit pixel width, e.g. `'50px'`. |
| `pixelHeight(string)` | Explicit pixel height, e.g. `'50px'`. |
| `selectAction(AbstractAction)` | Action when tapped. |

_+ [common element properties](#common-properties)._

---

### ImageSet

A gallery of images. `ImageSet::make()`.

```php
use AdaptiveCards\Element\ImageSet;
use AdaptiveCards\Enum\ImageSize;

$card->addImageSet(fn (ImageSet $s) => $s
    ->imageSize(ImageSize::Medium)
    ->addImage('https://adaptivecards.io/content/cats/1.png')
    ->addImage('https://adaptivecards.io/content/cats/2.png')
);
```

**ImageSet:** `addImage(Image|string)`, `imageSize(ImageSize)` _+ [common element properties](#common-properties)._

---

### Media

Plays audio or video. `Media::make()`.

```php
use AdaptiveCards\Element\Media;

$card->addMedia(fn (Media $m) => $m
    ->poster('https://adaptivecards.io/content/poster-video.png')
    ->altText('Demo video')
    ->addSource('https://example.com/clip.mp4', 'video/mp4')
    ->addCaptionSource(\AdaptiveCards\Element\CaptionSource::make('https://example.com/en.vtt', 'vtt', 'English'))
);
```

**Media:** `addSource(MediaSource|string $url, ?string $mimeType)`, `addCaptionSource(CaptionSource)`, `poster(string)`, `altText(string)` _+ [common element properties](#common-properties)._

- **MediaSource** — `MediaSource::make(?string $url = null, ?string $mimeType = null)`.
- **CaptionSource** — `CaptionSource::make(string $url, string $mimeType, ?string $label)` (schema 1.6+).

---

## Containers & Layout

### Container

Groups elements and supports styling, background, and tap actions. `Container::make()`. Supports all [Builder Helpers](#builder-helpers).

```php
use AdaptiveCards\Element\Container;
use AdaptiveCards\Enum\ContainerStyle;
use AdaptiveCards\Enum\VerticalAlignment;

$card->addContainer(fn (Container $c) => $c
    ->style(ContainerStyle::Emphasis)
    ->bleed(true)
    ->verticalContentAlignment(VerticalAlignment::Center)
    ->addTextBlock('Inside an emphasized container')
);
```

**Container:** `style(ContainerStyle)`, `verticalContentAlignment(VerticalAlignment)`, `bleed(bool)`, `minHeight(string)`, `rtl(bool)`, `backgroundImage(string|BackgroundImage)`, `selectAction(AbstractAction)` _+ [builder helpers](#builder-helpers) + [common element properties](#common-properties)._

---

### ColumnSet & Column

Lays out `Column`s side by side. `ColumnSet::make()`; add columns with `column(width, ?callable)` or `addColumn(Column)`. A `Column` supports all [Builder Helpers](#builder-helpers).

```php
use AdaptiveCards\Element\Column;
use AdaptiveCards\Enum\ImageSize;
use AdaptiveCards\Enum\TextWeight;
use AdaptiveCards\Enum\VerticalAlignment;

$card->addColumnSet(fn ($cs) => $cs
    ->column('auto', fn (Column $c) => $c
        ->addImage('https://adaptivecards.io/content/cats/1.png', fn ($i) => $i->size(ImageSize::Small))
    )
    ->column('stretch', fn (Column $c) => $c
        ->verticalContentAlignment(VerticalAlignment::Center)
        ->addTextBlock('Jane Doe', fn ($t) => $t->weight(TextWeight::Bolder))
    )
);
```

**ColumnSet:** `column(string|int|null $width, ?callable)`, `addColumn(Column)`, `style(ContainerStyle)`, `bleed(bool)`, `minHeight(string)`, `horizontalAlignment(HorizontalAlignment)`, `selectAction(AbstractAction)` _+ [common element properties](#common-properties)._

**Column** (`Column::make(string|int|null $width)`): `width(string|int)` (`'auto'`, `'stretch'`, a relative weight, or `'50px'`), `style`, `verticalContentAlignment`, `bleed`, `minHeight`, `rtl`, `backgroundImage`, `selectAction` _+ [builder helpers](#builder-helpers) + [common element properties](#common-properties)._

---

### FactSet

A list of title/value pairs. `FactSet::make()`. The `addFactSet()` helper accepts a `title => value` map directly.

```php
$card->addFactSet([
    'Order ID:' => '#98765',
    'Status:'   => 'Shipped',
]);
```

**FactSet:** `facts(iterable $facts)`, `addFact(Fact)`, `fact(string $title, string $value)` _+ [common element properties](#common-properties)._
**Fact** — `Fact::make(string $title, string $value)`.

---

### Table

Tabular layout (schema 1.5+). `Table::make()`.

```php
use AdaptiveCards\Element\Table;
use AdaptiveCards\Element\TableColumnDefinition;
use AdaptiveCards\Enum\ContainerStyle;

$card->addTable(fn (Table $t) => $t
    ->columns([TableColumnDefinition::make(2), TableColumnDefinition::make(1)])
    ->showGridLines(true)
    ->gridStyle(ContainerStyle::Emphasis)
    ->addTextRow(['Item', 'Qty'])
    ->addTextRow(['Keyboard', '1'])
);
```

| Method | Description |
| --- | --- |
| `columns(array)` | Column definitions (`TableColumnDefinition`, width string, or int). |
| `addColumn(TableColumnDefinition\|string\|int)` | Append one column. |
| `addRow(TableRow)` / `addTextRow(array $cells)` | Append a row (`addTextRow` wraps plain strings in cells). |
| `showGridLines(bool = true)` | Toggle grid lines. |
| `gridStyle(ContainerStyle)` | Grid container style. |
| `horizontalCellContentAlignment(HorizontalAlignment)` | Default horizontal cell alignment. |
| `verticalCellContentAlignment(VerticalAlignment)` | Default vertical cell alignment. |

_+ [common element properties](#common-properties)._

- **TableRow** (`TableRow::make()`): `addCell(TableCell)`, `addTextCell(string $text, ?callable)`, `style`, `horizontalCellContentAlignment`, `verticalCellContentAlignment`.
- **TableCell** (`TableCell::make()`): behaves like a [Container](#container) — supports all [builder helpers](#builder-helpers) plus `style`, `verticalContentAlignment`, `bleed`, `minHeight`, `rtl`, `backgroundImage`, `selectAction`.
- **TableColumnDefinition** (`TableColumnDefinition::make(string|int|null $width)`): `horizontalCellContentAlignment`, `verticalCellContentAlignment`.

---

### ActionSet

Renders actions inline in the card body. `ActionSet::make()`.

```php
use AdaptiveCards\Element\ActionSet;
use AdaptiveCards\Action\OpenUrlAction;

$card->addActionSet(fn (ActionSet $s) => $s
    ->addAction(OpenUrlAction::make('Docs', 'https://adaptivecards.io'))
);
```

**ActionSet:** `addAction(AbstractAction)`, `addActions(iterable)` _+ [common element properties](#common-properties)._

---

## Actions

All actions share the [action properties](#common-properties) (`title`, `iconUrl`, `style`, `tooltip`, `mode`, `isEnabled`, …). `selectAction(...)` on `Image`/`Container`/`Column`/`TableCell`/`TextRun` accepts any of these except `Action.ShowCard`.

### Action.OpenUrl

Opens a URL. `OpenUrlAction::make(string $title, string $url)`.

```php
use AdaptiveCards\Action\OpenUrlAction;

$card->addAction(OpenUrlAction::make('Learn more', 'https://adaptivecards.io'));
```

`url(string)` _+ [common action properties](#common-properties)._

---

### Action.Submit

Gathers inputs and sends them to the host. `SubmitAction::make(string $title)`.

```php
use AdaptiveCards\Action\SubmitAction;
use AdaptiveCards\Enum\AssociatedInputs;

$card->addAction(SubmitAction::make('Submit')
    ->data(['action' => 'save'])
    ->associatedInputs(AssociatedInputs::Auto)
);
```

| Method | Description |
| --- | --- |
| `data(array\|string)` | Hidden payload merged with gathered inputs. |
| `associatedInputs(AssociatedInputs)` | `auto` / `none`. |

_+ [common action properties](#common-properties)._

---

### Action.ShowCard

Reveals a nested card. `ShowCardAction::make(AdaptiveCard $card, ?string $title = null)`.

```php
use AdaptiveCards\AdaptiveCard;
use AdaptiveCards\Action\ShowCardAction;

$nested = AdaptiveCard::make()->addTextBlock('Hidden until expanded');
$card->addAction(ShowCardAction::make($nested, 'Details'));
```

`card(AdaptiveCard)` _+ [common action properties](#common-properties)._

---

### Action.Execute

Sends a Universal Action Model event to a bot (schema 1.4+). `ExecuteAction::make(string $title)`.

```php
use AdaptiveCards\Action\ExecuteAction;
use AdaptiveCards\Enum\AssociatedInputs;

$card->addAction(ExecuteAction::make('Approve')
    ->verb('approveRequest')
    ->data(['requestId' => 42])
    ->associatedInputs(AssociatedInputs::Auto)
);
```

`verb(string)`, `data(array|string)`, `associatedInputs(AssociatedInputs)` _+ [common action properties](#common-properties)._

---

### Action.ToggleVisibility

Shows/hides/toggles target elements by id. `ToggleVisibilityAction::make(string $title)`.

```php
use AdaptiveCards\Action\ToggleVisibilityAction;

$card->addAction(ToggleVisibilityAction::make('Toggle details')
    ->target('detailsPanel')          // toggle
    ->target('spinner', false)        // force hide
);
```

`target(string $elementId, ?bool $isVisible)`, `addTarget(TargetElement)` _+ [common action properties](#common-properties)._
**TargetElement** — `TargetElement::make(string $elementId, ?bool $isVisible)` (`true` = show, `false` = hide, `null` = toggle).

---

### Action.InsertImage

Inserts an image into the host application canvas (Word/PowerPoint, schema 1.5+). `InsertImageAction::make(string $url, string $altText, ?string $title = null)`.

```php
use AdaptiveCards\Action\InsertImageAction;

$card->addAction(InsertImageAction::make('https://example.com/logo.png', 'Company Logo')
    ->title('Insert Logo')
    ->insertPosition('Top')
);
```

`url(string)`, `altText(string)`, `insertPosition(string)` (`Selection`/`Top`/`Bottom`) _+ [common action properties](#common-properties)._

---

## Inputs

All inputs share the [input properties](#common-properties) (`label`, `isRequired`, `errorMessage`, `labelPosition`, `labelWidth`, `value`) and the [element properties](#common-properties).

### Input.Text

Free-form text. `TextInput::make(string $id, ?string $label = null, ?string $placeholder = null)`.

```php
use AdaptiveCards\Enum\TextInputStyle;
use AdaptiveCards\Input\TextInput;

$card->addTextInput('email', fn (TextInput $i) => $i
    ->label('Email')
    ->style(TextInputStyle::Email)
    ->placeholder('you@example.com')
    ->isRequired(true)
);
```

`placeholder(string)`, `isMultiline(bool)`, `maxLength(int)`, `style(TextInputStyle)` (`text`/`tel`/`url`/`email`/`password`), `regex(string)`, `inlineAction(AbstractAction)`.

---

### Input.Number

Numeric input. `NumberInput::make(string $id, ?string $label = null, ?string $placeholder = null)`.

```php
use AdaptiveCards\Input\NumberInput;

$card->addNumberInput('qty', fn (NumberInput $i) => $i
    ->label('Quantity')->min(1)->max(99)->value(1)
);
```

`placeholder(string)`, `min(int|float)`, `max(int|float)`.

---

### Input.Date

Date picker (ISO `YYYY-MM-DD`). `DateInput::make(string $id, ?string $label = null)`.

```php
use AdaptiveCards\Input\DateInput;

$card->addDateInput('due', fn (DateInput $i) => $i
    ->label('Due date')->min('2026-01-01')->max('2026-12-31')
);
```

`placeholder(string)`, `min(string)`, `max(string)`.

---

### Input.Time

Time picker (`HH:MM`). `TimeInput::make(string $id, ?string $label = null)`.

```php
use AdaptiveCards\Input\TimeInput;

$card->addTimeInput('start', fn (TimeInput $i) => $i
    ->label('Start time')->min('09:00')->max('17:00')
);
```

`placeholder(string)`, `min(string)`, `max(string)`.

---

### Input.Toggle

On/off switch. `ToggleInput::make(string $id, ?string $title = null)`.

```php
use AdaptiveCards\Input\ToggleInput;

$card->addToggleInput('newsletter', 'Subscribe to updates', fn (ToggleInput $t) => $t
    ->value('true')->valueOn('true')->valueOff('false')->wrap(true)
);
```

`title(string)`, `valueOn(string)`, `valueOff(string)`, `wrap(bool)`.

---

### Input.ChoiceSet

Dropdown / radio / multi-select. `ChoiceSetInput::make(string $id)`.

```php
use AdaptiveCards\Input\ChoiceSetInput;

$card->addChoiceSetInput('rating', fn (ChoiceSetInput $c) => $c
    ->label('Rating')
    ->style('expanded')
    ->choices(['Great' => '5', 'Good' => '4', 'Average' => '3'])
    ->value('5')
);
```

| Method | Description |
| --- | --- |
| `choice(string $title, string $value)` | Add a single choice. |
| `addChoice(Choice)` | Add a `Choice` instance. |
| `choices(array $titleToValue)` | Add several from a `title => value` map. |
| `isMultiSelect(bool = true)` | Allow multiple selections. |
| `style(ChoiceInputStyle)` | `compact` / `expanded` / `filtered`. |
| `placeholder(string)` | Placeholder (compact style). |
| `wrap(bool = true)` | Wrap choice text. |

**Choice** — `Choice::make(string $title, string $value)`.

---

## Supporting Types

### BackgroundImage

Used by `AdaptiveCard`, `Container`, `Column`, `TableCell` `backgroundImage()`. `BackgroundImage::make(string $url)`.

```php
use AdaptiveCards\Enum\HorizontalAlignment;
use AdaptiveCards\Enum\ImageFillMode;
use AdaptiveCards\Enum\VerticalAlignment;
use AdaptiveCards\Shared\BackgroundImage;

$card->backgroundImage(BackgroundImage::make('https://example.com/bg.png')
    ->fillMode(ImageFillMode::Cover)
    ->horizontalAlignment(HorizontalAlignment::Center)
    ->verticalAlignment(VerticalAlignment::Top)
);
```

`fillMode(ImageFillMode)` (`cover`/`repeatHorizontally`/`repeatVertically`/`repeat`), `horizontalAlignment(HorizontalAlignment)`, `verticalAlignment(VerticalAlignment)`.

---

### Refresh

Automatic card refresh (schema 1.4+). `Refresh::make()`.

```php
use AdaptiveCards\Shared\Refresh;
use AdaptiveCards\Action\ExecuteAction;

$card->refresh(Refresh::make()
    ->action(ExecuteAction::make('Refresh')
        ->verb('refreshData'))
    ->userIds(['user-1', 'user-2'])
    ->expires('2026-12-31T23:59:59Z')
);
```

`action(ExecuteAction)`, `expires(string)` (ISO-8601, schema 1.6+), `userIds(array)`.

---

### Authentication

OAuth / SSO sign-in details (schema 1.4+). `Authentication::make()`.

```php
use AdaptiveCards\Shared\Authentication;

$card->authentication(Authentication::make()
    ->text('Please sign in')
    ->connectionName('myOAuthConnection')
    ->tokenExchangeResource([
        'id'         => 'resource-id',
        'uri'        => 'api://example',
        'providerId' => 'provider-id',
    ])
    ->buttons([
        ['type' => 'signin', 'title' => 'Sign in', 'value' => 'https://example.com/signin'],
    ])
);
```

`text(string)`, `connectionName(string)`, `tokenExchangeResource(array)` (keys: `id`, `uri`, `providerId`), `buttons(array $buttons)` (each: `type`, `title`, `value`, optional `image`).

---

### Metadata

Non-rendered card metadata (schema 1.6+). `Metadata::make(?string $webUrl)`.

```php
use AdaptiveCards\Shared\Metadata;

$card->metadata(Metadata::make('https://example.com/card/123'));
```

`webUrl(string)`.

---

## Enums Appendix

Every enum setter also accepts the equivalent string, so passing the enum case is optional. Strings must match the exact value listed below (matching is case-sensitive — note `AssociatedInputs` uses `Auto`/`None`). All enums live under `AdaptiveCards\Enum\`.

| Enum | Values |
| --- | --- |
| `TextSize` | `default`, `small`, `medium`, `large`, `extraLarge` |
| `TextWeight` | `default`, `lighter`, `bolder` |
| `TextBlockStyle` | `default`, `heading` |
| `Colors` | `default`, `dark`, `light`, `accent`, `good`, `warning`, `attention` |
| `FontType` | `default`, `monospace` |
| `HorizontalAlignment` | `left`, `center`, `right` |
| `VerticalAlignment` | `top`, `center`, `bottom` |
| `ImageSize` | `auto`, `stretch`, `small`, `medium`, `large` |
| `ImageStyle` | `default`, `person` |
| `ImageFillMode` | `cover`, `repeatHorizontally`, `repeatVertically`, `repeat` |
| `ContainerStyle` | `default`, `emphasis`, `good`, `attention`, `warning`, `accent` |
| `Spacing` | `none`, `small`, `default`, `medium`, `large`, `extraLarge`, `padding` |
| `Height` | `auto`, `stretch` |
| `TextInputStyle` | `text`, `tel`, `url`, `email`, `password` |
| `ChoiceInputStyle` | `compact`, `expanded`, `filtered` |
| `ActionStyle` | `default`, `positive`, `destructive` |
| `ActionMode` | `primary`, `secondary` |
| `AssociatedInputs` | `Auto`, `None` |
| `InputLabelPosition` | `inline`, `above` |

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


## Security

If you discover any security-related issues, please open an issue or email `office@gariskode.com`.

---

## License

The MIT License (MIT). Please see [LICENSE](LICENSE) for more information.
