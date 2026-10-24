# ColumnSet

**Works in:** Teams · Copilot · Outlook

Splits the available horizontal space into separate columns, so elements can be organized in a row.

## Using ColumnSet and Column efficiently

`ColumnSet` makes it possible to organize a card into several columns. This is very important for many scenarios, but it can also lead to cards that do not look great and aren't very usable, especially on narrower surfaces like a phone in portrait mode. Here are recommendations you should follow to avoid these types of problems.

### Do

- Limit the number of columns in a `ColumnSet`. Usually, a maximum of 3 columns is preferable.
- Prefer `auto`, `stretch`, and weighted column sizes. Only use explicit column sizes in pixels for narrow columns that, for instance, contain an avatar picture, small thumbnail, or very short text.
- Test your card at all widths, especially narrow and very narrow, when using `ColumnSet`. If your card doesn't look good at narrow width, update it to adapt to the available width by using responsive layout features.

### Don't

- Use `ColumnSet` to display multi-row tabular information. Multiple `ColumnSet`s cannot "work together" to ensure their columns are sized the same way unless you only use `stretch` and weighted sizes. For multi-row tabular information, use `Table`.
- Use nested `ColumnSet`s unless absolutely necessary.

## Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `type` | `string` | — | Must be `ColumnSet`. | 1.0 |
| `columns` | `array of object` | — | The columns in the set. Valid values: `Column`. | 1.0 |
| `minWidth` | `string` | — | Minimum width. `auto` adjusts to content; `<number>px` sets an explicit minimum. A scrollbar appears if available width is less. Valid values: `auto`, `<number>px`. | 1.5 |
| `bleed` | `boolean` | `false` | Extends the container into its parent's padding (edge-to-edge content). | 1.2 |
| `fallback` | `object or string` | — | Alternate element when this type or its required capabilities are unsupported. See [Fallback valid values](#fallback-valid-values). | 1.2 |
| `grid.area` | `string` | — | **Teams.** Area of a `Layout.AreaGrid` layout in which to display the element. | 1.5 |
| `height` | `string` | `auto` | Height; `stretch` uses remaining vertical space. Valid values: `auto`, `stretch`. | 1.1 |
| `horizontalAlignment` | `string` | — | Horizontal alignment. Valid values: `Left`, `Center`, `Right`. | 1.0 |
| `id` | `string` | — | Unique identifier for element/action. Inputs must have an ID to be validated and sent to the Bot. | 1.0 |
| `isSortKey` | `boolean` | `false` | Marks the element as a sort key for collections that support sorting. | 1.5 |
| `isVisible` | `boolean` | `true` | Controls visibility. | 1.2 |
| `isVisible.dynamic` | `string` | — | **Preview.** Expression evaluated at runtime to update `isVisible`. | 1.5 |
| `key` | `string` | — | Optional object key, occasionally useful for maintaining visual state. | 1.0 |
| `lang` | `string` | — | Locale associated with the element. | 1.1 |
| `minHeight` | `string` | — | Minimum container height. Format: `<number>px`. | 1.2 |
| `requires` | `object` | `{}` | Capabilities required from the host; unsupported elements are omitted or replaced with a fallback. Valid values: `HostCapabilities`. | 1.2 |
| `roundedCorners` | `boolean` | `false` | **Teams.** Whether container corners are rounded. | 1.5 |
| `selectAction` | `object` | — | Action on tap/click; `Action.ShowCard` is unsupported. See [SelectAction valid values](#selectaction-valid-values). | 1.1 |
| `separator` | `boolean` | `false` | Whether a line separates this element from the previous one (not shown for first element). | 1.0 |
| `showBorder` | `boolean` | `false` | **Teams.** Whether the container has a border. | 1.5 |
| `spacing` | `string` | `Default` | Space from the preceding element (not applied to the first). See [Spacing valid values](#spacing-valid-values). | 1.0 |
| `style` | `string` | — | Container style controlling background, border and text colors for contrast. See [Style valid values](#style-valid-values). | 1.0 |
| `targetWidth` | `string` | — | **Teams/Copilot.** Responsive card-width targeting; absent means all widths. See [TargetWidth valid values](#targetwidth-valid-values). | 1.0 |

---

## Column

**Works in:** Teams · Copilot · Outlook

A column in a `ColumnSet` element.

### Using ColumnSet and Column efficiently

`ColumnSet` makes it possible to organize a card into several columns. This is very important for many scenarios, but it can also lead to cards that do not look great and aren't very usable, especially on narrower surfaces like a phone in portrait mode.

#### Do

- Limit the number of columns in a `ColumnSet`. Usually, a maximum of 3 columns is preferable.
- Prefer `auto`, `stretch`, and weighted column sizes. Only use explicit column sizes in pixels for narrow columns that, for instance, contain an avatar picture, small thumbnail, or very short text.
- Test your card at all widths, especially narrow and very narrow, when using `ColumnSet`. If your card doesn't look good at narrow width, update it to adapt to the available width by using responsive layout features.

#### Don't

- Use `ColumnSet` to display multi-row tabular information. Multiple `ColumnSet`s cannot "work together" to ensure their columns are sized the same way unless you only use `stretch` and weighted sizes. For multi-row tabular information, use `Table`.
- Use nested `ColumnSet`s unless absolutely necessary.

### Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `type` | `string` | — | Optional. If specified, must be `Column`. | 1.0 |
| `items` | `array of object` | — | Elements in the column. See [Column item valid values](#column-item-valid-values). | 1.0 |
| `width` | `string or number` | — | Numeric values indicate relative weight. `auto` fits content, `stretch` shares remaining horizontal space, and `<number>px` sets explicit pixel width. | 1.0 |
| `backgroundImage` | `string or object` | — | Background image. Valid values: `BackgroundImage`. | 1.0 |
| `bleed` | `boolean` | `false` | Extends the container into its parent's padding. | 1.2 |
| `fallback` | `object or string` | — | Alternate element when this type or its required capabilities are unsupported. See [Fallback valid values](#fallback-valid-values). | 1.2 |
| `grid.area` | `string` | — | **Teams.** Area of a `Layout.AreaGrid` layout in which to display the element. | 1.5 |
| `height` | `string` | `auto` | Height; `stretch` uses remaining vertical space. Valid values: `auto`, `stretch`. | 1.1 |
| `horizontalAlignment` | `string` | — | Horizontal alignment. Valid values: `Left`, `Center`, `Right`. | 1.0 |
| `id` | `string` | — | Unique identifier for element/action. Inputs must have an ID to be validated and sent to the Bot. | 1.0 |
| `isSortKey` | `boolean` | `false` | Marks the element as a sort key for collections that support sorting. | 1.5 |
| `isVisible` | `boolean` | `true` | Controls visibility. | 1.2 |
| `isVisible.dynamic` | `string` | — | **Preview.** Expression evaluated at runtime to update `isVisible`. | 1.5 |
| `key` | `string` | — | Optional object key, occasionally useful for maintaining visual state. | 1.0 |
| `lang` | `string` | — | Locale associated with the element. | 1.1 |
| `layouts` | `array of object` | — | **Teams.** Responsive container layouts. Valid values: `Layout.Stack`, `Layout.Flow`, `Layout.AreaGrid`. | 1.5 |
| `maxHeight` | `string` | — | **Teams.** Maximum container height, format `<number>px`; a scrollbar is displayed on overflow. | 1.5 |
| `minHeight` | `string` | — | Minimum container height, format `<number>px`. | 1.2 |
| `requires` | `object` | `{}` | Capabilities required from the host; unsupported elements are omitted or replaced with a fallback. Valid values: `HostCapabilities`. | 1.2 |
| `roundedCorners` | `boolean` | `false` | **Teams.** Whether container corners are rounded. | 1.5 |
| `rtl` | `boolean` | — | Controls left-to-right or right-to-left rendering. | 1.0 |
| `selectAction` | `object` | — | Action on tap/click; `Action.ShowCard` is unsupported. See [SelectAction valid values](#selectaction-valid-values). | 1.1 |
| `separator` | `boolean` | `false` | Whether a line separates this element from the previous one (not shown for first element). | 1.0 |
| `showBorder` | `boolean` | `false` | **Teams.** Whether the container has a border. | 1.5 |
| `spacing` | `string` | `Default` | Space from the preceding element (not applied to the first). See [Spacing valid values](#spacing-valid-values). | 1.0 |
| `style` | `string` | — | Container style controlling background, border and text colors for contrast. See [Style valid values](#style-valid-values). | 1.0 |
| `targetWidth` | `string` | — | **Teams/Copilot.** Responsive card-width targeting; absent means all widths. See [TargetWidth valid values](#targetwidth-valid-values). | 1.0 |
| `verticalContentAlignment` | `string` | — | Vertical alignment. Valid values: `Top`, `Center`, `Bottom`. | 1.1 |

---

## Schema valid values

The lists below preserve the accepted values from the supplied documentation.

### Fallback valid values

`Container`, `ActionSet`, `ColumnSet`, `Media`, `RichTextBlock`, `Table`, `TextBlock`, `FactSet`, `ImageSet`, `Image`, `Input.Text`, `Input.Date`, `Input.Time`, `Input.Number`, `Input.Toggle`, `Input.ChoiceSet`, `Input.Rating`, `Rating`, `CompoundButton`, `Icon`, `Carousel`, `TabSet`, `Accordion`, `Badge`, `ProgressRing`, `ProgressBar`, `LoopComponent`, `Chart.Donut`, `Chart.Pie`, `Chart.VerticalBar.Grouped`, `Chart.VerticalBar`, `Chart.HorizontalBar`, `Chart.HorizontalBar.Stacked`, `Chart.Line`, `Chart.Gauge`, `CodeBlock`, `Persona`, `PersonaSet`, `Graph resource`, `File`, `Calendar event`, `"drop"`.

### Column item valid values

`Accordion`, `ActionSet`, `Badge`, `Carousel`, `Chart.Donut`, `Chart.Gauge`, `Chart.HorizontalBar`, `Chart.HorizontalBar.Stacked`, `Chart.Line`, `Chart.Pie`, `Chart.VerticalBar`, `Chart.VerticalBar.Grouped`, `CodeBlock`, `ColumnSet`, `Calendar event`, `File`, `Graph resource`, `Persona`, `PersonaSet`, `CompoundButton`, `Container`, `FactSet`, `Icon`, `Image`, `ImageSet`, `Input.ChoiceSet`, `Input.Date`, `Input.Number`, `Input.Rating`, `Input.Text`, `Input.Time`, `Input.Toggle`, `LoopComponent`, `Media`, `ProgressBar`, `ProgressRing`, `Rating`, `RichTextBlock`, `Table`, `TabSet`, `TextBlock`.

### SelectAction valid values

`Action.Execute`, `Action.InsertImage`, `Action.OpenUrl`, `Action.OpenUrlDialog`, `Action.Popover`, `Action.ResetInputs`, `Action.RunCommands`, `Action.Submit`, `Action.ToggleVisibility`.

### Spacing valid values

`None`, `ExtraSmall`, `Small`, `Default`, `Medium`, `Large`, `ExtraLarge`, `Padding`.

### Style valid values

`default`, `emphasis`, `accent`, `good`, `attention`, `warning`.

### TargetWidth valid values

`VeryNarrow`, `Narrow`, `Standard`, `Wide`, `atLeast:VeryNarrow`, `atMost:VeryNarrow`, `atLeast:Narrow`, `atMost:Narrow`, `atLeast:Standard`, `atMost:Standard`, `atLeast:Wide`, `atMost:Wide`.
