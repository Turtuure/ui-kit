<?php

declare(strict_types=1);

use Archon\UIKit\DataDisplay\Card;
use Archon\UIKit\Layout\Structure\Column;
use Archon\UIKit\Layout\Structure\Container;
use Archon\UIKit\Layout\Structure\Row;
use Archon\UIKit\Typography\Heading;
use Archon\UIKit\Typography\Text;

echo '<h2>Typography</h2>';
echo '<p class="lead text-muted mb-4">Examples of headings, paragraphs, and text styles using local fonts.</p>';

$snippet = function(string $code): string {
    return '<pre class="code-snippet m-0" style="max-height: 150px;"><code>' . htmlspecialchars($code) . '</code></pre>';
};

echo (new Container(
    new Row(
        // Headings
        (new Column(
            (new Card(
                (new Heading('Heading 1', 1)) .
                (new Heading('Heading 2', 2)) .
                (new Heading('Heading 3', 3)) .
                (new Heading('Heading 4', 4)) .
                (new Heading('Heading 5', 5)) .
                (new Heading('Heading 6', 6))
            ))->header('Headings (h1-h6)')
              ->footer($snippet("new Heading('Heading 1', 1);"))
        ))->md(6)->addClass('mb-4'),

        // Display Headings
        (new Column(
            (new Card(
                (new Heading('Display 1', 1))->display(1) .
                (new Heading('Display 2', 2))->display(2) .
                (new Heading('Display 3', 3))->display(3) .
                (new Heading('Display 4', 4))->display(4)
            ))->header('Display Headings')
              ->footer($snippet("new Heading('Display 1', 1)->display(1);"))
        ))->md(6)->addClass('mb-4'),

        // Font Families
        (new Column(
            (new Card(
                (new Text('This is Inter (Default Sans-Serif).'))->addClass('font-sans mb-2') .
                (new Text('This is Merriweather (Serif).'))->addClass('font-serif mb-2 fs-5') .
                (new Text('This is Roboto Mono (Monospace).'))->addClass('font-mono')
            ))->header('Font Families')
              ->footer($snippet("new Text('...')->addClass('font-serif');"))
        ))->md(6)->addClass('mb-4'),

        // Paragraphs
        (new Column(
            (new Card(
                (new Text('This is a standard paragraph of text. It demonstrates the default font-family and line-height.')) .
                (new Text('This is a muted paragraph of text, often used for secondary information.'))->muted() .
                (new Text('This is a small span of muted text.'))->tag('small')->muted()
            ))->header('Paragraphs & Muted')
              ->footer($snippet("new Text('...')->muted();"))
        ))->md(6)->addClass('mb-4')
    )
))->fluid();
