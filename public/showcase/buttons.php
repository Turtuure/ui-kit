<?php

declare(strict_types=1);

use Archon\UIKit\Elements\Button\Button;
use Archon\UIKit\Showcase\Showcase;

/**
 * Buttons Showcase Page
 */

echo '<h2>Buttons</h2>';
echo '<p class="lead text-muted">Basic button examples demonstrating variants, sizes, and outline styles.</p>';

Showcase::example(
    'Default Button',
    'A standard primary button.',
    function () {
        echo (new Button('Primary Button'));
    },
    'new Button(\'Primary Button\')'
);

Showcase::example(
    'Secondary Outline Button',
    'A secondary button with an outline style.',
    function () {
        echo (new Button('Secondary Outline'))
            ->variant('secondary')
            ->outline();
    },
    'new Button(\'Secondary Outline\')->variant(\'secondary\')->outline()'
);

Showcase::example(
    'Large Success Button',
    'A large success-themed button.',
    function () {
        echo (new Button('Large Success'))
            ->variant('success')
            ->size('lg');
    },
    'new Button(\'Large Success\')->variant(\'success\')->size(\'lg\')'
);

Showcase::example(
    'Small Danger Button',
    'A small danger-themed button.',
    function () {
        echo (new Button('Small Danger'))
            ->variant('danger')
            ->size('sm');
    },
    'new Button(\'Small Danger\')->variant(\'danger\')->size(\'sm\')'
);
