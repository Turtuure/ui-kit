<?php

declare(strict_types=1);

use Archon\UIKit\DataDisplay\Card;
use Archon\UIKit\Elements\Button\Button;
use Archon\UIKit\Layout\Structure\Column;
use Archon\UIKit\Layout\Structure\Container;
use Archon\UIKit\Layout\Structure\Row;
use Archon\UIKit\Overlays\Popover;

echo '<h2>Popovers</h2>';
echo '<p class="lead text-muted mb-4">Documentation and examples for adding Bootstrap popovers.</p>';

$snippet = function(string $code): string {
    return '<pre class="code-snippet m-0" style="max-height: 150px;"><code>' . htmlspecialchars($code) . '</code></pre>';
};

echo (new Container(
    new Row(
        (new Column(
            (new Card(
                (new Popover(
                    (new Button('Popover on top'))->render(),
                    'Popover Title',
                    'And here\'s some amazing content. It\'s very engaging. Right?'
                ))->placement('top')->addClass('d-inline-block me-2') . 

                (new Popover(
                    (new Button('Popover on right'))->variant('info')->render(),
                    'Another Popover',
                    'This popover is on the right and has different content.'
                ))->placement('right')->addClass('d-inline-block me-2') 
            ))->header('Examples')
              ->footer($snippet("new Popover(...)->placement('right')"))
        ))->md(12)->addClass('mb-4')
    )
))->fluid();

?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
    });
</script>