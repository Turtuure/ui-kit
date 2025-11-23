<?php

declare(strict_types=1);

use Archon\UIKit\Layout\Structure\Column;
use Archon\UIKit\Layout\Structure\Container;
use Archon\UIKit\Layout\Structure\Row;
use Archon\UIKit\Showcase\Showcase;

echo '<h2>Grid System</h2>';
echo '<p class="lead text-muted">Layout examples using Container, Row, and Column.</p>';

Showcase::example(
    'Basic Grid (Auto Layout)',
    'Three equal-width columns using the auto-layout feature.',
    function () {
        // Visual styling for columns
        $style = 'background: rgba(0,123,255,0.15); border: 1px solid rgba(0,123,255,0.3); padding: 1rem; text-align: center;';
        
        echo new Container(
            (new Row(
                (new Column('Column 1'))->setAttribute('style', $style),
                (new Column('Column 2'))->setAttribute('style', $style),
                (new Column('Column 3'))->setAttribute('style', $style)
            ))->gutter(3)
        );
    },
    'new Container(
    new Row(
        new Column(\'Column 1\'),
        new Column(\'Column 2\'),
        new Column(\'Column 3\')
    ) )'
);

Showcase::example(
    'Responsive Breakpoints',
    'Columns that stack on mobile (xs=12) and become 50% width on medium screens (md=6).',
    function () {
        $style = 'background: rgba(40,167,69,0.15); border: 1px solid rgba(40,167,69,0.3); padding: 1rem; text-align: center;';

        echo new Container(
            (new Row(
                (new Column('col-12 col-md-8'))->xs(12)->md(8)->setAttribute('style', $style),
                (new Column('col-6 col-md-4'))->xs(6)->md(4)->setAttribute('style', $style)
            ))->gutter(2)
        );
    },
    'new Row(
    (new Column(\'Main Content\'))->xs(12)->md(8),
    (new Column(\'Sidebar\'))->xs(6)->md(4)
)'
);

