<?php

declare(strict_types=1);

use Archon\UIKit\DataDisplay\Card;
use Archon\UIKit\DataDisplay\Lists\ListGroup;
use Archon\UIKit\DataDisplay\Table;
use Archon\UIKit\Elements\Badge\Badge;
use Archon\UIKit\Showcase\Showcase;

/**
 * Data Display Showcase Page
 */

echo '<h2>Data Display</h2>';
echo '<p class="lead text-muted">Examples of Cards, Tables, Badges, and List Groups for structured content presentation.</p>';

// --- Cards ---

Showcase::example(
    'Basic Card',
    'A simple card with a title and body content.',
    function () {
        echo new Card(
            '<h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card\'s content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>'
        );
    },
    'new Card(
    \'\u003ch5 class=\"card-title\"\u003eCard title\u003c/h5\u003e...\')'
);

Showcase::example(
    'Card with Header, Footer, and Image',
    'A more complex card featuring a header, footer, and a top image.',
    function () {
        echo (new Card(
            '<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card\'s content.</p>'
        ))
            ->header('Featured')
            ->imageTop('https://via.placeholder.com/286x180.png?text=Card+Image', 'Card image cap')
            ->footer('2 days ago');
    },
    '(new Card(...))
    ->header(\'Featured\')
    ->imageTop(...)
    ->footer(...)'
);

Showcase::example(
    'Colored Card',
    'A card with a primary background and white text.',
    function () {
        echo (new Card(
            '<h5 class="card-title">Primary Card title</h5>
            <p class="card-text">Some quick example text to build on the card title.</p>'
        ))
            ->variant('primary')
            ->textColor('white');
    },
    '(new Card(...))
    ->variant(\'primary\')
    ->textColor(\'white\')'
);

// --- Tables ---

Showcase::example(
    'Basic Table',
    'A simple table with headers and rows.',
    function () {
        echo new Table(
            ['#', 'First', 'Last', 'Handle'],
            [
                [1, 'Mark', 'Otto', '@mdo'],
                [2, 'Jacob', 'Thornton', '@fat'],
                [3, 'Larry', 'the Bird', '@twitter'],
            ]
        );
    },
    'new Table([
    \'#\', \'First\', \'Last\', \'Handle\' 
], [
    [1, \'Mark\', \'Otto\', \'@mdo\'],
    // ... more rows
])'
);

Showcase::example(
    'Striped, Hoverable & Responsive Table (Dark Variant)',
    'A table with multiple Bootstrap features and a dark theme.',
    function () {
        echo (new Table(
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
            ->variant('dark');
    },
    '(new Table(...))
    ->striped()
    ->hover()
    ->responsive()
    ->variant(\'dark\')'
);


// --- Badges ---

Showcase::example(
    'Badges',
    'Small count and labeling component.',
    function () {
        echo new Badge('Primary');
        echo (new Badge('Secondary'))->variant('secondary')->addClass('ms-1');
        echo (new Badge('Success'))->variant('success')->addClass('ms-1');
        echo (new Badge('Danger'))->variant('danger')->addClass('ms-1');
        echo (new Badge('Warning'))->variant('warning')->textColor('dark')->addClass('ms-1');
        echo (new Badge('Info'))->variant('info')->textColor('dark')->addClass('ms-1');
        echo (new Badge('Light'))->variant('light')->textColor('dark')->addClass('me-1');
        echo (new Badge('Dark'))->variant('dark')->addClass('me-1');
    },
    'new Badge(\'Primary\');
(new Badge(\'Secondary\'))->variant(\'secondary\');'
);

Showcase::example(
    'Pill Badges',
    'Rounded badges.',
    function () {
        echo (new Badge('Primary'))->pill();
        echo (new Badge('Success'))->variant('success')->pill()->addClass('ms-1');
    },
    '(new Badge(\'Primary\'))->pill()'
);

// --- List Groups ---

Showcase::example(
    'Basic List Group',
    'A simple list group with unlinked items.',
    function () {
        echo new ListGroup(
            'An item',
            'A second item',
            'A third item',
            'A fourth item',
            'And a fifth one'
        );
    },
    'new ListGroup(\'An item\', \'A second item\', ...)'
);

Showcase::example(
    'List Group with Links and Active Item',
    'List group items rendered as links with active/disabled states.',
    function () {
        echo (new ListGroup())
            ->add('An active link item', '#', true)
            ->add('A second link item', '#')
            ->add('A third link item', '#')
            ->add('A disabled link item', '#', false, true);
    },
    '(new ListGroup())->add(\'Active Link\', \'#\', true)'
);

Showcase::example(
    'Numbered List Group with Badges',
    'An ordered list group with badges on some items.',
    function () {
        echo (new ListGroup())
            ->numbered()
            ->add('Cras justo odio', null, false, false, (new Badge('14'))->variant('primary'))
            ->add('Cras justo odio', null, false, false, (new Badge('2'))->variant('danger'))
            ->add('Cras justo odio');
    },
    '(new ListGroup())->numbered()
    ->add(\'Item with badge\', null, false, false, new Badge(...))'
);
