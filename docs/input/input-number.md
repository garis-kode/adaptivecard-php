# Input.Number

**Works in:** Teams, Copilot, Outlook

An input to allow the user to enter a number.

## Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `type` | `string` | — | Must be `Input.Number`. | 1.0 |
| `errorMessage` | `string` | — | The error message to display when the input fails validation. See *Input validation* for more details. | 1.3 |
| `fallback` | `object` or `string` | — | An alternate element to render if this type is unsupported, or if the host application doesn't support all capabilities specified in `requires`. See [Fallback values](#fallback-values). | 1.2 |
| `grid.area` | `string` | — | **Teams.** The area of a `Layout.AreaGrid` layout in which an element should be displayed. | 1.5 |
| `height` | `string` | `"auto"` | Height of the element. When set to `"stretch"`, the element uses the remaining vertical space in its container. Valid: `"auto"`, `"stretch"`. | 1.1 |
| `id` | `string` | — | A unique identifier for the element or action. Inputs must have an `id` to be validated and have their values sent to the Bot. | 1.0 |
| `isRequired` | `boolean` | `false` | Controls whether the input is required. See *Input validation*. | 1.3 |
| `isSortKey` | `boolean` | `false` | Controls whether the element is used as a sort key by elements that support sorting collections. | 1.5 |
| `isVisible` | `boolean` | `true` | Controls the visibility of the element. | 1.2 |
| `isVisible.dynamic` | `string` | — | **Preview.** Expression evaluated at runtime to update the element's `isVisible` property. | 1.5 |
| `key` | `string` | — | Optional object key; seldom needed, but can help maintain visual state in some host applications. | 1.0 |
| `label` | `string` | — | Label of the input. Always provide one for the best experience, especially for assistive technology users. | 1.3 |
| `lang` | `string` | — | Locale associated with the element. | 1.1 |
| `max` | `number` | — | Maximum value that can be entered. | 1.0 |
| `min` | `number` | — | Minimum value that can be entered. | 1.0 |
| `placeholder` | `string` | — | Text displayed as a placeholder when the user hasn't entered a value. | 1.0 |
| `requires` | `object` (`HostCapabilities`) | `{}` | Capabilities required from the host. If any capability is unavailable, the element is not rendered (or `fallback` is used). | 1.2 |
| `separator` | `boolean` | `false` | Displays a separator above the element to separate it from the previous one. Not shown for the first element in a container. | 1.0 |
| `showLabel` | `boolean` | `true` | **Preview.** Whether the input label is visually rendered. If `false`, the label remains the accessible name. | 1.5 |
| `spacing` | `string` | `"Default"` | Space between this element and the previous one. No space is added for the first element in a container. See [Spacing values](#spacing-values). | 1.0 |
| `targetWidth` | `string` | — | **Teams, Copilot.** Card widths at which the element is shown. If omitted, shown at all widths. Enables responsive layout; see [Target width values](#target-width-values). | 1.0 |
| `value` | `number` | — | Default value of the input. | 1.0 |
| `valueChangedAction` | `object` | — | **Teams.** An action executed when the input value changes. Valid values: `Action.OpenUrlDialog`, `Action.Popover`, `Action.ResetInputs`, `Action.RunCommands`. | 1.5 |

## Valid values

### Fallback values

`fallback` accepts an element object of one of the following types, or the string `"drop"`:

- `Container`, `ActionSet`, `ColumnSet`, `Media`, `RichTextBlock`, `Table`, `TextBlock`, `FactSet`, `ImageSet`, `Image`
- `Input.Text`, `Input.Date`, `Input.Time`, `Input.Number`, `Input.Toggle`, `Input.ChoiceSet`, `Input.Rating`
- `Rating`, `CompoundButton`, `Icon`, `Carousel`, `TabSet`, `Accordion`, `Badge`, `ProgressRing`, `ProgressBar`, `LoopComponent`
- `Chart.Donut`, `Chart.Pie`, `Chart.VerticalBar.Grouped`, `Chart.VerticalBar`, `Chart.HorizontalBar`, `Chart.HorizontalBar.Stacked`, `Chart.Line`, `Chart.Gauge`
- `CodeBlock`, `Persona`, `PersonaSet`, `Graph resource`, `File`, `Calendar event`
- `"drop"`

### Spacing values

`"None"`, `"ExtraSmall"`, `"Small"`, `"Default"`, `"Medium"`, `"Large"`, `"ExtraLarge"`, `"Padding"`.

### Target width values

`"VeryNarrow"`, `"Narrow"`, `"Standard"`, `"Wide"`, `"atLeast:VeryNarrow"`, `"atMost:VeryNarrow"`, `"atLeast:Narrow"`, `"atMost:Narrow"`, `"atLeast:Standard"`, `"atMost:Standard"`, `"atLeast:Wide"`, `"atMost:Wide"`.

## Notes

- Properties marked **Teams** are Teams-specific in the provided schema.
- Properties marked **Preview** are preview features.
- No JSON example was supplied in the source documentation.
