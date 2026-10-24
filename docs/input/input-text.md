# Input.Text

**Works in:** Teams · Copilot · Outlook

An input to allow the user to enter text.

## Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `type` | `string` | — | Must be `Input.Text`. | 1.0 |
| `errorMessage` | `string` | — | The error message to display when the input fails validation. See *Input validation* for more details. | 1.3 |
| `fallback` | `object` or `string` | — | An alternate element to render if this type is unsupported or the host does not support all capabilities in `requires`. See [Fallback values](#fallback-values). | 1.2 |
| `grid.area` | `string` | — | **Teams.** The area of a `Layout.AreaGrid` layout in which an element should be displayed. | 1.5 |
| `height` | `string` | `"auto"` | The height of the element. When set to `"stretch"`, uses remaining vertical space in its container. Valid: `"auto"`, `"stretch"`. | 1.1 |
| `id` | `string` | — | A unique identifier for the element or action. Input elements must have an `id` to be validated and send their values to the Bot. | 1.0 |
| `inlineAction` | `object` | — | The action displayed as a button alongside the input. `Action.ShowCard` is unsupported. See [Inline action values](#inline-action-values). | 1.0 |
| `isMultiline` | `boolean` | `false` | Controls whether the input allows multiple lines of text. | 1.0 |
| `isRequired` | `boolean` | `false` | Controls whether the input is required. See *Input validation* for more details. | 1.3 |
| `isSortKey` | `boolean` | `false` | Controls whether the element is used as a sort key in sortable collections. | 1.5 |
| `isVisible` | `boolean` | `true` | Controls visibility of the element. | 1.2 |
| `isVisible.dynamic` | `string` | — | **Preview.** An expression whose evaluated value updates `isVisible` at runtime. | 1.5 |
| `key` | `string` | — | Optional object key. Rarely needed, but may help maintain visual state in the host application. | 1.0 |
| `label` | `string` | — | The input label. Always provide a label for accessibility and the best user experience. | 1.3 |
| `lang` | `string` | — | The locale associated with the element. | 1.1 |
| `maxLength` | `number` | — | Maximum length of the entered text. | 1.0 |
| `placeholder` | `string` | — | Placeholder shown when the user has not entered a value. | 1.0 |
| `regex` | `string` | — | Regular expression used to validate the input. | 1.3 |
| `requires` | `object` (`HostCapabilities`) | `{}` | Required host capabilities. If any requirement is unsupported, the element is not rendered, or `fallback` is rendered if provided. | 1.2 |
| `separator` | `boolean` | `false` | Display a separator above the element, except when it is the first element in a container. | 1.0 |
| `showLabel` | `boolean` | `true` | **Preview.** Whether the label is visually rendered. When `false`, the label remains the accessible name. | 1.5 |
| `spacing` | `string` | `"Default"` | Space between this element and the previous one. No space is added for the first element in a container. See [Spacing values](#spacing-values). | 1.0 |
| `style` | `string` | `"Text"` | Input style. Valid: `"Text"`, `"Tel"`, `"Url"`, `"Email"`, `"Password"`. | 1.0 |
| `targetWidth` | `string` | — | **Teams, Copilot.** Card widths for which this element is displayed. Unspecified means all widths; supports responsive layouts. See [Target width values](#target-width-values). | 1.0 |
| `value` | `string` | — | Default value of the input. | 1.0 |
| `valueChangedAction` | `object` | — | **Teams.** An action executed when the input changes. See [Value-changed action values](#value-changed-action-values). | 1.5 |

## Valid values

### Valid `fallback` values

`fallback` accepts one of the following element objects or the string `"drop"`:

- `Container`, `ActionSet`, `ColumnSet`, `Media`, `RichTextBlock`, `Table`, `TextBlock`, `FactSet`, `ImageSet`, `Image`
- `Input.Text`, `Input.Date`, `Input.Time`, `Input.Number`, `Input.Toggle`, `Input.ChoiceSet`, `Input.Rating`
- `Rating`, `CompoundButton`, `Icon`, `Carousel`, `TabSet`, `Accordion`, `Badge`, `ProgressRing`, `ProgressBar`, `LoopComponent`
- `Chart.Donut`, `Chart.Pie`, `Chart.VerticalBar.Grouped`, `Chart.VerticalBar`, `Chart.HorizontalBar`, `Chart.HorizontalBar.Stacked`, `Chart.Line`, `Chart.Gauge`
- `CodeBlock`, `Persona`, `PersonaSet`, `Graph resource`, `File`, `Calendar event`
- `"drop"`

### Valid `inlineAction` values

`Action.Execute`, `Action.InsertImage`, `Action.OpenUrl`, `Action.OpenUrlDialog`, `Action.Popover`, `Action.ResetInputs`, `Action.RunCommands`, `Action.Submit`, `Action.ToggleVisibility`.

### Valid `spacing` values

`"None"`, `"ExtraSmall"`, `"Small"`, `"Default"`, `"Medium"`, `"Large"`, `"ExtraLarge"`, `"Padding"`.

### Valid `targetWidth` values

`"VeryNarrow"`, `"Narrow"`, `"Standard"`, `"Wide"`, `"atLeast:VeryNarrow"`, `"atMost:VeryNarrow"`, `"atLeast:Narrow"`, `"atMost:Narrow"`, `"atLeast:Standard"`, `"atMost:Standard"`, `"atLeast:Wide"`, `"atMost:Wide"`.

### Valid `valueChangedAction` values

`Action.OpenUrlDialog`, `Action.Popover`, `Action.ResetInputs`, `Action.RunCommands`.
