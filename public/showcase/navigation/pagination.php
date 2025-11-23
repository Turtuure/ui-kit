<?php

declare(strict_types=1);

use Archon\UIKit\DataDisplay\Card;
use Archon\UIKit\Layout\Structure\Column;
use Archon\UIKit\Layout\Structure\Container;
use Archon\UIKit\Layout\Structure\Row;
use Archon\UIKit\Navigation\Pagination;

echo '<h2>Pagination</h2>';
echo '<p class="lead text-muted mb-4">Examples for showing pagination to indicate a series of related content exists across multiple pages.</p>';

$snippet = function(string $code): string {
    return '<pre class="code-snippet m-0" style="max-height: 150px;"><code>' . htmlspecialchars($code) . '</code></pre>';
};

echo (new Container(
    new Row(
        // Standard
        (new Column(
            (new Card(
                new Pagination(5, 2, '#page-{page}')
            ))->header('Standard Pagination')
              ->footer($snippet("new Pagination(5, 2, '#page-{page}')"))
        ))->md(6)->addClass('mb-4'),

        // Sizes
        (new Column(
            (new Card(
                (new Pagination(3, 1))->size('lg')->addClass('mb-2') .
                (new Pagination(3, 1))->size('sm')
            ))->header('Sizing')
              ->footer($snippet("(new Pagination(3, 1))->size('lg')"))
        ))->md(6)->addClass('mb-4')
    )
))->fluid();