<?php

declare(strict_types=1);

use Archon\UIKit\DataDisplay\Card;
use Archon\UIKit\Inputs\Selects\Select;
use Archon\UIKit\Layout\Structure\Column;
use Archon\UIKit\Layout\Structure\Container;
use Archon\UIKit\Layout\Structure\Row;

echo '<h2>Selects</h2>';
echo '<p class="lead text-muted mb-4">Customize the native &lt;select&gt;s with custom CSS.</p>';

$snippet = function(string $code): string {
    return '<pre class="code-snippet m-0" style="max-height: 150px;"><code>' . htmlspecialchars($code) . '</code></pre>';
};

echo (new Container(
    new Row(
        // Standard Select
        (new Column(
            (new Card(
                (new Select('country', [
                    'us' => 'United States',
                    'ca' => 'Canada',
                    'mx' => 'Mexico',
                ]))->id('countrySelect')->placeholder('Select a Country')
            ))->header('Standard Select')
              ->footer($snippet("new Select('country', [...])->placeholder('...')"))
        ))->md(6)->addClass('mb-4'),

        // Multi-select
        (new Column(
            (new Card(
                (new Select('interests', [
                    'code' => 'Coding',
                    'design' => 'Design',
                    'marketing' => 'Marketing',
                ]))->id('interestsSelect')->multiple()
            ))->header('Multi-select')
              ->footer($snippet("new Select('interests', [...])->multiple()"))
        ))->md(6)->addClass('mb-4')
    )
))->fluid();