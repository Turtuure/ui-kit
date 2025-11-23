<?php

declare(strict_types=1);

use Archon\UIKit\DataDisplay\Card;
use Archon\UIKit\DataDisplay\Lists\ListGroup;
use Archon\UIKit\Elements\Badge\Badge;
use Archon\UIKit\Layout\Structure\Column;
use Archon\UIKit\Layout\Structure\Container;
use Archon\UIKit\Layout\Structure\Row;

echo '<h2>List Groups</h2>';
echo '<p class="lead text-muted mb-4">Flexible and powerful component for displaying a series of content.</p>';

$snippet = function(string $code): string {
    return '<pre class="code-snippet m-0" style="max-height: 150px;"><code>' . htmlspecialchars($code) . '</code></pre>';
};

echo (new Container(
    new Row(
        // Basic
        (new Column(
            (new Card(
                new ListGroup(
                    'An item',
                    'A second item',
                    'A third item',
                    'A fourth item',
                    'And a fifth one'
                )
            ))->header('Basic List Group')
              ->footer($snippet("new ListGroup('Item 1', 'Item 2'...)"))
        ))->md(4)->addClass('mb-4'),

        // Links/Active
        (new Column(
            (new Card(
                (new ListGroup())
                    ->add('An active link item', '#', true)
                    ->add('A second link item', '#')
                    ->add('A third link item', '#')
                    ->add('A disabled link item', '#', false, true)
            ))->header('Links & Active State')
              ->footer($snippet("(new ListGroup())->add('Link', '#', true)"))
        ))->md(4)->addClass('mb-4'),

        // Numbered/Badges
        (new Column(
            (new Card(
                (new ListGroup())
                    ->numbered()
                    ->add('Cras justo odio', null, false, false, (new Badge('14'))->variant('primary'))
                    ->add('Cras justo odio', null, false, false, (new Badge('2'))->variant('danger'))
                    ->add('Cras justo odio')
            ))->header('Numbered & Badges')
              ->footer($snippet("->add(..., new Badge('14'))"))
        ))->md(4)->addClass('mb-4')
    )
))->fluid();