# CodeBlock

**Works in:** Teams, Copilot

A formatted and syntax-colored code block.

## Card

### JSON

```json
{
  "type": "AdaptiveCard",
  "version": "1.5",
  "body": [
    {
      "type": "TextBlock",
      "text": "editor.js",
      "style": "heading"
    },
    {
      "type": "TextBlock",
      "text": "Lines 61 - 76"
    },
    {
      "type": "CodeBlock",
      "codeSnippet": "/**\n* @author John Smith <john.smith@example.com>\n*/\npackage l2f.gameserver.model;\n\npublic abstract strictfp class L2Char extends L2Object {\n  public static final Short ERROR = 0x0001;\n\n  public void moveTo(int x, int y, int z) {\n    _ai = null;\n    log(\"Should not be called\");\n    if (1 > 5) { // wtf!?\n      return;\n    }\n  }\n}",
      "language": "java",
      "startLineNumber": 61
    }
  ]
}
```

## Schema

| Name | Type | Default | Description | In version |
| --- | --- | --- | --- | --- |
| `type` | string | — | Must be `CodeBlock`. | 1.0 |
| `codeSnippet` | string | — | The code snippet to display. | 1.5 |
| `fallback` | object or string | — | An alternate element to render if this type is unsupported or the host does not support required capabilities. See valid values below. | 1.2 |
| `grid.area` | string | — | **Teams.** The area of a `Layout.AreaGrid` layout in which an element should be displayed. | 1.5 |
| `height` | string | `"auto"` | The height of the element. When set to `stretch`, the element uses the remaining vertical space in its container. Valid: `auto`, `stretch`. | 1.1 |
| `horizontalAlignment` | string | — | Horizontal alignment. Valid: `Left`, `Center`, `Right`. | 1.0 |
| `id` | string | — | A unique identifier for the element or action. Input elements must have an ID to be validated and to send their values to the bot. | 1.0 |
| `isSortKey` | boolean | `false` | Whether the element is used as a sort key by elements that support collection sorting. | 1.5 |
| `isVisible` | boolean | `true` | Controls the visibility of the element. | 1.2 |
| `isVisible.dynamic` | string | — | **Preview.** An expression evaluated to update `isVisible` at runtime. | 1.5 |
| `key` | string | — | Optional object key; can help maintain visual state in the host application. | 1.0 |
| `lang` | string | — | The locale associated with the element. | 1.1 |
| `language` | string | `"PlainText"` | The language of the code snippet. See supported languages below. | 1.5 |
| `requires` | object | `{}` | Capabilities that the host application must support; otherwise the element is not rendered (or its fallback is used). Valid: `HostCapabilities`. | 1.2 |
| `separator` | boolean | `false` | Display a separator above the element. No separator appears for the first element in a container. | 1.0 |
| `spacing` | string | `"Default"` | Space between this element and the previous one; none is added for the first element in a container. See valid values below. | 1.0 |
| `startLineNumber` | number | `1` | The line number in the file from which the code snippet was extracted. | 1.5 |
| `targetWidth` | string | — | **Teams, Copilot.** Card width at which the element is displayed. Without it, the element renders at all widths. See responsive values below. | 1.0 |

### Valid values

#### `fallback`

An object of one of the following types, or the string `"drop"`:

- `Container`, `ActionSet`, `ColumnSet`, `Media`, `RichTextBlock`, `Table`, `TextBlock`, `FactSet`, `ImageSet`, `Image`
- `Input.Text`, `Input.Date`, `Input.Time`, `Input.Number`, `Input.Toggle`, `Input.ChoiceSet`, `Input.Rating`
- `Rating`, `CompoundButton`, `Icon`, `Carousel`, `TabSet`, `Accordion`, `Badge`, `ProgressRing`, `ProgressBar`, `LoopComponent`
- `Chart.Donut`, `Chart.Pie`, `Chart.VerticalBar.Grouped`, `Chart.VerticalBar`, `Chart.HorizontalBar`, `Chart.HorizontalBar.Stacked`, `Chart.Line`, `Chart.Gauge`
- `CodeBlock`, `Persona`, `PersonaSet`, `Graph resource`, `File`, `Calendar event`
- `"drop"`

#### `language`

`Bash`, `C`, `Cpp`, `CSharp`, `Css`, `Dos`, `Go`, `Graphql`, `Html`, `Java`, `JavaScript`, `Json`, `ObjectiveC`, `Perl`, `Php`, `PlainText`, `PowerShell`, `Python`, `Sql`, `TypeScript`, `VbNet`, `Verilog`, `Vhdl`, `Xml`

#### `spacing`

`None`, `ExtraSmall`, `Small`, `Default`, `Medium`, `Large`, `ExtraLarge`, `Padding`

#### `targetWidth`

`VeryNarrow`, `Narrow`, `Standard`, `Wide`, `atLeast:VeryNarrow`, `atMost:VeryNarrow`, `atLeast:Narrow`, `atMost:Narrow`, `atLeast:Standard`, `atMost:Standard`, `atLeast:Wide`, `atMost:Wide`

Specifying `targetWidth` allows cards to adapt their layout to the available horizontal space. See *Responsive layout* for further details.
