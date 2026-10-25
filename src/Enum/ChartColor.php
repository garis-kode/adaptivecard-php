<?php

declare(strict_types=1);

namespace AdaptiveCards\Enum;

enum ChartColor: string
{
    // Semantic
    case Good = 'good';
    case Warning = 'warning';
    case Attention = 'attention';
    case Neutral = 'neutral';

    // Categorical
    case CategoricalRed = 'categoricalRed';
    case CategoricalPurple = 'categoricalPurple';
    case CategoricalLavender = 'categoricalLavender';
    case CategoricalBlue = 'categoricalBlue';
    case CategoricalLightBlue = 'categoricalLightBlue';
    case CategoricalTeal = 'categoricalTeal';
    case CategoricalGreen = 'categoricalGreen';
    case CategoricalLime = 'categoricalLime';
    case CategoricalMarigold = 'categoricalMarigold';

    // Sequential
    case Sequential1 = 'sequential1';
    case Sequential2 = 'sequential2';
    case Sequential3 = 'sequential3';
    case Sequential4 = 'sequential4';
    case Sequential5 = 'sequential5';
    case Sequential6 = 'sequential6';
    case Sequential7 = 'sequential7';
    case Sequential8 = 'sequential8';

    // Diverging
    case DivergingBlue = 'divergingBlue';
    case DivergingLightBlue = 'divergingLightBlue';
    case DivergingCyan = 'divergingCyan';
    case DivergingTeal = 'divergingTeal';
    case DivergingYellow = 'divergingYellow';
    case DivergingPeach = 'divergingPeach';
    case DivergingLightRed = 'divergingLightRed';
    case DivergingRed = 'divergingRed';
    case DivergingMaroon = 'divergingMaroon';
    case DivergingGray = 'divergingGray';

    // Sequential Red
    case SequentialRed1 = 'sequentialRed1';
    case SequentialRed2 = 'sequentialRed2';
    case SequentialRed3 = 'sequentialRed3';
    case SequentialRed4 = 'sequentialRed4';
    case SequentialRed5 = 'sequentialRed5';
    case SequentialRed6 = 'sequentialRed6';
    case SequentialRed7 = 'sequentialRed7';
    case SequentialRed8 = 'sequentialRed8';

    // Sequential Green
    case SequentialGreen1 = 'sequentialGreen1';
    case SequentialGreen2 = 'sequentialGreen2';
    case SequentialGreen3 = 'sequentialGreen3';
    case SequentialGreen4 = 'sequentialGreen4';
    case SequentialGreen5 = 'sequentialGreen5';
    case SequentialGreen6 = 'sequentialGreen6';
    case SequentialGreen7 = 'sequentialGreen7';
    case SequentialGreen8 = 'sequentialGreen8';

    // Sequential Yellow
    case SequentialYellow1 = 'sequentialYellow1';
    case SequentialYellow2 = 'sequentialYellow2';
    case SequentialYellow3 = 'sequentialYellow3';
    case SequentialYellow4 = 'sequentialYellow4';
    case SequentialYellow5 = 'sequentialYellow5';
    case SequentialYellow6 = 'sequentialYellow6';
    case SequentialYellow7 = 'sequentialYellow7';
    case SequentialYellow8 = 'sequentialYellow8';
}
