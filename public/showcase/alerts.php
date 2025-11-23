<?php

declare(strict_types=1);

use Archon\UIKit\Feedback\Alert;
use Archon\UIKit\Showcase\Showcase;

/**
 * Alerts Showcase Page
 */

echo '<h2>Alerts</h2>';
echo '<p class="lead text-muted">Examples of various alert types and dismissible functionality.</p>';

Showcase::example(
    'Primary Alert',
    'A basic primary-themed alert.',
    function () {
        echo new Alert('A simple primary alert—check it out!');
    },
    'new Alert(\'A simple primary alert—check it out!\')'
);

Showcase::example(
    'Success Dismissible Alert',
    'A success-themed alert that can be dismissed.',
    function () {
        echo (new Alert('Well done! You successfully read this important alert message.'))
            ->variant('success')
            ->dismissible();
    },
    'new Alert(\'Well done! You successfully read this important alert message.\')
    ->variant(\'success\')
    ->dismissible()'
);

Showcase::example(
    'Danger Alert with Custom Text',
    'A danger alert with custom content.',
    function () {
        echo (new Alert('<strong>Oh snap!</strong> Change a few things up and try submitting again.'))
            ->variant('danger');
    },
    'new Alert(\'<strong>Oh snap!</strong> Change a few things up and try submitting again.\')
    ->variant(\'danger\')'
);

Showcase::example(
    'Warning Dismissible Alert',
    'A warning alert that can be dismissed.',
    function () {
        echo (new Alert('Holy guacamole! You should check in on some of those fields below.'))
            ->variant('warning')
            ->dismissible();
    },
    'new Alert(\'Holy guacamole! You should check in on some of those fields below.\')
    ->variant(\'warning\')
    ->dismissible()'
);

