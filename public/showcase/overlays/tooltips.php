<?php

declare(strict_types=1);

use Archon\UIKit\DataDisplay\Card;
use Archon\UIKit\Elements\Button\Button;
use Archon\UIKit\Layout\Structure\Column;
use Archon\UIKit\Layout\Structure\Container;
use Archon\UIKit\Layout\Structure\Row;
use Archon\UIKit\Overlays\Tooltip;

echo '<h2>Tooltips</h2>';
echo '<p class="lead text-muted mb-4">Custom tooltips for displaying information on hover.</p>';

$snippet = function(string $code): string {
    return '<pre class="code-snippet m-0" style="max-height: 150px;"><code>' . htmlspecialchars($code) . '</code></pre>';
};

echo (new Container(
    new Row(
        (new Column(
            (new Card(
                (new Tooltip(
                    (new Button('Tooltip on top'))->render(),
                    'Tooltip on top'
                ))->placement('top')->addClass('d-inline-block me-2') .

                (new Tooltip(
                    (new Button('Tooltip on right'))->variant('secondary')->render(),
                    'Tooltip on right'
                ))->placement('right')->addClass('d-inline-block me-2')
            ))->header('Examples')
              ->footer($snippet("new Tooltip(...)->placement('top')"))
        ))->md(12)->addClass('mb-4')
    )
))->fluid();

?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>