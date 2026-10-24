# Chart.HorizontalBar.Stacked

**Works in:** Teams, Copilot

A stacked horizontal bar chart.

## Example

```json
{
  "type": "AdaptiveCard",
  "version": "1.5",
  "body": [
    {
      "type": "Chart.HorizontalBar.Stacked",
      "title": "Sample",
      "data": [
        {
          "title": "Outlook",
          "data": [
            { "legend": "2023-05-01", "value": 24, "color": "good" },
            { "legend": "2023-05-02", "value": 27, "color": "warning" },
            { "legend": "2023-05-03", "value": 18, "color": "attention" }
          ]
        },
        {
          "title": "Teams",
          "data": [
            { "legend": "2023-05-01", "value": 9, "color": "good" },
            { "legend": "2023-05-02", "value": 100, "color": "warning" },
            { "legend": "2023-05-03", "value": 22, "color": "attention" }
          ]
        }
      ]
    }
  ]
}
```

## Chart.HorizontalBar.Stacked schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `type` | string | — | Must be `Chart.HorizontalBar.Stacked`. | 1.0 |
| `color` | string | — | Color to use for all data points. See [Chart colors](#chart-color-values). | 1.5 |
| `colorSet` | string | — | Color set to render the chart. Values: `categorical`, `sequential`, `sequentialred`, `sequentialgreen`, `sequentialyellow`, `diverging`. | 1.5 |
| `data` | array of objects | — | Data to display. Each item is a `StackedHorizontalBarChartData`. | 1.5 |
| `fallback` | object or string | — | Alternate element if unsupported or required host capabilities are unavailable. See [Fallback values](#fallback-values). | 1.2 |
| `grid.area` | string | — | **Teams:** Area in a `Layout.AreaGrid` layout where the element should appear. | 1.5 |
| `height` | string | `"auto"` | Height; `stretch` fills remaining vertical space. Values: `auto`, `stretch`. | 1.1 |
| `horizontalAlignment` | string | — | Horizontal alignment: `Left`, `Center`, `Right`. | 1.0 |
| `id` | string | — | Unique identifier. Inputs without an `id` are not validated or sent to the Bot. | 1.0 |
| `isSortKey` | boolean | `false` | Whether to use the element as a sort key in sortable collections. | 1.5 |
| `isVisible` | boolean | `true` | Controls element visibility. | 1.2 |
| `isVisible.dynamic` | string | — | **Preview:** Expression evaluated at runtime to update `isVisible`. | 1.5 |
| `key` | string | — | Optional key; can help preserve visual state in some host applications. | 1.0 |
| `lang` | string | — | Locale associated with the element. | 1.1 |
| `maxWidth` | string | — | **Teams:** Maximum chart width in `<number>px` format. | 1.5 |
| `requires` | object | `{}` | Required host capabilities (`HostCapabilities`); otherwise use `fallback` or omit the element. | 1.2 |
| `separator` | boolean | `false` | Whether to show a separator above the element; not shown for the first element. | 1.0 |
| `showLegend` | boolean | `true` | **Teams:** Whether to display the chart legend. | 1.5 |
| `showTitle` | boolean | `false` | **Teams:** Whether to display the chart title. | 1.5 |
| `spacing` | string | `"Default"` | Space before the element; none for the first element. See [Spacing values](#spacing-values). | 1.0 |
| `targetWidth` | string | — | **Teams, Copilot:** Responsive width condition. Omitted means show at all widths. See [Target width values](#target-width-values). | 1.0 |
| `title` | string | — | Chart title. | 1.5 |
| `xAxisTitle` | string | — | X-axis title. | 1.5 |
| `yAxisTitle` | string | — | Y-axis title. | 1.5 |

## StackedHorizontalBarChartData

**Works in:** Teams, Copilot, Outlook

Defines the collection of data series to display in a stacked horizontal bar chart.

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `data` | array of objects | — | Data points in the series (`StackedHorizontalBarChartDataPoint`). | 1.5 |
| `title` | string | — | Title of the series. | 1.5 |
| `key` | string | — | Optional key; can help preserve visual state in host applications. | 1.0 |

## StackedHorizontalBarChartDataPoint

**Works in:** Teams, Copilot, Outlook

A data point in a series.

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `color` | string | — | Color of the associated bar. See [Chart color values](#chart-color-values). | 1.5 |
| `legend` | string | — | Legend associated with the data point. | 1.5 |
| `value` | number | `0` | Value of the data point. | 1.5 |
| `key` | string | — | Optional key; can help preserve visual state in host applications. | 1.0 |

## Valid values reference

### Chart color values

Allowed for `Chart.HorizontalBar.Stacked.color` and `StackedHorizontalBarChartDataPoint.color`:

- Semantic: `good`, `warning`, `attention`, `neutral`
- Categorical: `categoricalRed`, `categoricalPurple`, `categoricalLavender`, `categoricalBlue`, `categoricalLightBlue`, `categoricalTeal`, `categoricalGreen`, `categoricalLime`, `categoricalMarigold`
- Sequential: `sequential1`, `sequential2`, `sequential3`, `sequential4`, `sequential5`, `sequential6`, `sequential7`, `sequential8`
- Diverging: `divergingBlue`, `divergingLightBlue`, `divergingCyan`, `divergingTeal`, `divergingYellow`, `divergingPeach`, `divergingLightRed`, `divergingRed`, `divergingMaroon`, `divergingGray`
- Sequential red: `sequentialRed1`, `sequentialRed2`, `sequentialRed3`, `sequentialRed4`, `sequentialRed5`, `sequentialRed6`, `sequentialRed7`, `sequentialRed8`
- Sequential green: `sequentialGreen1`, `sequentialGreen2`, `sequentialGreen3`, `sequentialGreen4`, `sequentialGreen5`, `sequentialGreen6`, `sequentialGreen7`, `sequentialGreen8`
- Sequential yellow: `sequentialYellow1`, `sequentialYellow2`, `sequentialYellow3`, `sequentialYellow4`, `sequentialYellow5`, `sequentialYellow6`, `sequentialYellow7`, `sequentialYellow8`

### Fallback values

`Container`, `ActionSet`, `ColumnSet`, `Media`, `RichTextBlock`, `Table`, `TextBlock`, `FactSet`, `ImageSet`, `Image`, `Input.Text`, `Input.Date`, `Input.Time`, `Input.Number`, `Input.Toggle`, `Input.ChoiceSet`, `Input.Rating`, `Rating`, `CompoundButton`, `Icon`, `Carousel`, `TabSet`, `Accordion`, `Badge`, `ProgressRing`, `ProgressBar`, `LoopComponent`, `Chart.Donut`, `Chart.Pie`, `Chart.VerticalBar.Grouped`, `Chart.VerticalBar`, `Chart.HorizontalBar`, `Chart.HorizontalBar.Stacked`, `Chart.Line`, `Chart.Gauge`, `CodeBlock`, `Persona`, `PersonaSet`, `Graph resource`, `File`, `Calendar event`, `"drop"`.

### Spacing values

`None`, `ExtraSmall`, `Small`, `Default`, `Medium`, `Large`, `ExtraLarge`, `Padding`.

### Target width values

`VeryNarrow`, `Narrow`, `Standard`, `Wide`, `atLeast:VeryNarrow`, `atMost:VeryNarrow`, `atLeast:Narrow`, `atMost:Narrow`, `atLeast:Standard`, `atMost:Standard`, `atLeast:Wide`, `atMost:Wide`.
