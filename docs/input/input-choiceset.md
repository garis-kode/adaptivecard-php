# Input.ChoiceSet

**Works in:** Teams · Copilot · Outlook

An input to allow the user to select one or more values.

## Example

```json
{
  "type": "AdaptiveCard",
  "version": "1.3",
  "body": [
    {
      "type": "Input.ChoiceSet",
      "id": "myColor",
      "style": "compact",
      "label": "Compact single select",
      "isMultiSelect": false,
      "value": "1",
      "choices": [
        {"title": "Red", "value": "1"},
        {"title": "Green", "value": "2"},
        {"title": "Blue", "value": "3"}
      ]
    },
    {
      "type": "Input.ChoiceSet",
      "id": "myColor2",
      "style": "expanded",
      "label": "Expanded single select",
      "isMultiSelect": false,
      "value": "1",
      "choices": [
        {"title": "Red", "value": "1"},
        {"title": "Green", "value": "2"},
        {"title": "Blue", "value": "3"}
      ]
    },
    {
      "type": "Input.ChoiceSet",
      "id": "myColor3",
      "isMultiSelect": true,
      "value": "1,3",
      "style": "compact",
      "label": "Compact multiselect",
      "choices": [
        {"title": "Red", "value": "1"},
        {"title": "Green", "value": "2"},
        {"title": "Blue", "value": "3"}
      ]
    },
    {
      "type": "Input.ChoiceSet",
      "id": "myColor4",
      "isMultiSelect": true,
      "value": "1",
      "style": "expanded",
      "label": "Expanded multiselect",
      "choices": [
        {"title": "Red", "value": "1"},
        {"title": "Green", "value": "2"},
        {"title": "Blue", "value": "3"}
      ]
    }
  ],
  "actions": [{"type": "Action.Submit", "title": "OK"}]
}
```

> **Tips**
> - Configure `Input.ChoiceSet` to support Dynamic Typeahead Search.
> - Link a Dynamic Typeahead Search-enabled `Input.ChoiceSet` to another input in the card.
> - Configure `Input.ChoiceSet` as a People Picker.

## Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `type` | `string` | — | Must be `Input.ChoiceSet`. | 1.0 |
| `choices` | `array of objects` | — | Choices associated with the input. Valid type: `Choice`. | 1.0 |
| `choices.data` | `object` | — | A `Data.Query` object defining the dataset from which to dynamically fetch choices. | 1.5 |
| `errorMessage` | `string` | — | Error message displayed when input validation fails. See Input validation. | 1.3 |
| `fallback` | `object` or `string` | — | Alternate element rendered when unsupported or required capabilities are unavailable. See [Valid `fallback` values](#valid-fallback-values). | 1.2 |
| `grid.area` | `string` | — | **Teams.** Area in a `Layout.AreaGrid` layout in which the element is displayed. | 1.5 |
| `height` | `string` | `"auto"` | Element height; `stretch` consumes remaining vertical space. Valid values: `"auto"`, `"stretch"`. | 1.1 |
| `id` | `string` | — | Unique element/action identifier. Inputs must have an `id` to be validated and sent to the Bot. | 1.0 |
| `isMultiSelect` | `boolean` | `false` | Whether multiple choices can be selected. | 1.0 |
| `isRequired` | `boolean` | `false` | Whether the input is required. See Input validation. | 1.3 |
| `isSortKey` | `boolean` | `false` | Whether the element is used as a sort key in sortable collections. | 1.5 |
| `isVisible` | `boolean` | `true` | Controls visibility of the element. | 1.2 |
| `isVisible.dynamic` | `string` | — | **Preview.** Expression evaluated at runtime to update `isVisible`. | 1.5 |
| `key` | `string` | — | Optional object key; can help maintain visual state in the host. | 1.0 |
| `label` | `string` | — | Input label. Always provide a label for accessibility. | 1.3 |
| `lang` | `string` | — | Locale associated with the element. | 1.1 |
| `minColumnWidth` | `string` | 100 pixels (described) | Minimum column width in multi-column layouts, formatted as `<number>px`. | 1.5 |
| `placeholder` | `string` | — | Placeholder text shown when the user has not entered a value. | 1.0 |
| `requires` | `object` | `{}` | Required host capabilities; unsupported elements are omitted or replaced by `fallback`. Valid type: `HostCapabilities`. | 1.2 |
| `separator` | `boolean` | `false` | Displays a separator above the element except when it is the first element in a container. | 1.0 |
| `showLabel` | `boolean` | `true` | **Preview.** Whether the label is visually rendered; when false, the label remains the accessible name. | 1.5 |
| `spacing` | `string` | `"Default"` | Space before the element, except for the first element in a container. See [Valid `spacing` values](#valid-spacing-values). | 1.0 |
| `style` | `string` | `"compact"` | Dropdown vs. radio buttons or checkboxes. Valid values: `"compact"`, `"expanded"`, `"filtered"`. | 1.0 |
| `targetWidth` | `string` | — | **Teams, Copilot.** Display card at selected responsive widths; omitted means all widths. See [Valid `targetWidth` values](#valid-targetwidth-values). | 1.0 |
| `useMultipleColumns` | `boolean` | `false` | Arrange expanded choice items in multiple columns instead of one. | 1.5 |
| `value` | `string` | — | Default input value. | 1.0 |
| `valueChangedAction` | `object` | — | **Teams.** Action executed when input value changes. Supported types: `Action.OpenUrlDialog`, `Action.Popover`, `Action.ResetInputs`, `Action.RunCommands`. | 1.5 |
| `wrap` | `boolean` | `true` | Whether choice titles wrap. | 1.2 |

## Valid values

### Valid `fallback` values

`Container`, `ActionSet`, `ColumnSet`, `Media`, `RichTextBlock`, `Table`, `TextBlock`, `FactSet`, `ImageSet`, `Image`, `Input.Text`, `Input.Date`, `Input.Time`, `Input.Number`, `Input.Toggle`, `Input.ChoiceSet`, `Input.Rating`, `Rating`, `CompoundButton`, `Icon`, `Carousel`, `TabSet`, `Accordion`, `Badge`, `ProgressRing`, `ProgressBar`, `LoopComponent`, `Chart.Donut`, `Chart.Pie`, `Chart.VerticalBar.Grouped`, `Chart.VerticalBar`, `Chart.HorizontalBar`, `Chart.HorizontalBar.Stacked`, `Chart.Line`, `Chart.Gauge`, `CodeBlock`, `Persona`, `PersonaSet`, `Graph resource`, `File`, `Calendar event`, `"drop"`.

### Valid `spacing` values

`"None"`, `"ExtraSmall"`, `"Small"`, `"Default"`, `"Medium"`, `"Large"`, `"ExtraLarge"`, `"Padding"`.

### Valid `targetWidth` values

`"VeryNarrow"`, `"Narrow"`, `"Standard"`, `"Wide"`, `"atLeast:VeryNarrow"`, `"atMost:VeryNarrow"`, `"atLeast:Narrow"`, `"atMost:Narrow"`, `"atLeast:Standard"`, `"atMost:Standard"`, `"atLeast:Wide"`, `"atMost:Wide"`.

## Choice

**Works in:** Teams · Copilot · Outlook

A choice as used by the `Input.ChoiceSet` input.

### Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `title` | `string` | — | Text to display for the choice. | 1.0 |
| `value` | `string` | — | Value sent to the Bot when an `Action.Submit` or `Action.Execute` is invoked. | 1.0 |
| `key` | `string` | — | Optional object key; in some scenarios helps maintain visual state in the host application. | 1.0 |

## Data.Query

**Works in:** Teams · Copilot · Outlook

Defines a query to dynamically fetch data from a Bot.

An `application/search` Invoke request received by your Bot for a `Data.Query` includes values of all inputs in the card. This lets you link a Dynamic Typeahead Search-enabled `Input.ChoiceSet` to other inputs and filter results returned by the Bot.

### Example Invoke request

The source example uses `...` and a comment as placeholders, so this is an illustrative **JSON-like** snippet, not strict JSON.

```javascript
{
  "name": "application/search",
  "type": "invoke",
  "value": {
    "queryText": "some text",
    "queryOptions": {
      "skip": 0,
      "top": 15
    },
    "dataset": "cities",
    "data": {
      "input1": "<value of input1>",
      "input2": "<value of input2>",
      ...
    }
  }
  // ... other fields
}
```

> **Tip:** Set `Data.Query.dataset` to `graph.microsoft.com/users` to implement a People Picker. See *Adding a People Picker to your Adaptive Card* for more details.

### Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `type` | `string` | — | Must be `Data.Query`. | 1.0 |
| `associatedInputs` | `string` | — | **Teams.** Controls which inputs accompany the query so the Bot can filter results. Valid values: `"auto"`, `"none"`. | 1.0 |
| `count` | `number` | — | Maximum result items. Do **not** specify in card payload; the client supplies it for pagination. | 1.0 |
| `dataset` | `string` | — | Dataset from which to fetch data. | 1.0 |
| `skip` | `number` | — | Number of items skipped. Do **not** specify in card payload; the client supplies it for pagination. | 1.0 |
| `key` | `string` | — | Optional object key; can help maintain visual state in the host application. | 1.0 |
