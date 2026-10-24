# Table

**Works in:** Teams · Copilot · Outlook

Use tables to display data in a tabular way, with rows, columns and cells.

## Example

```json
{
  "type": "AdaptiveCard",
  "version": "1.5",
  "body": [
    {
      "type": "Table",
      "roundedCorners": true,
      "firstRowAsHeaders": true,
      "columns": [
        { "width": 1 },
        { "width": 1 },
        { "width": 3 }
      ],
      "rows": [
        {
          "type": "TableRow",
          "cells": [
            { "type": "TableCell", "items": [{ "type": "TextBlock", "text": "Name", "wrap": true, "weight": "Bolder" }] },
            { "type": "TableCell", "items": [{ "type": "TextBlock", "text": "Type", "wrap": true, "weight": "Bolder" }] },
            { "type": "TableCell", "items": [{ "type": "TextBlock", "text": "Description", "wrap": true, "weight": "Bolder" }] }
          ]
        },
        {
          "type": "TableRow",
          "cells": [
            { "type": "TableCell", "items": [{ "type": "TextBlock", "text": "columns", "wrap": true }] },
            { "type": "TableCell", "items": [{ "type": "TextBlock", "text": "ColumnDefinition[]", "wrap": true }] },
            { "type": "TableCell", "items": [{ "type": "TextBlock", "text": "Defines the table's columns (number of columns, and column sizes).", "wrap": true }] }
          ]
        },
        {
          "type": "TableRow",
          "cells": [
            { "type": "TableCell", "items": [{ "type": "TextBlock", "text": "rows", "wrap": true }] },
            { "type": "TableCell", "items": [{ "type": "TextBlock", "text": "TableRow[]", "wrap": true }] },
            { "type": "TableCell", "items": [{ "type": "TextBlock", "text": "Defines the rows of the Table, each being a collection of cells. Rows are not required, which allows empty Tables to be generated via templating without breaking the rendering of the whole card.", "wrap": true }] }
          ]
        }
      ]
    }
  ]
}
```

## Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `type` | `string` | — | Must be `Table`. | 1.0 |
| `columns` | `array of object` | — | The columns in the table. Valid values: `ColumnDefinition`. | 1.5 |
| `firstRowAsHeaders` | `boolean` | `true` | Controls whether the first row of the table should be treated as a header. | 1.5 |
| `gridStyle` | `string` | — | Style of grid lines between cells. Valid values: `default`, `emphasis`, `accent`, `good`, `attention`, `warning`. | 1.5 |
| `horizontalCellContentAlignment` | `string` | — | Default horizontal alignment of content in every cell. Valid values: `Left`, `Center`, `Right`. | 1.5 |
| `minWidth` | `string` | — | Minimum width of the table. `auto` sizes to content; `<number>px` sets explicit pixel width. Scrollbar appears if available width is smaller. | 1.5 |
| `rows` | `array of object` | — | The rows of the table. Valid values: `TableRow`. | 1.5 |
| `showGridLines` | `boolean` | `true` | Controls whether grid lines are displayed. | 1.5 |
| `verticalCellContentAlignment` | `string` | — | Default vertical alignment of every cell. Valid values: `Top`, `Center`, `Bottom`. | 1.5 |
| `fallback` | `object or string` | — | Alternative element if unsupported or required capabilities are missing. See [Fallback values](#fallback-values). | 1.2 |
| `grid.area` | `string` | — | **Teams.** Area in a `Layout.AreaGrid`. | 1.5 |
| `height` | `string` | `auto` | Height of element; `stretch` uses remaining vertical space. Valid values: `auto`, `stretch`. | 1.1 |
| `horizontalAlignment` | `string` | — | Horizontal alignment. Valid values: `Left`, `Center`, `Right`. | 1.0 |
| `id` | `string` | — | Unique element or action identifier. Inputs need an ID to be validated and sent to the bot. | 1.0 |
| `isSortKey` | `boolean` | `false` | Whether the element is used as a sort key by collection-sorting elements. | 1.5 |
| `isVisible` | `boolean` | `true` | Controls element visibility. | 1.2 |
| `isVisible.dynamic` | `string` | — | **Preview.** Expression evaluated to update `isVisible` at runtime. | 1.5 |
| `key` | `string` | — | Optional key, occasionally useful for preserving visual state in the host. | 1.0 |
| `lang` | `string` | — | Locale associated with the element. | 1.1 |
| `requires` | `object` | `{}` | Required host capabilities; otherwise element is not rendered or fallback is used. Valid values: `HostCapabilities`. | 1.2 |
| `roundedCorners` | `boolean` | `false` | **Teams.** Controls rounded corners. | 1.5 |
| `separator` | `boolean` | `false` | Shows separator above element, except for first element in a container. | 1.0 |
| `showBorder` | `boolean` | `false` | **Teams.** Controls border around container. | 1.5 |
| `spacing` | `string` | `Default` | Spacing from previous element (not applied to first item). See [Spacing values](#spacing-values). | 1.0 |
| `style` | `string` | — | Container colors for background, border, text, preserving contrast. Valid values: `default`, `emphasis`, `accent`, `good`, `attention`, `warning`. | 1.0 |
| `targetWidth` | `string` | — | **Teams/Copilot.** Card-width breakpoint where element is displayed. Unspecified means all widths. See [Target width values](#target-width-values). | 1.0 |

## ColumnDefinition

**Works in:** Teams · Copilot · Outlook

Defines a column in a `Table` element.

### Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `horizontalCellContentAlignment` | `string` | — | Default horizontal alignment in column; overrides table-level setting. Valid values: `Left`, `Center`, `Right`. | 1.5 |
| `verticalCellContentAlignment` | `string` | — | Default vertical alignment in column; overrides table-level setting. Valid values: `Top`, `Center`, `Bottom`. | 1.5 |
| `width` | `string or number` | — | Numeric width represents relative column weight; `auto` fits content; `<number>px` sets fixed pixels. | 1.5 |
| `key` | `string` | — | Optional key, sometimes useful for preserving visual state in host. | 1.0 |

## TableRow

**Works in:** Teams · Copilot · Outlook

Represents a row of cells in a table.

### Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `type` | `string` | — | Must be `TableRow`. | 1.0 |
| `cells` | `array of object` | — | Cells in the row. Valid values: `TableCell`. | 1.5 |
| `horizontalCellContentAlignment` | `string` | — | Default horizontal alignment in row; overrides table and column settings. Valid values: `Left`, `Center`, `Right`. | 1.5 |
| `verticalCellContentAlignment` | `string` | — | Default vertical alignment in row; overrides table and column settings. Valid values: `Top`, `Center`, `Bottom`. | 1.5 |
| `fallback` | `object or string` | — | Alternative element if unsupported. See [Fallback values](#fallback-values). | 1.2 |
| `grid.area` | `string` | — | **Teams.** Area in a `Layout.AreaGrid`. | 1.5 |
| `height` | `string` | `auto` | Height. Valid values: `auto`, `stretch`. | 1.1 |
| `horizontalAlignment` | `string` | — | Alignment. Valid values: `Left`, `Center`, `Right`. | 1.0 |
| `id` | `string` | — | Unique identifier; inputs require one to be validated and sent. | 1.0 |
| `isSortKey` | `boolean` | `false` | Controls sort-key use in collections. | 1.5 |
| `isVisible` | `boolean` | `true` | Controls visibility. | 1.2 |
| `isVisible.dynamic` | `string` | — | **Preview.** Expression used to update visibility at runtime. | 1.5 |
| `key` | `string` | — | Optional key for visual state. | 1.0 |
| `lang` | `string` | — | Locale of element. | 1.1 |
| `requires` | `object` | `{}` | Required host capabilities (`HostCapabilities`); failure hides element or renders fallback. | 1.2 |
| `roundedCorners` | `boolean` | `false` | **Teams.** Rounded corners. | 1.5 |
| `separator` | `boolean` | `false` | Separator above element unless first element. | 1.0 |
| `showBorder` | `boolean` | `false` | **Teams.** Border around container. | 1.5 |
| `spacing` | `string` | `Default` | Spacing from previous item. See [Spacing values](#spacing-values). | 1.0 |
| `style` | `string` | — | Container style affecting background, border, and text contrast. Valid values: `default`, `emphasis`, `accent`, `good`, `attention`, `warning`. | 1.5 |
| `targetWidth` | `string` | — | **Teams/Copilot.** Width condition; see [Target width values](#target-width-values). | 1.0 |

## TableCell

**Works in:** Teams · Copilot · Outlook

Represents a cell in a table row.

### Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `type` | `string` | — | Must be `TableCell`. | 1.0 |
| `items` | `array of object` | — | Elements in the cell. See [TableCell items](#tablecell-items). | 1.0 |
| `backgroundImage` | `string or object` | — | Container background image. Valid values: `BackgroundImage`. | 1.0 |
| `bleed` | `boolean` | `false` | Extends container into parent's padding. | 1.2 |
| `fallback` | `object or string` | — | Alternative element if unsupported. See [Fallback values](#fallback-values). | 1.2 |
| `grid.area` | `string` | — | **Teams.** Area in a `Layout.AreaGrid`. | 1.5 |
| `height` | `string` | `auto` | Height. Valid values: `auto`, `stretch`. | 1.1 |
| `id` | `string` | — | Unique identifier; inputs require one to be validated and sent. | 1.0 |
| `isSortKey` | `boolean` | `false` | Controls sort-key use in collections. | 1.5 |
| `isVisible` | `boolean` | `true` | Controls visibility. | 1.2 |
| `isVisible.dynamic` | `string` | — | **Preview.** Expression used to update visibility at runtime. | 1.5 |
| `key` | `string` | — | Optional key for visual state. | 1.0 |
| `lang` | `string` | — | Locale of element. | 1.1 |
| `layouts` | `array of object` | — | **Teams.** Responsive layout definitions. Valid values: `Layout.Stack`, `Layout.Flow`, `Layout.AreaGrid`. | 1.5 |
| `maxHeight` | `string` | — | **Teams.** `<number>px` maximum height; overflowing content gets a vertical scrollbar. | 1.5 |
| `minHeight` | `string` | — | `<number>px` minimum height. | 1.2 |
| `requires` | `object` | `{}` | Required host capabilities (`HostCapabilities`); failure hides element or renders fallback. | 1.2 |
| `rtl` | `boolean` | — | Controls right-to-left or left-to-right content direction. | 1.0 |
| `selectAction` | `object` | — | Action on click/tap; `Action.ShowCard` unsupported. See [Select actions](#select-actions). | 1.1 |
| `separator` | `boolean` | `false` | Separator above element unless first element. | 1.0 |
| `spacing` | `string` | `Default` | Spacing from previous item. See [Spacing values](#spacing-values). | 1.0 |
| `style` | `string` | — | Container style affecting background, border, and text contrast. Valid values: `default`, `emphasis`, `accent`, `good`, `attention`, `warning`. | 1.0 |
| `targetWidth` | `string` | — | **Teams/Copilot.** Width condition; see [Target width values](#target-width-values). | 1.0 |
| `verticalContentAlignment` | `string` | — | Vertical alignment of container content. Valid values: `Top`, `Center`, `Bottom`. | 1.1 |

## Valid value references

### Fallback values

`Container`, `ActionSet`, `ColumnSet`, `Media`, `RichTextBlock`, `Table`, `TextBlock`, `FactSet`, `ImageSet`, `Image`, `Input.Text`, `Input.Date`, `Input.Time`, `Input.Number`, `Input.Toggle`, `Input.ChoiceSet`, `Input.Rating`, `Rating`, `CompoundButton`, `Icon`, `Carousel`, `TabSet`, `Accordion`, `Badge`, `ProgressRing`, `ProgressBar`, `LoopComponent`, `Chart.Donut`, `Chart.Pie`, `Chart.VerticalBar.Grouped`, `Chart.VerticalBar`, `Chart.HorizontalBar`, `Chart.HorizontalBar.Stacked`, `Chart.Line`, `Chart.Gauge`, `CodeBlock`, `Persona`, `PersonaSet`, `Graph resource`, `File`, `Calendar event`, `drop`.

### TableCell items

`Accordion`, `ActionSet`, `Badge`, `Carousel`, `Chart.Donut`, `Chart.Gauge`, `Chart.HorizontalBar`, `Chart.HorizontalBar.Stacked`, `Chart.Line`, `Chart.Pie`, `Chart.VerticalBar`, `Chart.VerticalBar.Grouped`, `CodeBlock`, `ColumnSet`, `Calendar event`, `File`, `Graph resource`, `Persona`, `PersonaSet`, `CompoundButton`, `Container`, `FactSet`, `Icon`, `Image`, `ImageSet`, `Input.ChoiceSet`, `Input.Date`, `Input.Number`, `Input.Rating`, `Input.Text`, `Input.Time`, `Input.Toggle`, `LoopComponent`, `Media`, `ProgressBar`, `ProgressRing`, `Rating`, `RichTextBlock`, `Table`, `TabSet`, `TextBlock`.

### Select actions

`Action.Execute`, `Action.InsertImage`, `Action.OpenUrl`, `Action.OpenUrlDialog`, `Action.Popover`, `Action.ResetInputs`, `Action.RunCommands`, `Action.Submit`, `Action.ToggleVisibility`.

### Spacing values

`None`, `ExtraSmall`, `Small`, `Default`, `Medium`, `Large`, `ExtraLarge`, `Padding`.

### Target width values

`VeryNarrow`, `Narrow`, `Standard`, `Wide`, `atLeast:VeryNarrow`, `atMost:VeryNarrow`, `atLeast:Narrow`, `atMost:Narrow`, `atLeast:Standard`, `atMost:Standard`, `atLeast:Wide`, `atMost:Wide`.
