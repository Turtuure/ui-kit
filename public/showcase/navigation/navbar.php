<?php

declare(strict_types=1);

use Archon\UIKit\DataDisplay\Card;
use Archon\UIKit\Layout\Structure\Column;
use Archon\UIKit\Layout\Structure\Container;
use Archon\UIKit\Layout\Structure\Row;
use Archon\UIKit\Navigation\Nav;
use Archon\UIKit\Navigation\Navbar;

echo '<h2>Navbar</h2>';
echo '<p class="lead text-muted mb-4">A responsive navigation header.</p>';

$snippet = function(string $code): string {
    return '<pre class="code-snippet m-0" style="max-height: 150px;"><code>' . htmlspecialchars($code) . '</code></pre>';
};

echo (new Container(
    new Row(
        // Basic Navbar
        (new Column(
            (new Card(
                (new Navbar('Archon Kit'))
                    ->add(new Nav(
                        '<li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Home</a></li>',
                        '<li class="nav-item"><a class="nav-link" href="#">Features</a></li>',
                        '<li class="nav-item"><a class="nav-link" href="#">Pricing</a></li>'
                    ))
            ))->header('Basic Navbar')
              ->footer($snippet("new Navbar('Brand')->add(new Nav(...))"))
        ))->xs(12)->addClass('mb-4'),

        // Dark Navbar
        (new Column(
            (new Card(
                (new Navbar('<i class="bi bi-stars"></i> Custom Brand'))
                    ->bgColor('primary')
                    ->expand('md')
                    ->add(new Nav(
                        '<li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Home</a></li>',
                        '<li class="nav-item"><a class="nav-link" href="#">Features</a></li>'
                    ))
            ))->header('Dark Navbar with Custom Background')
              ->footer($snippet("new Navbar('...')->bgColor('primary')->expand('md')"))
        ))->xs(12)->addClass('mb-4')
    )
))->fluid();