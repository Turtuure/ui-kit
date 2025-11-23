<?php

declare(strict_types=1);

use Archon\UIKit\DataDisplay\Card;
use Archon\UIKit\Elements\Button\Button;
use Archon\UIKit\Inputs\FileUpload;
use Archon\UIKit\Inputs\InputGroup;
use Archon\UIKit\Inputs\TextInput;
use Archon\UIKit\Layout\Structure\Column;
use Archon\UIKit\Layout\Structure\Container;
use Archon\UIKit\Layout\Structure\Row;

echo '<h2>Advanced Forms</h2>';
echo '<p class="lead text-muted mb-4">Input groups and file uploads.</p>';

$snippet = function(string $code): string {
    return '<pre class="code-snippet m-0" style="max-height: 150px;"><code>' . htmlspecialchars($code) . '</code></pre>';
};

echo (new Container(
    new Row(
        // Input Groups
        (new Column(
            (new Card(
                (new InputGroup('@', (new TextInput('username'))->placeholder('Username')))->addClass('mb-3') .
                (new InputGroup((new TextInput('amount'))->placeholder('Amount'), '.00'))->addClass('mb-3') .
                (new InputGroup('$', (new TextInput('amount'))->placeholder('Amount'), '.00'))
            ))->header('Input Groups')
              ->footer($snippet("new InputGroup('@', new TextInput('username'))"))
        ))->md(6)->addClass('mb-4'),

        // Button Addons
        (new Column(
            (new Card(
                (new InputGroup(
                    (new TextInput('search'))->placeholder('Search...'),
                    (new Button('Go'))->variant('outline-secondary')
                ))
            ))->header('Button Addons')
              ->footer($snippet("new InputGroup(new TextInput(...), new Button(...))"))
        ))->md(6)->addClass('mb-4'),

        // File Uploads
        (new Column(
            (new Card(
                (new FileUpload('file'))->addClass('mb-3') .
                (new FileUpload('files'))->multiple()->addClass('mb-3') .
                (new FileUpload('small_file'))->size('sm')
            ))->header('File Uploads')
              ->footer($snippet("new FileUpload('file')"))
        ))->md(6)->addClass('mb-4')
    )
))->fluid();