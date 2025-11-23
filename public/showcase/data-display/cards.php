<?php

declare(strict_types=1);

use Archon\UIKit\DataDisplay\Card;
use Archon\UIKit\Layout\Structure\Column;
use Archon\UIKit\Layout\Structure\Container;
use Archon\UIKit\Layout\Structure\Row;

echo '<h2>Cards</h2>';
echo '<p class="lead text-muted mb-4">Flexible and extensible content container.</p>';

$snippet = function(string $code): string {
    return '<pre class="code-snippet m-0" style="max-height: 150px;"><code>' . htmlspecialchars($code) . '</code></pre>';
};

echo (new Container(
    new Row(
        // Basic
        (new Column(
            (new Card(
                '<h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card\'s content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>'
            ))->header('Basic Card')
              ->footer($snippet("new Card('...'))"))
        ))->md(4)->addClass('mb-4'),

        // Header/Footer/Image
        (new Column(
            (new Card(
                '<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card\'s content.</p>'
            ))
                ->header('Featured')
                ->imageTop('https://via.placeholder.com/286x180.png?text=Card+Image', 'Card image cap')
                ->footer('2 days ago')
        ))->md(4)->addClass('mb-4'),

        // Colored
        (new Column(
            (new Card(
                '<h5 class="card-title">Primary Card title</h5>
                <p class="card-text">Some quick example text to build on the card title.</p>'
            ))
                ->variant('primary')
                ->textColor('white')
        ))->md(4)->addClass('mb-4')
    )
))->fluid();