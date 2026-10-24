# Chart.Donut

**Works in:** Teams · Copilot

A donut chart.

### JSON example

```json
{
  "type": "AdaptiveCard",
  "version": "1.5",
  "body": [
    {
      "type": "Chart.Donut",
      "title": "Fruit sales",
      "data": [
        {
          "legend": "Pear",
          "value": 59
        },
        {
          "legend": "Banana",
          "value": 292
        },
        {
          "legend": "Apple",
          "value": 143
        },
        {
          "legend": "Peach",
          "value": 98
        },
        {
          "legend": "Kiwi",
          "value": 179
        },
        {
          "legend": "Grapefruit",
          "value": 50
        },
        {
          "legend": "Orange",
          "value": 212
        },
        {
          "legend": "Cantaloupe",
          "value": 68
        }
      ]
    }
  ]
}
```

### Small donut chart

To render a smaller donut chart, use `showTitle`, `showLegend`, `showOutlines`, `maxWidth`, `value`, and `valueColor`. The supplied source displays the values **81** and **42** for this example but does not include a JSON payload, so none is inferred here.

### Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| type | string | — | Must be `Chart.Donut`. | 1.0 |
| colorSet | string | — | The name of the set of colors to use to render the chart. See Chart colors reference. **Valid values:** `categorical`, `sequential`, `sequentialred`, `sequentialgreen`, `sequentialyellow`, `diverging`. | 1.5 |
| data | Array of object | — | The data to display in the chart. **Valid values:** `DonutChartData`. | 1.5 |
| fallback | object or string | — | An alternate element if unsupported or capabilities in `requires` are unavailable. **Valid values:** `Container`, `ActionSet`, `ColumnSet`, `Media`, `RichTextBlock`, `Table`, `TextBlock`, `FactSet`, `ImageSet`, `Image`, `Input.Text`, `Input.Date`, `Input.Time`, `Input.Number`, `Input.Toggle`, `Input.ChoiceSet`, `Input.Rating`, `Rating`, `CompoundButton`, `Icon`, `Carousel`, `TabSet`, `Accordion`, `Badge`, `ProgressRing`, `ProgressBar`, `LoopComponent`, `Chart.Donut`, `Chart.Pie`, `Chart.VerticalBar.Grouped`, `Chart.VerticalBar`, `Chart.HorizontalBar`, `Chart.HorizontalBar.Stacked`, `Chart.Line`, `Chart.Gauge`, `CodeBlock`, `Persona`, `PersonaSet`, `Graph resource`, `File`, `Calendar event`, `"drop"`. | 1.2 |
| grid.area | string | — | **Teams:** The area of a `Layout.AreaGrid` layout in which an element should be displayed. | 1.5 |
| height | string | `"auto"` | The height of the element. With `stretch`, uses the remaining vertical space in its container. **Valid values:** `auto`, `stretch`. | 1.1 |
| horizontalAlignment | string | — | Controls horizontal alignment. **Valid values:** `Left`, `Center`, `Right`. | 1.0 |
| id | string | — | A unique identifier for the element or action. Inputs without an `id` will not be validated or submitted. | 1.0 |
| isSortKey | boolean | `false` | Controls whether the element is used as a sort key by collections that support sorting. | 1.5 |
| isVisible | boolean | `true` | Controls visibility of the element. | 1.2 |
| isVisible.dynamic | string | — | **Preview.** Expression evaluated at runtime to update `isVisible`. | 1.5 |
| key | string | — | Optional key for maintaining visual state in certain host scenarios. | 1.0 |
| lang | string | — | The locale associated with the element. | 1.1 |
| maxWidth | string | — | **Teams:** The maximum width, in pixels, of the chart. **Valid values:** `<number>px`. | 1.5 |
| requires | object | `{}` | Required host capabilities; otherwise renders the fallback if specified. **Valid values:** `HostCapabilities`. | 1.2 |
| separator | boolean | `false` | Whether to display a separator above this element, except when it is the first in a container. | 1.0 |
| showLegend | boolean | `true` | **Teams:** Controls whether the chart's legend is displayed. | 1.5 |
| showOutlines | boolean | `true` | **Teams:** Controls whether outlines around donut segments are displayed. | 1.5 |
| showTitle | boolean | `false` | **Teams:** Controls whether the chart's title is displayed. | 1.5 |
| spacing | string | `"Default"` | Space between this element and the previous one (not applied to the first element). **Valid values:** `None`, `ExtraSmall`, `Small`, `Default`, `Medium`, `Large`, `ExtraLarge`, `Padding`. | 1.0 |
| targetWidth | string | — | **Teams, Copilot:** Controls the card widths at which the element is displayed; omission displays at all widths. See Responsive layout. **Valid values:** `VeryNarrow`, `Narrow`, `Standard`, `Wide`, `atLeast:VeryNarrow`, `atMost:VeryNarrow`, `atLeast:Narrow`, `atMost:Narrow`, `atLeast:Standard`, `atMost:Standard`, `atLeast:Wide`, `atMost:Wide`. | 1.0 |
| thickness | string | `"Thick"` | **Teams:** Thickness of the donut segments; documentation states the default is Thick. **Valid values:** `Thin`, `Thick`. | 1.5 |
| title | string | — | Title of the chart. | 1.5 |
| value | string | — | **Teams:** Value displayed in the center of a donut chart; ignored for pie charts. | 1.5 |
| valueColor | string | — | **Teams:** Color of the value displayed in the donut center. **Valid values:** `good`, `warning`, `attention`, `neutral`, `categoricalRed`, `categoricalPurple`, `categoricalLavender`, `categoricalBlue`, `categoricalLightBlue`, `categoricalTeal`, `categoricalGreen`, `categoricalLime`, `categoricalMarigold`, `sequential1`, `sequential2`, `sequential3`, `sequential4`, `sequential5`, `sequential6`, `sequential7`, `sequential8`, `divergingBlue`, `divergingLightBlue`, `divergingCyan`, `divergingTeal`, `divergingYellow`, `divergingPeach`, `divergingLightRed`, `divergingRed`, `divergingMaroon`, `divergingGray`, `sequentialRed1`, `sequentialRed2`, `sequentialRed3`, `sequentialRed4`, `sequentialRed5`, `sequentialRed6`, `sequentialRed7`, `sequentialRed8`, `sequentialGreen1`, `sequentialGreen2`, `sequentialGreen3`, `sequentialGreen4`, `sequentialGreen5`, `sequentialGreen6`, `sequentialGreen7`, `sequentialGreen8`, `sequentialYellow1`, `sequentialYellow2`, `sequentialYellow3`, `sequentialYellow4`, `sequentialYellow5`, `sequentialYellow6`, `sequentialYellow7`, `sequentialYellow8`. | 1.5 |

## DonutChartData

**Works in:** Teams · Copilot · Outlook

A data point in a donut chart.

### Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| color | string | — | Color for the data point. See Chart colors reference. **Valid values:** `good`, `warning`, `attention`, `neutral`, `categoricalRed`, `categoricalPurple`, `categoricalLavender`, `categoricalBlue`, `categoricalLightBlue`, `categoricalTeal`, `categoricalGreen`, `categoricalLime`, `categoricalMarigold`, `sequential1`, `sequential2`, `sequential3`, `sequential4`, `sequential5`, `sequential6`, `sequential7`, `sequential8`, `divergingBlue`, `divergingLightBlue`, `divergingCyan`, `divergingTeal`, `divergingYellow`, `divergingPeach`, `divergingLightRed`, `divergingRed`, `divergingMaroon`, `divergingGray`, `sequentialRed1`, `sequentialRed2`, `sequentialRed3`, `sequentialRed4`, `sequentialRed5`, `sequentialRed6`, `sequentialRed7`, `sequentialRed8`, `sequentialGreen1`, `sequentialGreen2`, `sequentialGreen3`, `sequentialGreen4`, `sequentialGreen5`, `sequentialGreen6`, `sequentialGreen7`, `sequentialGreen8`, `sequentialYellow1`, `sequentialYellow2`, `sequentialYellow3`, `sequentialYellow4`, `sequentialYellow5`, `sequentialYellow6`, `sequentialYellow7`, `sequentialYellow8`. | 1.5 |
| value | number | `0` | Value associated with the data point. | 1.5 |
| key | string | — | Optional key, useful in some scenarios for maintaining visual state in host applications. | 1.0 |
| legend | string | — | The legend of the chart. | 1.5 |

> **Notes:** `valueColor` and `DonutChartData.color` accept the same chart color names shown above. Property names, defaults, and version information are transcribed from the supplied documentation; `thickness` has a prose-stated default of `Thick`.
