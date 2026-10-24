# Chart.VerticalBar

**Works in:** Teams, Copilot

A vertical bar chart.

## Example preview

The source provides a rendered chart preview rather than a JSON payload. Its visible labels are preserved below.

- **Y-axis title:** Sales
- **Y-axis ticks:** 0, 73, 146, 219, 292
- **X-axis categories:** Pear, Banana, Apple, Peach, Kiwi, Grapefruit, Orange
- **X-axis title:** Days

## Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `type` | string | — | Must be `Chart.VerticalBar`. | 1.0 |
| `color` | string | — | Color to use for all data points. See [Chart colors](#chart-colors). | 1.5 |
| `colorSet` | string | — | Name of the color set used to render the chart. See [Color sets](#color-sets). | 1.5 |
| `data` | array of objects | — | Data to display in the chart. Valid type: `VerticalBarChartDataValue`. | 1.5 |
| `fallback` | object or string | — | Alternate element if this element or its required capabilities are unsupported. See [Fallback values](#fallback-values). | 1.2 |
| `grid.area` | string | — | **Teams:** Area of a `Layout.AreaGrid` in which the element should appear. | 1.5 |
| `height` | string | `"auto"` | Element height. `"stretch"` fills remaining vertical space. Values: `"auto"`, `"stretch"`. | 1.1 |
| `horizontalAlignment` | string | — | Horizontal alignment: `"Left"`, `"Center"`, `"Right"`. | 1.0 |
| `id` | string | — | Unique identifier of the element or action. Input elements require an ID for validation and Bot submission. | 1.0 |
| `isSortKey` | boolean | `false` | Whether this element serves as a sorting key for sortable collections. | 1.5 |
| `isVisible` | boolean | `true` | Controls element visibility. | 1.2 |
| `isVisible.dynamic` | string | — | **Preview:** Expression evaluated at runtime to update `isVisible`. | 1.5 |
| `key` | string | — | Optional object key, useful in some cases for preserving host visual state. | 1.0 |
| `lang` | string | — | Locale associated with the element. | 1.1 |
| `maxWidth` | string | — | **Teams:** Maximum chart width in pixels; format `"<number>px"`. | 1.5 |
| `requires` | object | `{}` | Required host capabilities. If unsupported, the element or its fallback is not rendered as appropriate. Valid type: `HostCapabilities`. | 1.2 |
| `separator` | boolean | `false` | Displays a separator above this element, except when it is the first item in its container. | 1.0 |
| `showBarValues` | boolean | `false` | Whether bar values are displayed. | 1.5 |
| `showLegend` | boolean | `true` | **Teams:** Whether the legend is displayed. | 1.5 |
| `showTitle` | boolean | `false` | **Teams:** Whether the chart title is displayed. | 1.5 |
| `spacing` | string | `"Default"` | Spacing before this element, except when it is first in a container. See [Spacing values](#spacing-values). | 1.0 |
| `targetWidth` | string | — | **Teams, Copilot:** Card widths at which the element is rendered. If omitted, it appears at all widths. See [Target width values](#target-width-values). | 1.0 |
| `title` | string | — | Chart title. | 1.5 |
| `xAxisTitle` | string | — | X-axis title. | 1.5 |
| `yAxisTitle` | string | — | Y-axis title. | 1.5 |
| `yMax` | number | — | Requested maximum of the Y-axis range; the runtime value may differ for visual presentation. | 1.5 |
| `yMin` | number | — | Requested minimum of the Y-axis range; the runtime value may differ for visual presentation. | 1.5 |

## VerticalBarChartDataValue

**Works in:** Teams, Copilot, Outlook

Represents a data point in a vertical bar chart.

### Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `color` | string | — | Color of the bar associated with the data point. See [Chart colors](#chart-colors). | 1.5 |
| `x` | string or number | — | X-axis value of the data point. | 1.5 |
| `y` | number | `0` | Y-axis value of the data point. | 1.5 |
| `key` | string | — | Optional object key, useful in some cases for preserving host visual state. | 1.0 |

## Valid values reference

### Chart colors

The `color` properties of both `Chart.VerticalBar` and `VerticalBarChartDataValue` accept:

- **Semantic:** `"good"`, `"warning"`, `"attention"`, `"neutral"`
- **Categorical:** `"categoricalRed"`, `"categoricalPurple"`, `"categoricalLavender"`, `"categoricalBlue"`, `"categoricalLightBlue"`, `"categoricalTeal"`, `"categoricalGreen"`, `"categoricalLime"`, `"categoricalMarigold"`
- **Sequential:** `"sequential1"`, `"sequential2"`, `"sequential3"`, `"sequential4"`, `"sequential5"`, `"sequential6"`, `"sequential7"`, `"sequential8"`
- **Diverging:** `"divergingBlue"`, `"divergingLightBlue"`, `"divergingCyan"`, `"divergingTeal"`, `"divergingYellow"`, `"divergingPeach"`, `"divergingLightRed"`, `"divergingRed"`, `"divergingMaroon"`, `"divergingGray"`
- **Sequential red:** `"sequentialRed1"`, `"sequentialRed2"`, `"sequentialRed3"`, `"sequentialRed4"`, `"sequentialRed5"`, `"sequentialRed6"`, `"sequentialRed7"`, `"sequentialRed8"`
- **Sequential green:** `"sequentialGreen1"`, `"sequentialGreen2"`, `"sequentialGreen3"`, `"sequentialGreen4"`, `"sequentialGreen5"`, `"sequentialGreen6"`, `"sequentialGreen7"`, `"sequentialGreen8"`
- **Sequential yellow:** `"sequentialYellow1"`, `"sequentialYellow2"`, `"sequentialYellow3"`, `"sequentialYellow4"`, `"sequentialYellow5"`, `"sequentialYellow6"`, `"sequentialYellow7"`, `"sequentialYellow8"`

### Color sets

`"categorical"`, `"sequential"`, `"sequentialred"`, `"sequentialgreen"`, `"sequentialyellow"`, `"diverging"`

### Fallback values

An object of one of the following types, or the string `"drop"`:

`Container`, `ActionSet`, `ColumnSet`, `Media`, `RichTextBlock`, `Table`, `TextBlock`, `FactSet`, `ImageSet`, `Image`, `Input.Text`, `Input.Date`, `Input.Time`, `Input.Number`, `Input.Toggle`, `Input.ChoiceSet`, `Input.Rating`, `Rating`, `CompoundButton`, `Icon`, `Carousel`, `TabSet`, `Accordion`, `Badge`, `ProgressRing`, `ProgressBar`, `LoopComponent`, `Chart.Donut`, `Chart.Pie`, `Chart.VerticalBar.Grouped`, `Chart.VerticalBar`, `Chart.HorizontalBar`, `Chart.HorizontalBar.Stacked`, `Chart.Line`, `Chart.Gauge`, `CodeBlock`, `Persona`, `PersonaSet`, `Graph resource`, `File`, `Calendar event`.

### Spacing values

`"None"`, `"ExtraSmall"`, `"Small"`, `"Default"`, `"Medium"`, `"Large"`, `"ExtraLarge"`, `"Padding"`

### Target width values

`"VeryNarrow"`, `"Narrow"`, `"Standard"`, `"Wide"`, `"atLeast:VeryNarrow"`, `"atMost:VeryNarrow"`, `"atLeast:Narrow"`, `"atMost:Narrow"`, `"atLeast:Standard"`, `"atMost:Standard"`, `"atLeast:Wide"`, `"atMost:Wide"`
