<?php

declare(strict_types=1);

use Archon\UIKit\DataDisplay\Card;
use Archon\UIKit\Elements\Badge\Badge;
use Archon\UIKit\Layout\Structure\Column;
use Archon\UIKit\Layout\Structure\Container;
use Archon\UIKit\Layout\Structure\Row;

echo '<h2>Badges</h2>';
echo '<p class="lead text-muted mb-4">Small count and labeling component.</p>';

$snippet = function(string $code): string {
    return '<pre class="code-snippet m-0" style="max-height: 150px;"><code>' . htmlspecialchars($code) . '</code></pre>';
};

echo (new Container(
    new Row(
        // Standard
        (new Column(
            (new Card(
                (new Badge('Primary')) .
                (new Badge('Secondary'))->variant('secondary')->addClass('ms-1') .
                (new Badge('Success'))->variant('success')->addClass('ms-1') .
                (new Badge('Danger'))->variant('danger')->addClass('ms-1') .
                (new Badge('Warning'))->variant('warning')->textColor('dark')->addClass('ms-1') .
                (new Badge('Info'))->variant('info')->textColor('dark')->addClass('ms-1') .
                (new Badge('Light'))->variant('light')->textColor('dark')->addClass('me-1') .
                (new Badge('Dark'))->variant('dark')->addClass('me-1')
            ))->header('Contextual Variations')
              ->footer($snippet("new Badge('Primary')"))
        ))->md(6)->addClass('mb-4'),

        // Pills
        (new Column(
            (new Card(
                (new Badge('Primary'))->pill() .
                (new Badge('Success'))->variant('success')->pill()->addClass('ms-1')
            ))->header('Pill Badges')
              ->footer($snippet("(new Badge('Primary'))->pill()"))
        ))->md(6)->addClass('mb-4')
    )
))->fluid();