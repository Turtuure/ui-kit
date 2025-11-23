<?php

declare(strict_types=1);

use Archon\UIKit\DataDisplay\Card;
use Archon\UIKit\Elements\Spinner\Spinner;
use Archon\UIKit\Layout\Structure\Column;
use Archon\UIKit\Layout\Structure\Container;
use Archon\UIKit\Layout\Structure\Row;

echo '<h2>Spinners</h2>';
echo '<p class="lead text-muted mb-4">Indicate the loading state of a component or page.</p>';

$snippet = function(string $code): string {
    return '<pre class="code-snippet m-0" style="max-height: 150px;"><code>' . htmlspecialchars($code) . '</code></pre>';
};

echo (new Container(
    new Row(
        // Border Spinners
        (new Column(
            (new Card(
                (new Spinner('border'))->variant('primary')->addClass('me-2') .
                (new Spinner('border'))->variant('secondary')->addClass('me-2') .
                (new Spinner('border'))->variant('success')->size('sm')->addClass('me-2') .
                (new Spinner('border'))->variant('danger')->addClass('me-2') .
                (new Spinner('border'))->variant('warning')->addClass('me-2') .
                (new Spinner('border'))->variant('info')->addClass('me-2') .
                (new Spinner('border'))->variant('light')->addClass('me-2 bg-dark p-2 rounded') .
                (new Spinner('border'))->variant('dark')->addClass('me-2')
            ))->header('Border Spinners')
              ->footer($snippet("new Spinner('border')->variant('primary');"))
        ))->md(6)->addClass('mb-4'),

        // Grow Spinners
        (new Column(
            (new Card(
                (new Spinner('grow'))->variant('primary')->addClass('me-2') .
                (new Spinner('grow'))->variant('secondary')->addClass('me-2') .
                (new Spinner('grow'))->variant('success')->size('sm')->addClass('me-2') .
                (new Spinner('grow'))->variant('dark')->addClass('me-2')
            ))->header('Grow Spinners')
              ->footer($snippet("new Spinner('grow')->variant('primary');"))
        ))->md(6)->addClass('mb-4'),

        // With Text
        (new Column(
            (new Card(
                '<button class="btn btn-primary" type="button" disabled>' .
                (new Spinner('border'))->size('sm')->addClass('me-1') .
                'Loading...</button> ' .
                '<button class="btn btn-dark" type="button" disabled>' .
                (new Spinner('grow'))->size('sm')->variant('light')->addClass('me-1') .
                'Loading...</button>'
            ))->header('Spinners with Text')
              ->footer($snippet("new Spinner('border')->size('sm');"))
        ))->md(6)->addClass('mb-4')
    )
))->fluid();