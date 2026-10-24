# FactSet

**Works in:** Teams · Copilot · Outlook

A set of facts, displayed as a table or a vertical list when horizontal space is constrained.

Use `FactSet` to display a series of title and value pairs in a simple table layout. `FactSet` is responsive out of the box and will adjust its layout to a vertical list as the card becomes narrower, as shown in the example below.

## Example

```json
{
  "type": "AdaptiveCard",
  "body": [
    {
      "type": "FactSet",
      "facts": [
        {
          "title": "Movie:",
          "value": "The Quirky Chronicles of Quinton's Café"
        },
        {
          "title": "Synopsis:",
          "value": "Quinton's café brings comic characters to life, creating hilarious chaos in Willowbrook."
        },
        {
          "title": "Released:",
          "value": "2024"
        },
        {
          "title": "Cast:",
          "value": "Daxley Krane, Aria Skye, Maximus Blaze, Thalia Rose, Ophelia Bright, Hugo Vance"
        }
      ]
    }
  ],
  "version": "1.5"
}
```

## Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `type` | `string` | — | Must be `FactSet`. | 1.0 |
| `facts` | `array of object` | — | The facts in the set. Valid values: `Fact`. | 1.0 |
| `fallback` | `object or string` | — | An alternate element to render if this type is unsupported or the host application does not support all capabilities specified in `requires`. See valid values below. | 1.2 |
| `grid.area` | `string` | — | **Teams.** The area of a `Layout.AreaGrid` layout in which an element should be displayed. | 1.5 |
| `height` | `string` | `"auto"` | Height of the element. `stretch` uses the remaining vertical space. Valid values: `"auto"`, `"stretch"`. | 1.1 |
| `id` | `string` | — | Unique identifier for the element or action. Input elements must have an ID to be validated and have their values sent to the Bot. | 1.0 |
| `isSortKey` | `boolean` | `false` | Whether the element is used as a sort key by elements that support collection sorting. | 1.5 |
| `isVisible` | `boolean` | `true` | Controls the visibility of the element. | 1.2 |
| `isVisible.dynamic` | `string` | — | **Preview.** An expression evaluated at runtime to update `isVisible`. | 1.5 |
| `key` | `string` | — | Optional object key. Rarely needed, but can help maintain visual state in the host application. | 1.0 |
| `lang` | `string` | — | The locale associated with the element. | 1.1 |
| `requires` | `object` | `{}` | Required host capabilities; unsupported elements are not rendered (or use `fallback`). Valid values: `HostCapabilities`. | 1.2 |
| `separator` | `boolean` | `false` | Whether to show a separator above this element; none appears for the first element in a container. | 1.0 |
| `spacing` | `string` | `"Default"` | Space between this element and the preceding one; no space for the first element in a container. See valid values below. | 1.0 |
| `targetWidth` | `string` | — | **Teams/Copilot.** Controls which card widths render the element. Without this property, the element renders at all widths. See valid values below. | 1.0 |

### Valid `fallback` values

`Container`, `ActionSet`, `ColumnSet`, `Media`, `RichTextBlock`, `Table`, `TextBlock`, `FactSet`, `ImageSet`, `Image`, `Input.Text`, `Input.Date`, `Input.Time`, `Input.Number`, `Input.Toggle`, `Input.ChoiceSet`, `Input.Rating`, `Rating`, `CompoundButton`, `Icon`, `Carousel`, `TabSet`, `Accordion`, `Badge`, `ProgressRing`, `ProgressBar`, `LoopComponent`, `Chart.Donut`, `Chart.Pie`, `Chart.VerticalBar.Grouped`, `Chart.VerticalBar`, `Chart.HorizontalBar`, `Chart.HorizontalBar.Stacked`, `Chart.Line`, `Chart.Gauge`, `CodeBlock`, `Persona`, `PersonaSet`, `Graph resource`, `File`, `Calendar event`, `"drop"`.

### Valid `spacing` values

`"None"`, `"ExtraSmall"`, `"Small"`, `"Default"`, `"Medium"`, `"Large"`, `"ExtraLarge"`, `"Padding"`.

### Valid `targetWidth` values

`"VeryNarrow"`, `"Narrow"`, `"Standard"`, `"Wide"`, `"atLeast:VeryNarrow"`, `"atMost:VeryNarrow"`, `"atLeast:Narrow"`, `"atMost:Narrow"`, `"atLeast:Standard"`, `"atMost:Standard"`, `"atLeast:Wide"`, `"atMost:Wide"`.

---

## Fact

**Works in:** Teams · Copilot · Outlook

A fact in a `FactSet` element.

### Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `title` | `string` | — | The fact's title. | 1.0 |
| `value` | `string` | — | The fact's value. | 1.0 |
| `key` | `string` | — | Defines an optional key for the object. Keys are seldom needed, but can help maintain visual state in the host application. | 1.0 |
