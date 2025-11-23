<?php

declare(strict_types=1);

use Archon\UIKit\DataDisplay\Card;
use Archon\UIKit\Inputs\ChecksAndRadios\Checkbox;
use Archon\UIKit\Inputs\ChecksAndRadios\Radio;
use Archon\UIKit\Layout\Structure\Column;
use Archon\UIKit\Layout\Structure\Container;
use Archon\UIKit\Layout\Structure\Row;

echo '<h2>Checks & Radios</h2>';
echo '<p class="lead text-muted mb-4">Create consistent cross-browser and cross-device checkboxes and radios.</p>';

$snippet = function(string $code): string {
    return '<pre class="code-snippet m-0" style="max-height: 150px;"><code>' . htmlspecialchars($code) . '</code></pre>';
};

echo (new Container(
    new Row(
        // Checkboxes
        (new Column(
            (new Card(
                (new Checkbox('terms', 'Accept Terms and Conditions')) .
                (new Checkbox('newsletter', 'Subscribe to newsletter'))->checked() .
                (new Checkbox('remember', 'Remember me'))->inline() .
                (new Checkbox('disabled_check', 'Disabled checkbox'))->disabled()
            ))->header('Checkboxes')
              ->footer($snippet("new Checkbox('terms', 'Label')"))
        ))->md(6)->addClass('mb-4'),

        // Radios
        (new Column(
            (new Card(
                (new Radio('gender', 'male', 'Male')) .
                (new Radio('gender', 'female', 'Female'))->checked() .
                (new Radio('gender', 'other', 'Other'))->inline() .
                (new Radio('options', 'disabled', 'Disabled'))->disabled()
            ))->header('Radio Buttons')
              ->footer($snippet("new Radio('name', 'value', 'Label')"))
        ))->md(6)->addClass('mb-4')
    )
))->fluid();