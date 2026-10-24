# Chart.VerticalBar.Grouped

**Works in:** Teams · Copilot

A grouped vertical bar chart. Set `stacked: true` to render stacked bars instead of grouped bars.

## Example

```json
{
  "type": "AdaptiveCard",
  "version": "1.5",
  "body": [
    {
      "type": "TextBlock",
      "text": "Grouped",
      "size": "large",
      "separator": true,
      "spacing": "large"
    },
    {
      "type": "Chart.VerticalBar.Grouped",
      "title": "Sample",
      "xAxisTitle": "Days",
      "yAxisTitle": "Sales",
      "colorSet": "diverging",
      "data": [
        {
          "legend": "Outlook",
          "values": [
            {
              "x": "2023-05-01",
              "y": 24
            },
            {
              "x": "2023-05-02",
              "y": 27
            },
            {
              "x": "2023-05-03",
              "y": 18
            },
            {
              "x": "2023-05-04",
              "y": 30
            },
            {
              "x": "2023-05-05",
              "y": 20
            }
          ]
        },
        {
          "legend": "Teams",
          "values": [
            {
              "x": "2023-05-01",
              "y": 9
            },
            {
              "x": "2023-05-02",
              "y": 100
            },
            {
              "x": "2023-05-03",
              "y": 22
            },
            {
              "x": "2023-05-04",
              "y": 40
            },
            {
              "x": "2023-05-05",
              "y": 30
            }
          ]
        },
        {
          "legend": "Office",
          "values": [
            {
              "x": "2023-05-01",
              "y": 10
            },
            {
              "x": "2023-05-02",
              "y": 20
            },
            {
              "x": "2023-05-03",
              "y": 30
            },
            {
              "x": "2023-05-04",
              "y": 40
            },
            {
              "x": "2023-05-05",
              "y": 50
            }
          ]
        },
        {
          "legend": "Windows",
          "values": [
            {
              "x": "2023-05-01",
              "y": 10
            },
            {
              "x": "2023-05-02",
              "y": 20
            },
            {
              "x": "2023-05-03",
              "y": 30
            },
            {
              "x": "2023-05-04",
              "y": 40
            },
            {
              "x": "2023-05-05",
              "y": 50
            }
          ]
        }
      ]
    },
    {
      "type": "TextBlock",
      "text": "Stacked",
      "size": "large",
      "separator": true,
      "spacing": "large"
    },
    {
      "type": "Chart.VerticalBar.Grouped",
      "stacked": true,
      "title": "Sample",
      "xAxisTitle": "Days",
      "yAxisTitle": "Sales",
      "data": [
        {
          "legend": "Outlook",
          "values": [
            {
              "x": "2023-05-01",
              "y": 24
            },
            {
              "x": "2023-05-02",
              "y": 27
            },
            {
              "x": "2023-05-03",
              "y": 18
            },
            {
              "x": "2023-05-04",
              "y": 30
            },
            {
              "x": "2023-05-05",
              "y": 20
            }
          ]
        },
        {
          "legend": "Teams",
          "values": [
            {
              "x": "2023-05-01",
              "y": 9
            },
            {
              "x": "2023-05-02",
              "y": 100
            },
            {
              "x": "2023-05-03",
              "y": 22
            },
            {
              "x": "2023-05-04",
              "y": 40
            },
            {
              "x": "2023-05-05",
              "y": 30
            }
          ]
        },
        {
          "legend": "Office",
          "values": [
            {
              "x": "2023-05-01",
              "y": 10
            },
            {
              "x": "2023-05-02",
              "y": 20
            },
            {
              "x": "2023-05-03",
              "y": 30
            },
            {
              "x": "2023-05-04",
              "y": 40
            },
            {
              "x": "2023-05-05",
              "y": 50
            }
          ]
        },
        {
          "legend": "Windows",
          "values": [
            {
              "x": "2023-05-01",
              "y": 10
            },
            {
              "x": "2023-05-02",
              "y": 20
            },
            {
              "x": "2023-05-03",
              "y": 30
            },
            {
              "x": "2023-05-04",
              "y": 40
            },
            {
              "x": "2023-05-05",
              "y": 50
            }
          ]
        }
      ]
    }
  ]
}
```

## Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `type` | `string` | — | Must be `Chart.VerticalBar.Grouped`. | 1.0 |
| `color` | `string` | — | The color to use for all data points. See Chart colors reference. Valid values: `good`, `warning`, `attention`, `neutral`, `categoricalRed`, `categoricalPurple`, `categoricalLavender`, `categoricalBlue`, `categoricalLightBlue`, `categoricalTeal`, `categoricalGreen`, `categoricalLime`, `categoricalMarigold`, `sequential1`, `sequential2`, `sequential3`, `sequential4`, `sequential5`, `sequential6`, `sequential7`, `sequential8`, `divergingBlue`, `divergingLightBlue`, `divergingCyan`, `divergingTeal`, `divergingYellow`, `divergingPeach`, `divergingLightRed`, `divergingRed`, `divergingMaroon`, `divergingGray`, `sequentialRed1`, `sequentialRed2`, `sequentialRed3`, `sequentialRed4`, `sequentialRed5`, `sequentialRed6`, `sequentialRed7`, `sequentialRed8`, `sequentialGreen1`, `sequentialGreen2`, `sequentialGreen3`, `sequentialGreen4`, `sequentialGreen5`, `sequentialGreen6`, `sequentialGreen7`, `sequentialGreen8`, `sequentialYellow1`, `sequentialYellow2`, `sequentialYellow3`, `sequentialYellow4`, `sequentialYellow5`, `sequentialYellow6`, `sequentialYellow7`, `sequentialYellow8`. | 1.5 |
| `colorSet` | `string` | — | The name of the set of colors to use to render the chart. See Chart colors reference. Valid values: `categorical`, `sequential`, `sequentialred`, `sequentialgreen`, `sequentialyellow`, `diverging`. | 1.5 |
| `data` | `Array of object` | — | The data points in a series. Valid values: `GroupedVerticalBarChartData`. | 1.5 |
| `fallback` | `object` or `string` | — | An alternate element to render if this type is unsupported or the host lacks required capabilities. Valid values: `Container`, `ActionSet`, `ColumnSet`, `Media`, `RichTextBlock`, `Table`, `TextBlock`, `FactSet`, `ImageSet`, `Image`, `Input.Text`, `Input.Date`, `Input.Time`, `Input.Number`, `Input.Toggle`, `Input.ChoiceSet`, `Input.Rating`, `Rating`, `CompoundButton`, `Icon`, `Carousel`, `TabSet`, `Accordion`, `Badge`, `ProgressRing`, `ProgressBar`, `LoopComponent`, `Chart.Donut`, `Chart.Pie`, `Chart.VerticalBar.Grouped`, `Chart.VerticalBar`, `Chart.HorizontalBar`, `Chart.HorizontalBar.Stacked`, `Chart.Line`, `Chart.Gauge`, `CodeBlock`, `Persona`, `PersonaSet`, `Graph resource`, `File`, `Calendar event`, `"drop"`. | 1.2 |
| `grid.area` | `string` | — | **Teams.** The area of a `Layout.AreaGrid` layout in which an element should be displayed. | 1.5 |
| `height` | `string` | `"auto"` | The height of the element. `stretch` uses remaining vertical space. Valid values: `auto`, `stretch`. | 1.1 |
| `horizontalAlignment` | `string` | — | Controls horizontal alignment. Valid values: `Left`, `Center`, `Right`. | 1.0 |
| `id` | `string` | — | A unique identifier for the element or action. Input elements must have an id to be validated and submitted. | 1.0 |
| `isSortKey` | `boolean` | `false` | Controls whether the element is a sort key for sortable collections. | 1.5 |
| `isVisible` | `boolean` | `true` | Controls visibility. | 1.2 |
| `isVisible.dynamic` | `string` | — | **Preview.** Expression evaluated at runtime to update `isVisible`. | 1.5 |
| `key` | `string` | — | Defines an optional key for the object. Keys are seldom needed, but in some scenarios, specifying keys can help maintain visual state in the host application. | 1.0 |
| `lang` | `string` | — | The locale associated with the element. | 1.1 |
| `maxWidth` | `string` | — | **Teams.** Maximum chart width in pixels. Valid values: `<number>px`. | 1.5 |
| `requires` | `object` | `{}` | A list of capabilities the element requires the host application to support. If the host application doesn't support at least one of the listed capabilities, the element is not rendered (or its fallback is rendered if provided). Valid values: `HostCapabilities`. | 1.2 |
| `separator` | `boolean` | `false` | Whether to show a separator above the element (never for the first element in a container). | 1.0 |
| `showBarValues` | `boolean` | `false` | Controls if values should be displayed on each bar. | 1.5 |
| `showLegend` | `boolean` | `true` | **Teams.** Controls whether the chart legend is displayed. | 1.5 |
| `showTitle` | `boolean` | `false` | **Teams.** Controls whether the chart title is displayed. | 1.5 |
| `spacing` | `string` | `"Default"` | Spacing from the preceding element (not applied to the first element). Valid values: `None`, `ExtraSmall`, `Small`, `Default`, `Medium`, `Large`, `ExtraLarge`, `Padding`. | 1.0 |
| `stacked` | `boolean` | `false` | Controls whether bars are stacks rather than groups. Stacked vertical bar charts do not support custom Y ranges or negative Y values. | 1.5 |
| `targetWidth` | `string` | — | **Teams, Copilot.** Controls at which card widths this element appears; when omitted it renders at all widths. Valid values: `VeryNarrow`, `Narrow`, `Standard`, `Wide`, `atLeast:VeryNarrow`, `atMost:VeryNarrow`, `atLeast:Narrow`, `atMost:Narrow`, `atLeast:Standard`, `atMost:Standard`, `atLeast:Wide`, `atMost:Wide`. | 1.0 |
| `title` | `string` | — | Chart title. | 1.5 |
| `xAxisTitle` | `string` | — | X-axis title. | 1.5 |
| `yAxisTitle` | `string` | — | Y-axis title. | 1.5 |
| `yMax` | `number` | — | Requested maximum of Y-axis range; runtime may adjust for display. Ignored if `stacked` is `true`. | 1.5 |
| `yMin` | `number` | — | Requested minimum of Y-axis range; runtime may adjust for display. Ignored if `stacked` is `true`. | 1.5 |

> **Note:** Stacked vertical bar charts do not support custom Y-axis ranges or negative Y values. The `yMin` and `yMax` properties are ignored when `stacked` is `true`.

## GroupedVerticalBarChartData

**Works in:** Teams · Copilot · Outlook

Represents a series of data points.

### Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `color` | `string` | — | The color to use for all data points in the series. See Chart colors reference. Valid values: `good`, `warning`, `attention`, `neutral`, `categoricalRed`, `categoricalPurple`, `categoricalLavender`, `categoricalBlue`, `categoricalLightBlue`, `categoricalTeal`, `categoricalGreen`, `categoricalLime`, `categoricalMarigold`, `sequential1`, `sequential2`, `sequential3`, `sequential4`, `sequential5`, `sequential6`, `sequential7`, `sequential8`, `divergingBlue`, `divergingLightBlue`, `divergingCyan`, `divergingTeal`, `divergingYellow`, `divergingPeach`, `divergingLightRed`, `divergingRed`, `divergingMaroon`, `divergingGray`, `sequentialRed1`, `sequentialRed2`, `sequentialRed3`, `sequentialRed4`, `sequentialRed5`, `sequentialRed6`, `sequentialRed7`, `sequentialRed8`, `sequentialGreen1`, `sequentialGreen2`, `sequentialGreen3`, `sequentialGreen4`, `sequentialGreen5`, `sequentialGreen6`, `sequentialGreen7`, `sequentialGreen8`, `sequentialYellow1`, `sequentialYellow2`, `sequentialYellow3`, `sequentialYellow4`, `sequentialYellow5`, `sequentialYellow6`, `sequentialYellow7`, `sequentialYellow8`. | 1.5 |
| `values` | `Array of object` | — | The data points in the series. Valid values: `BarChartDataValue`. | 1.5 |
| `key` | `string` | — | Defines an optional key for the object. Keys are seldom needed, but in some scenarios, specifying keys can help maintain visual state in the host application. | 1.0 |
| `legend` | `string` | — | The legend of the chart. | 1.5 |

## BarChartDataValue

The `values` array contains `BarChartDataValue` objects. Its reference is named in the provided schema, but a separate definition was not included in this source. The example uses `x` and `y` fields.
