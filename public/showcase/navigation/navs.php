<?php

declare(strict_types=1);

use Archon\UIKit\DataDisplay\Card;
use Archon\UIKit\Layout\Structure\Column;
use Archon\UIKit\Layout\Structure\Container;
use Archon\UIKit\Layout\Structure\Row;
use Archon\UIKit\Navigation\Nav;

echo '<h2>Base Navigation</h2>';
echo '<p class="lead text-muted mb-4">Basic navigation components like links, tabs, and pills.</p>';

$snippet = function(string $code): string {
    return '<pre class="code-snippet m-0" style="max-height: 150px;"><code>' . htmlspecialchars($code) . '</code></pre>';
};

echo (new Container(
    new Row(
        // Basic Nav
        (new Column(
            (new Card(
                new Nav(
                    '<li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Active</a></li>',
                    '<li class="nav-item"><a class="nav-link" href="#">Link</a></li>',
                    '<li class="nav-item"><a class="nav-link" href="#">Link</a></li>',
                    '<li class="nav-item"><a class="nav-link disabled" aria-disabled="true">Disabled</a></li>'
                )
            ))->header('Basic Nav Links')
              ->footer($snippet("new Nav('<li>...</li>', '<li>...</li>')"))
        ))->md(6)->addClass('mb-4'),

        // Tabs
        (new Column(
            (new Card(
                (new Nav(
                    '<li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Active</a></li>',
                    '<li class="nav-item"><a class="nav-link" href="#">Link</a></li>',
                    '<li class="nav-item"><a class="nav-link" href="#">Link</a></li>'
                ))->tabs()
            ))->header('Nav Tabs')
              ->footer($snippet("(new Nav(...))->tabs()"))
        ))->md(6)->addClass('mb-4'),

        // Pills
        (new Column(
            (new Card(
                (new Nav(
                    '<li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Active</a></li>',
                    '<li class="nav-item"><a class="nav-link" href="#">Link</a></li>',
                    '<li class="nav-item"><a class="nav-link" href="#">Link</a></li>'
                ))->pills()->fill()
            ))->header('Nav Pills (Fill)')
              ->footer($snippet("(new Nav(...))->pills()->fill()"))
        ))->md(6)->addClass('mb-4'),

        // Vertical
        (new Column(
            (new Card(
                (new Nav(
                    '<li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Active</a></li>',
                    '<li class="nav-item"><a class="nav-link" href="#">Link</a></li>',
                    '<li class="nav-item"><a class="nav-link" href="#">Link</a></li>'
                ))->pills()->vertical()
            ))->header('Vertical Nav Pills')
              ->footer($snippet("(new Nav(...))->pills()->vertical()"))
        ))->md(6)->addClass('mb-4')
    )
))->fluid();