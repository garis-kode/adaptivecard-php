# Chart.Line

**Works in:** Teams · Copilot

A line chart.

## Chart behavior

### Time series line chart

If all x values are numbers, or all are date strings in `YYYY-MM-DD` format, the chart uses a continuous time-series x axis. Data points can fall between axis labels. The x-axis range and label formatting are automatically optimized for legibility.

### Categorical line chart

If x values mix numbers and strings, or any string x value is not a `YYYY-MM-DD` date, the chart renders categories. Points snap to their corresponding x-axis categories.

### Y range determination

If neither `yMin` nor `yMax` is supplied:

- **Only positive values:** minimum is 0; maximum is a rounded value above the highest y value.
- **Only negative values:** maximum is 0; minimum is a rounded value below the lowest y value.
- **Positive and negative values:** a line at y = 0 is always displayed, with evenly spaced horizontal lines above and below it.

If both `yMin` and `yMax` are supplied, the chart uses the explicit range even if some points fall outside it; out-of-range points are not visible.

## Examples

### Time series with dates

```json
{
  "type": "AdaptiveCard",
  "version": "1.5",
  "body": [
    {
      "type": "Chart.Line",
      "title": "Sample",
      "xAxisTitle": "Date",
      "yAxisTitle": "Sales",
      "colorSet": "categorical",
      "data": [
        {
          "legend": "Outlook",
          "values": [
            {
              "x": "2023-05-01",
              "y": 99
            },
            {
              "x": "2023-05-02",
              "y": 6
            },
            {
              "x": "2023-05-03",
              "y": 63
            },
            {
              "x": "2023-05-04",
              "y": 64
            },
            {
              "x": "2023-05-05",
              "y": 63
            },
            {
              "x": "2023-05-06",
              "y": 78
            }
          ]
        },
        {
          "legend": "Teams",
          "values": [
            {
              "x": "2023-05-01",
              "y": 12
            },
            {
              "x": "2023-05-02",
              "y": 82
            },
            {
              "x": "2023-05-03",
              "y": 12
            },
            {
              "x": "2023-05-04",
              "y": 33
            },
            {
              "x": "2023-05-05",
              "y": 1
            },
            {
              "x": "2023-05-06",
              "y": 80
            }
          ]
        },
        {
          "legend": "Copilot",
          "values": [
            {
              "x": "2023-05-01",
              "y": 96
            },
            {
              "x": "2023-05-02",
              "y": 37
            },
            {
              "x": "2023-05-03",
              "y": 27
            },
            {
              "x": "2023-05-04",
              "y": 5
            },
            {
              "x": "2023-05-05",
              "y": 45
            },
            {
              "x": "2023-05-06",
              "y": 59
            }
          ]
        }
      ]
    }
  ]
}
```

### Additional examples in the source

- **Time series using numeric x values:** chart titled Sales; x axis Days; Outlook, Teams, Copilot series.
- **Categorical x values:** Day 1–Day 5 categories; x axis Days; same series.
- **Explicit y range:** example with visible y-axis labels from 20 to 130.

> **Note:** The source provided rendered chart text but not JSON payloads for these three additional examples, so no JSON was invented.

## Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `type` | `string` | — | Must be `Chart.Line`. | 1.0 |
| `color` | `string` | — | The color to use for all data points. See Chart colors reference. Valid values: `good`, `warning`, `attention`, `neutral`, `categoricalRed`, `categoricalPurple`, `categoricalLavender`, `categoricalBlue`, `categoricalLightBlue`, `categoricalTeal`, `categoricalGreen`, `categoricalLime`, `categoricalMarigold`, `sequential1`, `sequential2`, `sequential3`, `sequential4`, `sequential5`, `sequential6`, `sequential7`, `sequential8`, `divergingBlue`, `divergingLightBlue`, `divergingCyan`, `divergingTeal`, `divergingYellow`, `divergingPeach`, `divergingLightRed`, `divergingRed`, `divergingMaroon`, `divergingGray`, `sequentialRed1`, `sequentialRed2`, `sequentialRed3`, `sequentialRed4`, `sequentialRed5`, `sequentialRed6`, `sequentialRed7`, `sequentialRed8`, `sequentialGreen1`, `sequentialGreen2`, `sequentialGreen3`, `sequentialGreen4`, `sequentialGreen5`, `sequentialGreen6`, `sequentialGreen7`, `sequentialGreen8`, `sequentialYellow1`, `sequentialYellow2`, `sequentialYellow3`, `sequentialYellow4`, `sequentialYellow5`, `sequentialYellow6`, `sequentialYellow7`, `sequentialYellow8`. | 1.5 |
| `colorSet` | `string` | — | The name of the set of colors to use to render the chart. See Chart colors reference. Valid values: `categorical`, `sequential`, `sequentialred`, `sequentialgreen`, `sequentialyellow`, `diverging`. | 1.5 |
| `data` | `Array of object` | — | The data point series in the line chart. Valid values: `LineChartData`. | 1.5 |
| `fallback` | `object` or `string` | — | An alternate element to render if this type or required host capabilities are unsupported. Valid values: `Container`, `ActionSet`, `ColumnSet`, `Media`, `RichTextBlock`, `Table`, `TextBlock`, `FactSet`, `ImageSet`, `Image`, `Input.Text`, `Input.Date`, `Input.Time`, `Input.Number`, `Input.Toggle`, `Input.ChoiceSet`, `Input.Rating`, `Rating`, `CompoundButton`, `Icon`, `Carousel`, `TabSet`, `Accordion`, `Badge`, `ProgressRing`, `ProgressBar`, `LoopComponent`, `Chart.Donut`, `Chart.Pie`, `Chart.VerticalBar.Grouped`, `Chart.VerticalBar`, `Chart.HorizontalBar`, `Chart.HorizontalBar.Stacked`, `Chart.Line`, `Chart.Gauge`, `CodeBlock`, `Persona`, `PersonaSet`, `Graph resource`, `File`, `Calendar event`, `"drop"`. | 1.2 |
| `grid.area` | `string` | — | **Teams.** The area of a `Layout.AreaGrid` layout in which an element should be displayed. | 1.5 |
| `height` | `string` | `"auto"` | The height of the element. When set to stretch, the element uses the remaining vertical space in its container. Valid values: `auto`, `stretch`. | 1.1 |
| `horizontalAlignment` | `string` | — | Controls how the element should be horizontally aligned. Valid values: `Left`, `Center`, `Right`. | 1.0 |
| `id` | `string` | — | A unique identifier for the element or action. Input elements must have an id, otherwise they will not be validated and their values will not be sent to the Bot. | 1.0 |
| `isSortKey` | `boolean` | `false` | Controls whether the element should be used as a sort key by elements that allow sorting across a collection of elements. | 1.5 |
| `isVisible` | `boolean` | `true` | Controls the visibility of the element. | 1.2 |
| `isVisible.dynamic` | `string` | — | **Preview.** Defines an expression whose evaluated value will be used to update `isVisible` at runtime. | 1.5 |
| `key` | `string` | — | Defines an optional key for the object. Keys are seldom needed, but in some scenarios, specifying keys can help maintain visual state in the host application. | 1.0 |
| `lang` | `string` | — | The locale associated with the element. | 1.1 |
| `maxWidth` | `string` | — | **Teams.** The maximum width of the chart in pixels, in the `<number>px` format. Valid values: `<number>px`. | 1.5 |
| `requires` | `object` | `{}` | A list of capabilities required from the host. If one is unsupported, the element is not rendered or its fallback is used. Valid values: `HostCapabilities`. | 1.2 |
| `separator` | `boolean` | `false` | Whether a separator line is displayed above the element; not shown for the first element in a container. | 1.0 |
| `showLegend` | `boolean` | `true` | **Teams.** Controls whether the chart legend should be displayed. | 1.5 |
| `showTitle` | `boolean` | `false` | **Teams.** Controls whether the chart title should be displayed. | 1.5 |
| `spacing` | `string` | `"Default"` | Space between this element and the previous one; none before the first element. Valid values: `None`, `ExtraSmall`, `Small`, `Default`, `Medium`, `Large`, `ExtraLarge`, `Padding`. | 1.0 |
| `targetWidth` | `string` | — | **Teams, Copilot.** Controls at which card widths the element is displayed; without it the element appears at all widths. See Responsive layout. Valid values: `VeryNarrow`, `Narrow`, `Standard`, `Wide`, `atLeast:VeryNarrow`, `atMost:VeryNarrow`, `atLeast:Narrow`, `atMost:Narrow`, `atLeast:Standard`, `atMost:Standard`, `atLeast:Wide`, `atMost:Wide`. | 1.0 |
| `title` | `string` | — | The title of the chart. | 1.5 |
| `xAxisLabelMinWidth` | `string` | — | **Preview.** Minimum width reserved for x-axis labels. `auto` adjusts based on content; a pixel value sets an explicit minimum. When space is insufficient the chart renders fewer labels instead of truncating. Valid values: `auto`, `<number>px`. | 1.5 |
| `xAxisTitle` | `string` | — | The title of the x axis. | 1.5 |
| `yAxisTitle` | `string` | — | The title of the y axis. | 1.5 |
| `yMax` | `number` | — | The minimum y range (wording from supplied schema; see y-range discussion above). | 1.5 |
| `yMin` | `number` | — | The maximum y range (wording from supplied schema; see y-range discussion above). | 1.5 |

## LineChartData

**Works in:** Teams · Copilot · Outlook

Represents a collection of data-point series in a line chart.

### Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `color` | `string` | — | The color of all data points in the series. See Chart colors reference. Valid values: `good`, `warning`, `attention`, `neutral`, `categoricalRed`, `categoricalPurple`, `categoricalLavender`, `categoricalBlue`, `categoricalLightBlue`, `categoricalTeal`, `categoricalGreen`, `categoricalLime`, `categoricalMarigold`, `sequential1`, `sequential2`, `sequential3`, `sequential4`, `sequential5`, `sequential6`, `sequential7`, `sequential8`, `divergingBlue`, `divergingLightBlue`, `divergingCyan`, `divergingTeal`, `divergingYellow`, `divergingPeach`, `divergingLightRed`, `divergingRed`, `divergingMaroon`, `divergingGray`, `sequentialRed1`, `sequentialRed2`, `sequentialRed3`, `sequentialRed4`, `sequentialRed5`, `sequentialRed6`, `sequentialRed7`, `sequentialRed8`, `sequentialGreen1`, `sequentialGreen2`, `sequentialGreen3`, `sequentialGreen4`, `sequentialGreen5`, `sequentialGreen6`, `sequentialGreen7`, `sequentialGreen8`, `sequentialYellow1`, `sequentialYellow2`, `sequentialYellow3`, `sequentialYellow4`, `sequentialYellow5`, `sequentialYellow6`, `sequentialYellow7`, `sequentialYellow8`. | 1.5 |
| `values` | `Array of object` | — | The data points in the series. Valid values: `LineChartValue`. | 1.5 |
| `key` | `string` | — | Defines an optional key for the object. Keys are seldom needed, but in some scenarios, specifying keys can help maintain visual state in the host application. | 1.0 |
| `legend` | `string` | — | The legend of the chart. | 1.5 |

## LineChartValue

**Works in:** Teams · Copilot · Outlook

Represents a single data point in a line chart.

### Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `x` | `number` or `string` | — | The x-axis value. All numbers or all `YYYY-MM-DD` date strings produce a time-series chart. Mixed values or any other string produce a categorical chart. | 1.5 |
| `y` | `number` | `0` | The y-axis value of the data point. | 1.5 |
| `key` | `string` | — | Defines an optional key for the object. Keys are seldom needed, but in some scenarios, specifying keys can help maintain visual state in the host application. | 1.0 |
