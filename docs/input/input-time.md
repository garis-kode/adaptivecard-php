# Input.Time

**Works in:** Teams, Copilot, Outlook

An input to allow the user to select a time.

## Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `type` | `string` | — | Must be `Input.Time`. | 1.0 |
| `errorMessage` | `string` | — | The error message to display when the input fails validation. See *Input validation* for more details. | 1.3 |
| `fallback` | `object` or `string` | — | An alternate element to render if this type is unsupported or if the host does not support all capabilities specified in `requires`. See [Fallback values](#fallback-values). | 1.2 |
| `grid.area` | `string` | — | **Teams.** The area of a `Layout.AreaGrid` layout in which an element should be displayed. | 1.5 |
| `height` | `string` | `"auto"` | The height of the element. When set to `"stretch"`, the element uses the remaining vertical space in its container. Valid: `"auto"`, `"stretch"`. | 1.1 |
| `id` | `string` | — | A unique identifier for the element or action. Input elements must have an `id`; otherwise they will not be validated and their values will not be sent to the Bot. | 1.0 |
| `isRequired` | `boolean` | `false` | Controls whether the input is required. See *Input validation* for more details. | 1.3 |
| `isSortKey` | `boolean` | `false` | Controls whether the element should be used as a sort key by elements that allow sorting across a collection of elements. | 1.5 |
| `isVisible` | `boolean` | `true` | Controls the visibility of the element. | 1.2 |
| `isVisible.dynamic` | `string` | — | **Preview.** Defines an expression whose evaluated value updates `isVisible` at runtime. | 1.5 |
| `key` | `string` | — | Defines an optional key for the object. Keys are seldom needed, but can help maintain visual state in the host application. | 1.0 |
| `label` | `string` | — | The label of the input. A label should always be provided to ensure the best user experience, especially for users of assistive technology. | 1.3 |
| `lang` | `string` | — | The locale associated with the element. | 1.1 |
| `max` | `string` | — | The maximum time that can be selected, in `HH:MM` format. | 1.0 |
| `min` | `string` | — | The minimum time that can be selected, in `HH:MM` format. | 1.0 |
| `placeholder` | `string` | — | The text to display as a placeholder when the user hasn't entered a value. | 1.0 |
| `requires` | `object` (`HostCapabilities`) | `{}` | A list of capabilities the element requires the host application to support. If any are unsupported, the element is not rendered, or its `fallback` is rendered if provided. | 1.2 |
| `separator` | `boolean` | `false` | Controls whether a separator line is displayed above the element. No separator appears for the first element in a container, even when true. | 1.0 |
| `showLabel` | `boolean` | `true` | **Preview.** Controls whether the input label is visually rendered. When false, the label is still applied as the input's accessible name. | 1.5 |
| `spacing` | `string` | `"Default"` | Controls the space between this element and the previous one. None is added for the first element in a container. See [Spacing values](#spacing-values). | 1.0 |
| `targetWidth` | `string` | — | **Teams, Copilot.** Controls for which card widths the element is displayed. If omitted, the element renders at all widths. See [Target width values](#target-width-values). | 1.0 |
| `value` | `string` | — | The default value of the input, in `HH:MM` format. | 1.0 |
| `valueChangedAction` | `object` | — | **Teams.** An action executed when the value of the input changes. See [Value-changed actions](#value-changed-actions). | 1.5 |

## Valid values

### Fallback values

`fallback` can be one of these element types, or the string `"drop"`:

- `Container`, `ActionSet`, `ColumnSet`, `Media`, `RichTextBlock`, `Table`, `TextBlock`, `FactSet`, `ImageSet`, `Image`
- `Input.Text`, `Input.Date`, `Input.Time`, `Input.Number`, `Input.Toggle`, `Input.ChoiceSet`, `Input.Rating`
- `Rating`, `CompoundButton`, `Icon`, `Carousel`, `TabSet`, `Accordion`, `Badge`, `ProgressRing`, `ProgressBar`, `LoopComponent`
- `Chart.Donut`, `Chart.Pie`, `Chart.VerticalBar.Grouped`, `Chart.VerticalBar`, `Chart.HorizontalBar`, `Chart.HorizontalBar.Stacked`, `Chart.Line`, `Chart.Gauge`
- `CodeBlock`, `Persona`, `PersonaSet`, `Graph resource`, `File`, `Calendar event`
- `"drop"`

### Spacing values

`"None"`, `"ExtraSmall"`, `"Small"`, `"Default"`, `"Medium"`, `"Large"`, `"ExtraLarge"`, `"Padding"`

### Target width values

`"VeryNarrow"`, `"Narrow"`, `"Standard"`, `"Wide"`, `"atLeast:VeryNarrow"`, `"atMost:VeryNarrow"`, `"atLeast:Narrow"`, `"atMost:Narrow"`, `"atLeast:Standard"`, `"atMost:Standard"`, `"atLeast:Wide"`, `"atMost:Wide"`

### Value-changed actions

`Action.OpenUrlDialog`, `Action.Popover`, `Action.ResetInputs`, `Action.RunCommands`
