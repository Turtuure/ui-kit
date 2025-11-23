<?php

declare(strict_types=1);

use Archon\UIKit\DataDisplay\Card;
use Archon\UIKit\Layout\Structure\Column;
use Archon\UIKit\Layout\Structure\Container;
use Archon\UIKit\Layout\Structure\Row;
use Archon\UIKit\Navigation\Breadcrumb;

echo '<h2>Breadcrumbs</h2>';
echo '<p class="lead text-muted mb-4">Indicate the current page location within a navigational hierarchy.</p>';

$snippet = function(string $code): string {
    return '<pre class="code-snippet m-0" style="max-height: 150px;"><code>' . htmlspecialchars($code) . '</code></pre>';
};

echo (new Container(
    new Row(
        (new Column(
            (new Card(
                new Breadcrumb([
                    'Home' => '#',
                    'Library' => '#',
                    'Data' => null
                ])
            ))->header('Standard Breadcrumb')
              ->footer($snippet("new Breadcrumb(['Home' => '#', ...])"))
        ))->md(12)->addClass('mb-4')
    )
))->fluid();