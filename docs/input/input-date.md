# Input.Date

**Works in:** Teams, Copilot, Outlook

An input to allow the user to select a date.

## Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `type` | `string` | — | Must be `Input.Date`. | 1.0 |
| `errorMessage` | `string` | — | The error message to display when the input fails validation. See *Input validation* for more details. | 1.3 |
| `fallback` | `object` or `string` | — | An alternate element to render if this type is unsupported or the host does not support all capabilities in `requires`. See [Fallback valid values](#fallback-valid-values). | 1.2 |
| `grid.area` | `string` | — | **Teams.** The area of a `Layout.AreaGrid` layout in which an element should be displayed. | 1.5 |
| `height` | `string` | `"auto"` | The height of the element. When set to `stretch`, the element uses the remaining vertical space in its container. Valid: `"auto"`, `"stretch"`. | 1.1 |
| `id` | `string` | — | A unique identifier for the element or action. Input elements must have an `id`; otherwise they will not be validated and their values will not be sent to the Bot. | 1.0 |
| `isRequired` | `boolean` | `false` | Controls whether the input is required. See *Input validation* for details. | 1.3 |
| `isSortKey` | `boolean` | `false` | Controls whether the element should be used as a sort key by elements allowing sorting across a collection. | 1.5 |
| `isVisible` | `boolean` | `true` | Controls the visibility of the element. | 1.2 |
| `isVisible.dynamic` | `string` | — | **Preview.** Expression evaluated at runtime to update `isVisible`. | 1.5 |
| `key` | `string` | — | Optional object key. Keys are seldom needed, but can help maintain visual state in certain host applications. | 1.0 |
| `label` | `string` | — | The label of the input. A label should always be provided for the best user experience, especially with assistive technology. | 1.3 |
| `lang` | `string` | — | The locale associated with the element. | 1.1 |
| `max` | `string` | — | The maximum date that can be selected. | 1.0 |
| `min` | `string` | — | The minimum date that can be selected. | 1.0 |
| `placeholder` | `string` | — | Text displayed as a placeholder when the user has not selected a date. | 1.0 |
| `requires` | `object` (`HostCapabilities`) | `{}` | Capabilities required of the host. If unsupported, the element is not rendered (or its `fallback` is rendered, if provided). | 1.2 |
| `separator` | `boolean` | `false` | Displays a separator above the element to distinguish it from the previous one. No separator is displayed for the first element in a container. | 1.0 |
| `showLabel` | `boolean` | `true` | **Preview.** Controls whether the label is rendered visually. If `false`, it remains the input's accessible name. | 1.5 |
| `spacing` | `string` | `"Default"` | Space between this and the previous element; none is added for the first element. See [Spacing values](#spacing-values). | 1.0 |
| `targetWidth` | `string` | — | **Teams, Copilot.** Widths at which the element should appear. Without this property it appears at all card widths. See [Target-width values](#target-width-values). | 1.0 |
| `value` | `string` | — | The default input value in `YYYY-MM-DD` format. | 1.0 |
| `valueChangedAction` | `object` | — | **Teams.** An action executed when the input value changes; described as `Action.ResetInputs`. See [Value-changed actions](#value-changed-actions). | 1.5 |

## Fallback valid values

The `fallback` property accepts any of the following element types, or `"drop"`:

`Container`, `ActionSet`, `ColumnSet`, `Media`, `RichTextBlock`, `Table`, `TextBlock`, `FactSet`, `ImageSet`, `Image`, `Input.Text`, `Input.Date`, `Input.Time`, `Input.Number`, `Input.Toggle`, `Input.ChoiceSet`, `Input.Rating`, `Rating`, `CompoundButton`, `Icon`, `Carousel`, `TabSet`, `Accordion`, `Badge`, `ProgressRing`, `ProgressBar`, `LoopComponent`, `Chart.Donut`, `Chart.Pie`, `Chart.VerticalBar.Grouped`, `Chart.VerticalBar`, `Chart.HorizontalBar`, `Chart.HorizontalBar.Stacked`, `Chart.Line`, `Chart.Gauge`, `CodeBlock`, `Persona`, `PersonaSet`, `Graph resource`, `File`, `Calendar event`, `"drop"`.

## Spacing values

`"None"`, `"ExtraSmall"`, `"Small"`, `"Default"`, `"Medium"`, `"Large"`, `"ExtraLarge"`, `"Padding"`.

## Target-width values

`"VeryNarrow"`, `"Narrow"`, `"Standard"`, `"Wide"`, `"atLeast:VeryNarrow"`, `"atMost:VeryNarrow"`, `"atLeast:Narrow"`, `"atMost:Narrow"`, `"atLeast:Standard"`, `"atMost:Standard"`, `"atLeast:Wide"`, `"atMost:Wide"`.

## Value-changed actions

Valid values of `valueChangedAction`:

`Action.OpenUrlDialog`, `Action.Popover`, `Action.ResetInputs`, `Action.RunCommands`.

## Other valid values

- `height`: `"auto"`, `"stretch"`.
- `requires`: `HostCapabilities`.

