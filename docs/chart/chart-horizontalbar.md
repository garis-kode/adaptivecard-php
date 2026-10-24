# Chart.HorizontalBar

**Works in:** Teams · Copilot

A horizontal bar chart.

> **Tip:** `Chart.HorizontalBar` does not support negative x-axis values. If you need negative x-axis values, use `Chart.Line` instead.

## Examples

### Absolute scale with axis

```json
{
  "type": "AdaptiveCard",
  "version": "1.5",
  "body": [
    {
      "type": "Chart.HorizontalBar",
      "title": "Sample",
      "xAxisTitle": "Days",
      "yAxisTitle": "Sales",
      "colorSet": "diverging",
      "data": [
        { "x": "Pear", "y": 59 },
        { "x": "Banana", "y": 292 },
        { "x": "Apple", "y": 143 },
        { "x": "Peach", "y": 98 },
        { "x": "Kiwi", "y": 179 },
        { "x": "Grapefruit", "y": 20 }
      ]
    }
  ]
}
```

### Absolute scale without axis

The source shows these rendered values (no JSON payload was supplied):

| Category | Value |
| --- | ---: |
| Pear | 59 |
| Banana | 292 |
| Apple | 143 |
| Peach | 98 |
| Kiwi | 179 |
| Grapefruit | 20 |

### Parts-to-whole

The source shows these rendered values (no JSON payload was supplied):

| Response | Count | Share |
| --- | ---: | ---: |
| Yes, I have defined my day of learning goal | 15 | 36.6% |
| No, I haven't yet had time to do it | 24 | 58.5% |
| I am not interested in learning | 2 | 4.9% |
| **Total** | **41** | |

## Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `type` | `string` | — | Must be `Chart.HorizontalBar`. | 1.0 |
| `color` | `string` | — | Color to use for all data points. See [Chart colors](#chart-colors). | 1.5 |
| `colorSet` | `string` | — | Set of colors used to render the chart. Valid values: `categorical`, `sequential`, `sequentialred`, `sequentialgreen`, `sequentialyellow`, `diverging`. | 1.5 |
| `data` | `array of objects` | — | Data points in the chart. Valid item type: `HorizontalBarChartDataValue`. | 1.5 |
| `displayMode` | `string` | `AbsoluteWithAxis` | Visual layout. Valid values: `AbsoluteWithAxis`, `AbsoluteNoAxis`, `PartToWhole`. | 1.5 |
| `fallback` | `object` or `string` | — | Alternate element if unsupported or `requires` cannot be satisfied. See [Valid `fallback` values](#valid-fallback-values). | 1.2 |
| `grid.area` | `string` | — | **Teams.** Area of a `Layout.AreaGrid` in which the element appears. | 1.5 |
| `height` | `string` | `auto` | Height; `stretch` uses remaining vertical space. Valid values: `auto`, `stretch`. | 1.1 |
| `horizontalAlignment` | `string` | — | Horizontal alignment. Valid values: `Left`, `Center`, `Right`. | 1.0 |
| `id` | `string` | — | Unique element/action identifier. Inputs require an ID for validation and Bot submission. | 1.0 |
| `isSortKey` | `boolean` | `false` | Whether the element is a sort key in sortable collections. | 1.5 |
| `isVisible` | `boolean` | `true` | Controls visibility. | 1.2 |
| `isVisible.dynamic` | `string` | — | **Preview.** Expression evaluated to update visibility at runtime. | 1.5 |
| `key` | `string` | — | Optional key; can help maintain visual state in some host scenarios. | 1.0 |
| `lang` | `string` | — | Locale associated with the element. | 1.1 |
| `maxWidth` | `string` | — | **Teams.** Maximum chart width in pixels. Format: `<number>px`. | 1.5 |
| `requires` | `object` | `{}` | Required host capabilities (`HostCapabilities`); render fallback if unsupported. | 1.2 |
| `separator` | `boolean` | `false` | Whether to display a separator above this element; omitted for first item in a container. | 1.0 |
| `showLegend` | `boolean` | `true` | **Teams.** Whether the chart legend is displayed. | 1.5 |
| `showTitle` | `boolean` | `false` | **Teams.** Whether the chart title is displayed. | 1.5 |
| `spacing` | `string` | `Default` | Spacing from preceding element. Valid values: `None`, `ExtraSmall`, `Small`, `Default`, `Medium`, `Large`, `ExtraLarge`, `Padding`. | 1.0 |
| `targetWidth` | `string` | — | **Teams, Copilot.** Card widths at which this element renders; see [Valid `targetWidth` values](#valid-targetwidth-values). If omitted, it renders at every width. | 1.0 |
| `title` | `string` | — | Title of the chart. | 1.5 |
| `xAxisTitle` | `string` | — | Title of the x-axis. | 1.5 |
| `yAxisTitle` | `string` | — | Title of the y-axis. | 1.5 |

## BarChartDataValue

**Works in:** Teams · Copilot · Outlook

A single data point in a bar chart.

### Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `x` | `string` | — | The x-axis value of the data point. | 1.5 |
| `y` | `number` | `0` | The y-axis value of the data point. | 1.5 |
| `key` | `string` | — | Optional key; can help preserve visual state in the host. | 1.0 |

## HorizontalBarChartDataValue

**Works in:** Teams · Copilot · Outlook

A single data point in a horizontal bar chart.

### Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `color` | `string` | — | Bar color for this data point. See [Chart colors](#chart-colors). | 1.5 |
| `x` | `string` | — | The x-axis value of the data point. | 1.5 |
| `y` | `number` | `0` | The y-axis value of the data point. | 1.5 |
| `key` | `string` | — | Optional key; can help preserve visual state in the host. | 1.0 |

## Valid values

### Chart colors

Valid values for `Chart.HorizontalBar.color` and `HorizontalBarChartDataValue.color`:

- Semantic: `good`, `warning`, `attention`, `neutral`
- Categorical: `categoricalRed`, `categoricalPurple`, `categoricalLavender`, `categoricalBlue`, `categoricalLightBlue`, `categoricalTeal`, `categoricalGreen`, `categoricalLime`, `categoricalMarigold`
- Sequential: `sequential1`, `sequential2`, `sequential3`, `sequential4`, `sequential5`, `sequential6`, `sequential7`, `sequential8`
- Diverging: `divergingBlue`, `divergingLightBlue`, `divergingCyan`, `divergingTeal`, `divergingYellow`, `divergingPeach`, `divergingLightRed`, `divergingRed`, `divergingMaroon`, `divergingGray`
- Sequential red: `sequentialRed1`, `sequentialRed2`, `sequentialRed3`, `sequentialRed4`, `sequentialRed5`, `sequentialRed6`, `sequentialRed7`, `sequentialRed8`
- Sequential green: `sequentialGreen1`, `sequentialGreen2`, `sequentialGreen3`, `sequentialGreen4`, `sequentialGreen5`, `sequentialGreen6`, `sequentialGreen7`, `sequentialGreen8`
- Sequential yellow: `sequentialYellow1`, `sequentialYellow2`, `sequentialYellow3`, `sequentialYellow4`, `sequentialYellow5`, `sequentialYellow6`, `sequentialYellow7`, `sequentialYellow8`

### Valid `fallback` values

`Container`, `ActionSet`, `ColumnSet`, `Media`, `RichTextBlock`, `Table`, `TextBlock`, `FactSet`, `ImageSet`, `Image`, `Input.Text`, `Input.Date`, `Input.Time`, `Input.Number`, `Input.Toggle`, `Input.ChoiceSet`, `Input.Rating`, `Rating`, `CompoundButton`, `Icon`, `Carousel`, `TabSet`, `Accordion`, `Badge`, `ProgressRing`, `ProgressBar`, `LoopComponent`, `Chart.Donut`, `Chart.Pie`, `Chart.VerticalBar.Grouped`, `Chart.VerticalBar`, `Chart.HorizontalBar`, `Chart.HorizontalBar.Stacked`, `Chart.Line`, `Chart.Gauge`, `CodeBlock`, `Persona`, `PersonaSet`, `Graph resource`, `File`, `Calendar event`, `"drop"`.

### Valid `targetWidth` values

`VeryNarrow`, `Narrow`, `Standard`, `Wide`, `atLeast:VeryNarrow`, `atMost:VeryNarrow`, `atLeast:Narrow`, `atMost:Narrow`, `atLeast:Standard`, `atMost:Standard`, `atLeast:Wide`, `atMost:Wide`.
