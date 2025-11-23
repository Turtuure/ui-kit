<?php

declare(strict_types=1);

use Archon\UIKit\Elements\Spinner\Spinner;
use Archon\UIKit\Showcase\Showcase;

/**
 * Elements Showcase Page
 */

echo '<h2>Elements</h2>';
echo '<p class="lead text-muted">Collection of small, reusable UI elements.</p>';

// --- Spinners ---

Showcase::example(
    'Border Spinners',
    'Standard border spinners with different colors and sizes.',
    function () {
        echo (new Spinner('border'))->variant('primary')->addClass('me-2');
        echo (new Spinner('border'))->variant('secondary')->addClass('me-2');
        echo (new Spinner('border'))->variant('success')->size('sm')->addClass('me-2');
        echo (new Spinner('border'))->variant('danger')->addClass('me-2');
        echo (new Spinner('border'))->variant('warning')->addClass('me-2');
        echo (new Spinner('border'))->variant('info')->addClass('me-2');
        echo (new Spinner('border'))->variant('light')->addClass('me-2 bg-dark p-2 rounded');
        echo (new Spinner('border'))->variant('dark')->addClass('me-2');
    },
    'new Spinner(\'border\')->variant(\'primary\');'
);

Showcase::example(
    'Grow Spinners',
    'A different style of loading spinner.',
    function () {
        echo (new Spinner('grow'))->variant('primary')->addClass('me-2');
        echo (new Spinner('grow'))->variant('secondary')->addClass('me-2');
        echo (new Spinner('grow'))->variant('success')->size('sm')->addClass('me-2');
        echo (new Spinner('grow'))->variant('dark')->addClass('me-2');
    },
    'new Spinner(\'grow\')->variant(\'primary\');'
);

Showcase::example(
    'Spinners with Text',
    'Spinners accompanied by text for better context.',
    function () {
        echo '<button class="btn btn-primary" type="button" disabled>';
        echo (new Spinner('border'))->size('sm')->addClass('me-1');
        echo 'Loading...';
        echo '</button>';
        echo ' <button class="btn btn-dark" type="button" disabled>';
        echo (new Spinner('grow'))->size('sm')->variant('light')->addClass('me-1');
        echo 'Loading...';
        echo '</button>';
    },
    '&lt;button class="btn btn-primary" disabled&gt;
    &lt;?= (new Spinner(\'border\'))->size(\'sm\'); ?&gt;
    Loading...
&lt;/button&gt;'
);
