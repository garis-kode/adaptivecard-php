# Chart.Pie

**Works in:** Teams, Copilot

A pie chart.

## Example

```json
{
  "type": "AdaptiveCard",
  "version": "1.5",
  "body": [
    {
      "type": "Chart.Pie",
      "colorSet": "categorical",
      "data": [
        { "legend": "Pear", "value": 59 },
        { "legend": "Banana", "value": 292 },
        { "legend": "Apple", "value": 143 },
        { "legend": "Peach", "value": 98 },
        { "legend": "Kiwi", "value": 179 },
        { "legend": "Grapefruit", "value": 50 },
        { "legend": "Orange", "value": 212 },
        { "legend": "Cantaloupe", "value": 68 }
      ]
    }
  ]
}
```

## Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `type` | `string` | — | Must be `Chart.Pie`. | 1.0 |
| `colorSet` | `string` | — | The name of the set of colors to use to render the chart. See Chart colors reference. Valid values: `categorical`, `sequential`, `sequentialred`, `sequentialgreen`, `sequentialyellow`, `diverging`. | 1.5 |
| `data` | Array of `object` | — | The data to display in the chart. Valid value: `DonutChartData`. | 1.5 |
| `fallback` | `object` or `string` | — | An alternate element to render if this type is unsupported or the host lacks a capability specified in `requires`. See [Fallback valid values](#fallback-valid-values). | 1.2 |
| `grid.area` | `string` | — | **Teams.** The area of a `Layout.AreaGrid` layout in which an element should be displayed. | 1.5 |
| `height` | `string` | `"auto"` | Element height. `stretch` uses remaining vertical space. Values: `auto`, `stretch`. | 1.1 |
| `horizontalAlignment` | `string` | — | Horizontal alignment. Values: `Left`, `Center`, `Right`. | 1.0 |
| `id` | `string` | — | Unique identifier for an element or action. Input elements need an ID to be validated and included in Bot submissions. | 1.0 |
| `isSortKey` | `boolean` | `false` | Whether the element is used as a sort key by sortable collections. | 1.5 |
| `isVisible` | `boolean` | `true` | Controls element visibility. | 1.2 |
| `isVisible.dynamic` | `string` | — | **Preview.** Expression evaluated at runtime to update `isVisible`. | 1.5 |
| `key` | `string` | — | Optional key, sometimes useful to maintain host visual state. | 1.0 |
| `lang` | `string` | — | Locale associated with the element. | 1.1 |
| `maxWidth` | `string` | — | **Teams.** Maximum chart width in pixels, formatted as `<number>px`. | 1.5 |
| `requires` | `object` | `{}` | Required host capabilities; if unsupported, the element is not rendered or its fallback is used. Valid value: `HostCapabilities`. | 1.2 |
| `separator` | `boolean` | `false` | Display a separator above the element, except for the first element in a container. | 1.0 |
| `showLegend` | `boolean` | `true` | **Teams.** Whether to display the chart legend. | 1.5 |
| `showOutlines` | `boolean` | `true` | **Teams.** Whether to display outlines around donut segments. | 1.5 |
| `showTitle` | `boolean` | `false` | **Teams.** Whether to display the chart title. | 1.5 |
| `spacing` | `string` | `"Default"` | Space before the element; none is added for the first element in a container. Values: `None`, `ExtraSmall`, `Small`, `Default`, `Medium`, `Large`, `ExtraLarge`, `Padding`. | 1.0 |
| `targetWidth` | `string` | — | **Teams, Copilot.** Width conditions for rendering an element in a responsive card. See [Target width values](#target-width-values). | 1.0 |
| `thickness` | `string` | — | **Teams.** Thickness of donut segments (documented default: `Thick`). Values: `Thin`, `Thick`. | 1.5 |
| `title` | `string` | — | Chart title. | 1.5 |
| `value` | `string` | — | **Teams.** Center value for a donut chart; ignored for pie charts. | 1.5 |
| `valueColor` | `string` | — | **Teams.** Color of the center value for a donut chart. See [Chart color values](#chart-color-values). | 1.5 |

### Fallback valid values

`Container`, `ActionSet`, `ColumnSet`, `Media`, `RichTextBlock`, `Table`, `TextBlock`, `FactSet`, `ImageSet`, `Image`, `Input.Text`, `Input.Date`, `Input.Time`, `Input.Number`, `Input.Toggle`, `Input.ChoiceSet`, `Input.Rating`, `Rating`, `CompoundButton`, `Icon`, `Carousel`, `TabSet`, `Accordion`, `Badge`, `ProgressRing`, `ProgressBar`, `LoopComponent`, `Chart.Donut`, `Chart.Pie`, `Chart.VerticalBar.Grouped`, `Chart.VerticalBar`, `Chart.HorizontalBar`, `Chart.HorizontalBar.Stacked`, `Chart.Line`, `Chart.Gauge`, `CodeBlock`, `Persona`, `PersonaSet`, `Graph resource`, `File`, `Calendar event`, `"drop"`.

### Target width values

`VeryNarrow`, `Narrow`, `Standard`, `Wide`, `atLeast:VeryNarrow`, `atMost:VeryNarrow`, `atLeast:Narrow`, `atMost:Narrow`, `atLeast:Standard`, `atMost:Standard`, `atLeast:Wide`, `atMost:Wide`.

### Chart color values

`good`, `warning`, `attention`, `neutral`, `categoricalRed`, `categoricalPurple`, `categoricalLavender`, `categoricalBlue`, `categoricalLightBlue`, `categoricalTeal`, `categoricalGreen`, `categoricalLime`, `categoricalMarigold`, `sequential1`, `sequential2`, `sequential3`, `sequential4`, `sequential5`, `sequential6`, `sequential7`, `sequential8`, `divergingBlue`, `divergingLightBlue`, `divergingCyan`, `divergingTeal`, `divergingYellow`, `divergingPeach`, `divergingLightRed`, `divergingRed`, `divergingMaroon`, `divergingGray`, `sequentialRed1`, `sequentialRed2`, `sequentialRed3`, `sequentialRed4`, `sequentialRed5`, `sequentialRed6`, `sequentialRed7`, `sequentialRed8`, `sequentialGreen1`, `sequentialGreen2`, `sequentialGreen3`, `sequentialGreen4`, `sequentialGreen5`, `sequentialGreen6`, `sequentialGreen7`, `sequentialGreen8`, `sequentialYellow1`, `sequentialYellow2`, `sequentialYellow3`, `sequentialYellow4`, `sequentialYellow5`, `sequentialYellow6`, `sequentialYellow7`, `sequentialYellow8`.

> **Note:** This documentation preserves the provided Chart.Pie schema. It references `DonutChartData`, but that type's separate schema was not included in this request.
