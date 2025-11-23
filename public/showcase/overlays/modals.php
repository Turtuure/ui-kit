<?php

declare(strict_types=1);

use Archon\UIKit\DataDisplay\Card;
use Archon\UIKit\Elements\Button\Button;
use Archon\UIKit\Layout\Structure\Column;
use Archon\UIKit\Layout\Structure\Container;
use Archon\UIKit\Layout\Structure\Row;
use Archon\UIKit\Overlays\Modal;

echo '<h2>Modals</h2>';
echo '<p class="lead text-muted mb-4">Add dialogs to your site for lightboxes, user notifications, or completely custom content.</p>';

$snippet = function(string $code): string {
    return '<pre class="code-snippet m-0" style="max-height: 150px;"><code>' . htmlspecialchars($code) . '</code></pre>';
};

echo (new Container(
    new Row(
        // Standard
        (new Column(
            (new Card(
                (new Button('Launch Demo Modal'))
                    ->variant('primary')
                    ->data('bs-toggle', 'modal')
                    ->data('bs-target', '#demoModal') .
                
                (new Modal('demoModal', 'Modal Title'))
                    ->body('<p>Woohoo, you\'re reading this text in a modal!</p>')
                    ->footer(
                        (new Button('Close'))->variant('secondary')->data('bs-dismiss', 'modal') .
                        (new Button('Save changes'))->variant('primary')->addClass('ms-2')
                    )
            ))->header('Standard Modal')
              ->footer($snippet("new Modal('id', 'Title')->body(...)"))
        ))->md(6)->addClass('mb-4'),

        // Static Backdrop
        (new Column(
            (new Card(
                (new Button('Launch Static Modal'))
                    ->variant('secondary')
                    ->data('bs-toggle', 'modal')
                    ->data('bs-target', '#staticModal') .

                (new Modal('staticModal', 'Static Backdrop'))
                    ->staticBackdrop()
                    ->centered()
                    ->body('<p>I will not close if you click outside me. Don\'t even try.</p>')
                    ->footer((new Button('Understood'))->variant('primary')->data('bs-dismiss', 'modal'))
            ))->header('Static Backdrop')
              ->footer($snippet("new Modal(...)->staticBackdrop()"))
        ))->md(6)->addClass('mb-4')
    )
))->fluid();