<?php

declare(strict_types=1);

use Archon\UIKit\DataDisplay\Card;
use Archon\UIKit\Elements\Button\Button;
use Archon\UIKit\Layout\Structure\Column;
use Archon\UIKit\Layout\Structure\Container;
use Archon\UIKit\Layout\Structure\Row;

echo '<h2>Buttons</h2>';
echo '<p class="lead text-muted mb-4">Basic button examples demonstrating variants, sizes, and outline styles.</p>';

$snippet = function(string $code): string {
    return '<pre class="code-snippet m-0" style="max-height: 150px;"><code>' . htmlspecialchars($code) . '</code></pre>';
};

echo (new Container(
    new Row(
        // Default
        (new Column(
            (new Card(
                (new Button('Primary Button'))
            ))->header('Default Button')
              ->footer($snippet("new Button('Primary Button')"))
        ))->md(4)->addClass('mb-4'),

        // Outline
        (new Column(
            (new Card(
                (new Button('Secondary Outline'))
                    ->variant('secondary')
                    ->outline()
            ))->header('Secondary Outline')
              ->footer($snippet("new Button('Secondary Outline')\n    ->variant('secondary')\n    ->outline()"))
        ))->md(4)->addClass('mb-4'),

        // Large
        (new Column(
            (new Card(
                (new Button('Large Success'))
                    ->variant('success')
                    ->size('lg')
            ))->header('Large Success Button')
              ->footer($snippet("new Button('Large Success')\n    ->variant('success')\n    ->size('lg')"))
        ))->md(4)->addClass('mb-4'),

        // Small
        (new Column(
            (new Card(
                (new Button('Small Danger'))
                    ->variant('danger')
                    ->size('sm')
            ))->header('Small Danger Button')
              ->footer($snippet("new Button('Small Danger')\n    ->variant('danger')\n    ->size('sm')"))
        ))->md(4)->addClass('mb-4')
    )
))->fluid();