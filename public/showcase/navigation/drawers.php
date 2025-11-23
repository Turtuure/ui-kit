<?php

declare(strict_types=1);

use Archon\UIKit\DataDisplay\Card;
use Archon\UIKit\Elements\Button\Button;
use Archon\UIKit\Layout\Structure\Column;
use Archon\UIKit\Layout\Structure\Container;
use Archon\UIKit\Layout\Structure\Row;
use Archon\UIKit\Navigation\Drawer;

echo '<h2>Drawers (Offcanvas)</h2>';
echo '<p class="lead text-muted mb-4">Build hidden sidebars into your project for navigation, shopping carts, and more.</p>';

$snippet = function(string $code): string {
    return '<pre class="code-snippet m-0" style="max-height: 150px;"><code>' . htmlspecialchars($code) . '</code></pre>';
};

echo (new Container(
    new Row(
        // Standard
        (new Column(
            (new Card(
                (new Button('Open Drawer'))
                    ->variant('primary')
                    ->data('bs-toggle', 'offcanvas')
                    ->data('bs-target', '#demoDrawer') .
                
                (new Drawer('demoDrawer', 'Menu'))
                    ->body('<p>Here is some navigation content...</p><ul><li>Home</li><li>Profile</li><li>Settings</li></ul>')
            ))->header('Standard Drawer')
              ->footer($snippet("new Drawer('id', 'Title')->body(...)"))
        ))->md(6)->addClass('mb-4'),

        // Top Placement
        (new Column(
            (new Card(
                (new Button('Open Top Drawer'))
                    ->variant('secondary')
                    ->data('bs-toggle', 'offcanvas')
                    ->data('bs-target', '#topDrawer') .

                (new Drawer('topDrawer', 'Top Drawer'))
                    ->placement('top')
                    ->body('<p>This drawer is on the top!</p>')
            ))->header('Top Placement')
              ->footer($snippet("new Drawer(...)->placement('top')"))
        ))->md(6)->addClass('mb-4')
    )
))->fluid();