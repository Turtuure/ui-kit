<?php

declare(strict_types=1);

use Archon\UIKit\Showcase\Showcase;
use Archon\UIKit\Typography\Heading;
use Archon\UIKit\Typography\Text;

/**
 * Typography Showcase Page
 */

echo '<h2>Typography</h2>';
echo '<p class="lead text-muted">Examples of headings, paragraphs, and text styles using the Inter font.</p>';

Showcase::example(
    'Headings (h1-h6)',
    'Standard HTML headings with varying levels.',
    function () {
        echo (new Heading('Heading 1', 1));
        echo (new Heading('Heading 2', 2));
        echo (new Heading('Heading 3', 3));
        echo (new Heading('Heading 4', 4));
        echo (new Heading('Heading 5', 5));
        echo (new Heading('Heading 6', 6));
    },
    'echo new Heading(\'Heading 1\', 1); // ... and so on'
);

Showcase::example(
    'Display Headings',
    'Larger, more prominent headings for marketing or hero sections.',
    function () {
        echo (new Heading('Display 1', 1))->display(1);
        echo (new Heading('Display 2', 2))->display(2);
        echo (new Heading('Display 3', 3))->display(3);
        echo (new Heading('Display 4', 4))->display(4);
    },
    'echo (new Heading(\'Display 1\', 1))->display(1);'
);

Showcase::example(
    'Paragraphs and Muted Text',
    'Basic paragraph text and a muted variant.',
    function () {
        echo (new Text('This is a standard paragraph of text. It demonstrates the default font-family and line-height.'));
        echo (new Text('This is a muted paragraph of text, often used for secondary information.'))->muted();
        echo (new Text('This is a small span of muted text.'))->tag('small')->muted();
    },
    'echo new Text(\'Standard paragraph\');
echo (new Text(\'Muted paragraph\'))->muted();'
);
