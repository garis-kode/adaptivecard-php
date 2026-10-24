# Chart.Gauge

**Works in:** Teams · Copilot

A gauge chart.

## Example

```json
{
  "type": "AdaptiveCard",
  "version": "1.5",
  "body": [
    {
      "type": "Chart.Gauge",
      "title": "Basic gauge",
      "showTitle": true,
      "value": 50,
      "segments": [
        { "legend": "Low risk", "size": 33, "color": "good" },
        { "legend": "Medium risk", "size": 34, "color": "warning" },
        { "legend": "High risk", "size": 33, "color": "attention" }
      ]
    },
    {
      "type": "Chart.Gauge",
      "spacing": "large",
      "separator": true,
      "title": "Single value",
      "showTitle": true,
      "value": 35,
      "valueFormat": "fraction",
      "segments": [
        { "legend": "Used", "size": 35 },
        { "legend": "Unused", "size": 65, "color": "neutral" }
      ]
    },
    {
      "type": "Chart.Gauge",
      "spacing": "large",
      "separator": true,
      "title": "Minimal",
      "showTitle": false,
      "value": 35,
      "valueFormat": "fraction",
      "showLegend": false,
      "showMinMax": false,
      "showNeedle": false,
      "showOutlines": false,
      "maxWidth": "80px",
      "segments": [
        { "legend": "Used", "size": 35 },
        { "legend": "Unused", "size": 65, "color": "neutral" }
      ]
    }
  ]
}
```

## Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `type` | string | — | Must be `Chart.Gauge`. | 1.0 |
| `colorSet` | `string` | — | Name of the color set used to render the chart. See Chart colors reference. Valid values: `categorical`, `sequential`, `sequentialred`, `sequentialgreen`, `sequentialyellow`, `diverging`. | 1.5 |
| `fallback` | `object` or `string` | — | Alternate element if the type or required capabilities are unsupported. See [Valid `fallback` values](#valid-fallback-values). | 1.2 |
| `grid.area` | `string` | — | **Teams.** Area of a `Layout.AreaGrid` layout where the element is displayed. | 1.5 |
| `height` | `string` | `"auto"` | Element height; `stretch` uses remaining vertical space. Valid values: `auto`, `stretch`. | 1.1 |
| `horizontalAlignment` | `string` | — | Horizontal alignment. Valid values: `Left`, `Center`, `Right`. | 1.0 |
| `id` | `string` | — | Unique element/action identifier. Input elements require an ID for validation and submission to the Bot. | 1.0 |
| `isSortKey` | `boolean` | `false` | Whether the element is used as a sort key by sortable collections. | 1.5 |
| `isVisible` | `boolean` | `true` | Controls visibility. | 1.2 |
| `isVisible.dynamic` | `string` | — | **Preview.** Expression evaluated at runtime to update `isVisible`. | 1.5 |
| `key` | `string` | — | Optional object key; can help maintain visual state in some hosts. | 1.0 |
| `lang` | `string` | — | Locale associated with the element. | 1.1 |
| `max` | `number` | — | Maximum value of the gauge. | 1.5 |
| `maxWidth` | `string` | — | **Teams.** Maximum chart width in pixels, formatted as `<number>px`. | 1.5 |
| `min` | `number` | `0` | Minimum value of the gauge. | 1.5 |
| `requires` | `object` | `{}` | Required host capabilities (`HostCapabilities`). If not supported, the element is hidden or its fallback is rendered. | 1.2 |
| `segments` | `array of objects` | — | Gauge segments (`GaugeChartLegend`). | 1.5 |
| `separator` | `boolean` | `false` | Displays a separating line above the element, except for the first element in a container. | 1.0 |
| `showLegend` | `boolean` | `true` | **Teams.** Whether to display the chart legend. | 1.5 |
| `showMinMax` | `boolean` | `true` | Whether to display minimum and maximum values. | 1.5 |
| `showNeedle` | `boolean` | `true` | **Teams.** Whether to display the gauge needle. | 1.5 |
| `showOutlines` | `boolean` | `true` | **Teams.** Whether to display segment outlines. | 1.5 |
| `showTitle` | `boolean` | `false` | **Teams.** Whether to display the chart title. | 1.5 |
| `spacing` | `string` | `"Default"` | Space before the element (not applied to the first element). Valid values: `None`, `ExtraSmall`, `Small`, `Default`, `Medium`, `Large`, `ExtraLarge`, `Padding`. | 1.0 |
| `subLabel` | `string` | — | Gauge sub-label. | 1.5 |
| `targetWidth` | `string` | — | **Teams, Copilot.** Responsive card-width condition; otherwise displayed at all widths. See [Valid `targetWidth` values](#valid-targetwidth-values). | 1.0 |
| `title` | `string` | — | Chart title. | 1.5 |
| `value` | `number` | `0` | Gauge value. | 1.5 |
| `valueFormat` | `string` | `"Percentage"` | Display format. Valid values: `Percentage`, `Fraction`. | 1.5 |

## Valid values

### Valid `fallback` values

`fallback` accepts an alternate element of one of these types, or `"drop"`:

`Container`, `ActionSet`, `ColumnSet`, `Media`, `RichTextBlock`, `Table`, `TextBlock`, `FactSet`, `ImageSet`, `Image`, `Input.Text`, `Input.Date`, `Input.Time`, `Input.Number`, `Input.Toggle`, `Input.ChoiceSet`, `Input.Rating`, `Rating`, `CompoundButton`, `Icon`, `Carousel`, `TabSet`, `Accordion`, `Badge`, `ProgressRing`, `ProgressBar`, `LoopComponent`, `Chart.Donut`, `Chart.Pie`, `Chart.VerticalBar.Grouped`, `Chart.VerticalBar`, `Chart.HorizontalBar`, `Chart.HorizontalBar.Stacked`, `Chart.Line`, `Chart.Gauge`, `CodeBlock`, `Persona`, `PersonaSet`, `Graph resource`, `File`, `Calendar event`.

### Valid `targetWidth` values

`VeryNarrow`, `Narrow`, `Standard`, `Wide`, `atLeast:VeryNarrow`, `atMost:VeryNarrow`, `atLeast:Narrow`, `atMost:Narrow`, `atLeast:Standard`, `atMost:Standard`, `atLeast:Wide`, `atMost:Wide`.

## GaugeChartLegend

**Works in:** Teams · Copilot · Outlook

The legend of the chart.

### Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `color` | `string` | — | Segment color. See Chart colors reference and [Chart colors](#chart-colors). | 1.5 |
| `legend` | `string` | — | Legend text associated with the segment. | 1.5 |
| `size` | `number` | `0` | Size of the segment. | 1.5 |
| `key` | `string` | — | Optional object key; can help maintain visual state in some hosts. | 1.0 |

### Chart colors

- **Semantic:** `good`, `warning`, `attention`, `neutral`
- **Categorical:** `categoricalRed`, `categoricalPurple`, `categoricalLavender`, `categoricalBlue`, `categoricalLightBlue`, `categoricalTeal`, `categoricalGreen`, `categoricalLime`, `categoricalMarigold`
- **Sequential:** `sequential1`, `sequential2`, `sequential3`, `sequential4`, `sequential5`, `sequential6`, `sequential7`, `sequential8`
- **Diverging:** `divergingBlue`, `divergingLightBlue`, `divergingCyan`, `divergingTeal`, `divergingYellow`, `divergingPeach`, `divergingLightRed`, `divergingRed`, `divergingMaroon`, `divergingGray`
- **Sequential red:** `sequentialRed1`, `sequentialRed2`, `sequentialRed3`, `sequentialRed4`, `sequentialRed5`, `sequentialRed6`, `sequentialRed7`, `sequentialRed8`
- **Sequential green:** `sequentialGreen1`, `sequentialGreen2`, `sequentialGreen3`, `sequentialGreen4`, `sequentialGreen5`, `sequentialGreen6`, `sequentialGreen7`, `sequentialGreen8`
- **Sequential yellow:** `sequentialYellow1`, `sequentialYellow2`, `sequentialYellow3`, `sequentialYellow4`, `sequentialYellow5`, `sequentialYellow6`, `sequentialYellow7`, `sequentialYellow8`
