<?php

declare(strict_types=1);

use Archon\UIKit\DataDisplay\Card;
use Archon\UIKit\DataDisplay\Table;
use Archon\UIKit\Layout\Structure\Column;
use Archon\UIKit\Layout\Structure\Container;
use Archon\UIKit\Layout\Structure\Row;

echo '<h2>Tables</h2>';
echo '<p class="lead text-muted mb-4">Documentation and examples for opt-in styling of tables.</p>';

$snippet = function(string $code): string {
    return '<pre class="code-snippet m-0" style="max-height: 150px;"><code>' . htmlspecialchars($code) . '</code></pre>';
};

echo (new Container(
    new Row(
        // Basic Table
        (new Column(
            (new Card(
                new Table(
                    ['#', 'First', 'Last', 'Handle'],
                    [
                        [1, 'Mark', 'Otto', '@mdo'],
                        [2, 'Jacob', 'Thornton', '@fat'],
                        [3, 'Larry', 'the Bird', '@twitter'],
                    ]
                )
            ))->header('Basic Table')
              ->footer($snippet("new Table([...headers], [...rows])"))
        ))->md(12)->addClass('mb-4'),

        // Styled Table
        (new Column(
            (new Card(
                (new Table(
                    ['#', 'Product', 'Quantity', 'Price'],
                    [
                        [1, 'Laptop', 2, '$1200'],
                        [2, 'Mouse', 5, '$25'],
                        [3, 'Keyboard', 1, '$75'],
                    ]
                ))
                    ->striped()
                    ->hover()
                    ->responsive()
                    ->variant('dark')
            ))->header('Striped, Hoverable & Dark')
              ->footer($snippet("(new Table(...))->striped()->hover()->variant('dark')"))
        ))->md(12)->addClass('mb-4')
    )
))->fluid();