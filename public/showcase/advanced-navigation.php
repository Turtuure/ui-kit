<?php

declare(strict_types=1);

use Archon\UIKit\Elements\Button\Button;
use Archon\UIKit\Navigation\Drawer;
use Archon\UIKit\Navigation\Stepper;
use Archon\UIKit\Showcase\Showcase;

/**
 * Advanced Navigation Showcase Page
 */

echo '<h2>Advanced Navigation</h2>';
echo '<p class="lead text-muted">Examples of Drawers (Offcanvas) and Steppers.</p>';

// --- Drawers (Offcanvas) ---

Showcase::example(
    'Standard Drawer (Offcanvas)',
    'A slide-in sidebar triggered by a button.',
    function () {
        echo (new Button('Open Drawer'))
            ->variant('primary')
            ->data('bs-toggle', 'offcanvas')
            ->data('bs-target', '#demoDrawer');

        echo (new Drawer('demoDrawer', 'Menu'))
            ->body('<p>Here is some navigation content...</p><ul><li>Home</li><li>Profile</li><li>Settings</li></ul>');
    },
    'echo (new Button(\'Open\'))->data(\'bs-toggle\', \'offcanvas\')...;
echo (new Drawer(\'demoDrawer\', \'Menu\'))->body(\'...\');'
);

Showcase::example(
    'Top Placement Drawer',
    'A drawer that slides down from the top.',
    function () {
        echo (new Button('Open Top Drawer'))
            ->variant('secondary')
            ->data('bs-toggle', 'offcanvas')
            ->data('bs-target', '#topDrawer');

        echo (new Drawer('topDrawer', 'Top Drawer'))
            ->placement('top')
            ->body('<p>This drawer is on the top!</p>');
    },
    '(new Drawer(\'topDrawer\'))->placement(\'top\')'
);

// --- Steppers ---

Showcase::example(
    'Horizontal Stepper',
    'A visual indicator for a multi-step process.',
    function () {
        echo new Stepper(['Cart', 'Shipping', 'Payment', 'Confirmation'], 2);
    },
    'new Stepper([\'Cart\', \'Shipping\', \'Payment\', \'Confirmation\'], 2)'
);

Showcase::example(
    'Vertical Stepper',
    'A vertical layout for steps, suitable for sidebars or lists.',
    function () {
        echo (new Stepper(['Step 1: Setup', 'Step 2: Details', 'Step 3: Review'], 3))->vertical();
    },
    '(new Stepper([...], 3))->vertical()'
);

