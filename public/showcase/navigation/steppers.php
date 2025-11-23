<?php

declare(strict_types=1);

use Archon\UIKit\DataDisplay\Card;
use Archon\UIKit\Layout\Structure\Column;
use Archon\UIKit\Layout\Structure\Container;
use Archon\UIKit\Layout\Structure\Row;
use Archon\UIKit\Navigation\Stepper;

echo '<h2>Steppers</h2>';
echo '<p class="lead text-muted mb-4">A component to convey progress through numbered steps.</p>';

$snippet = function(string $code): string {
    return '<pre class="code-snippet m-0" style="max-height: 150px;"><code>' . htmlspecialchars($code) . '</code></pre>';
};

echo (new Container(
    new Row(
        // Horizontal
        (new Column(
            (new Card(
                new Stepper(['Cart', 'Shipping', 'Payment', 'Confirmation'], 2)
            ))->header('Horizontal Stepper')
              ->footer($snippet("new Stepper(['Step 1', 'Step 2'], 2)"))
        ))->xs(12)->addClass('mb-4'),

        // Vertical
        (new Column(
            (new Card(
                (new Stepper(['Step 1: Setup', 'Step 2: Details', 'Step 3: Review'], 3))->vertical()
            ))->header('Vertical Stepper')
              ->footer($snippet("(new Stepper(...))->vertical()"))
        ))->xs(12)->addClass('mb-4')
    )
))->fluid();