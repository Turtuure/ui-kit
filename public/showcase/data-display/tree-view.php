<?php

declare(strict_types=1);

use Archon\UIKit\DataDisplay\Card;
use Archon\UIKit\DataDisplay\TreeView;
use Archon\UIKit\Layout\Structure\Column;
use Archon\UIKit\Layout\Structure\Container;
use Archon\UIKit\Layout\Structure\Row;

echo '<h2>Tree View</h2>';
echo '<p class="lead text-muted mb-4">Visualize hierarchical data using nested details and summary elements.</p>';

$snippet = function(string $code): string {
    return '<pre class="code-snippet m-0" style="max-height: 150px;"><code>' . htmlspecialchars($code) . '</code></pre>';
};

echo (new Container(
    new Row(
        // Basic
        (new Column(
            (new Card(
                (new TreeView([
                    'Project' => [
                        'src' => [
                            'Components' => ['Button.php', 'Card.php'],
                            'Services' => ['Auth.php', 'Logger.php'],
                            'index.php'
                        ],
                        'tests' => ['ButtonTest.php', 'CardTest.php'],
                        'README.md'
                    ]
                ]))->open()
            ))->header('File Structure')
              ->footer($snippet("new TreeView(['Folder' => ['File']])->open()"))
        ))->md(6)->addClass('mb-4'),

        // Deep Nesting
        (new Column(
            (new Card(
                new TreeView([
                    'Level 1' => [
                        'Level 2' => [
                            'Level 3' => [
                                'Level 4' => ['Leaf Node']
                            ]
                        ]
                    ]
                ])
            ))->header('Deep Nesting')
              ->footer($snippet("new TreeView(...)"))
        ))->md(6)->addClass('mb-4')
    )
))->fluid();