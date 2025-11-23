<?php

declare(strict_types=1);

use Archon\UIKit\Elements\Button\Button;
use Archon\UIKit\Overlays\Modal;
use Archon\UIKit\Overlays\Popover;
use Archon\UIKit\Overlays\Toast;
use Archon\UIKit\Overlays\Tooltip;
use Archon\UIKit\Showcase\Showcase;

/**
 * Overlays Showcase Page
 */

echo '<h2>Overlays</h2>';
echo '<p class="lead text-muted">Examples of Modals, Tooltips, Popovers, and Toasts.</p>';

// --- Modals ---

Showcase::example(
    'Standard Modal',
    'A basic modal dialog triggered by a button.',
    function () {
        // Trigger Button
        echo (new Button('Launch Demo Modal'))
            ->variant('primary')
            ->data('bs-toggle', 'modal')
            ->data('bs-target', '#demoModal');

        // Modal Component
        echo (new Modal('demoModal', 'Modal Title'))
            ->body('<p>Woohoo, you\'re reading this text in a modal!</p>')
            ->footer(
                (new Button('Close'))->variant('secondary')->data('bs-dismiss', 'modal') .
                (new Button('Save changes'))->variant('primary')->addClass('ms-2')
            );
    },
    'echo (new Button(\'Launch\'))
    ->data(\'bs-toggle\', \'modal\')
    ->data(\'bs-target\', \'#demoModal\');

echo (new Modal(\'demoModal\', \'Title\'))
    ->body(\'...\')
    ->footer(\'...\');'
);

Showcase::example(
    'Static Backdrop Modal',
    'A modal that will not close when clicking outside of it.',
    function () {
        echo (new Button('Launch Static Modal'))
            ->variant('secondary')
            ->data('bs-toggle', 'modal')
            ->data('bs-target', '#staticModal');

        echo (new Modal('staticModal', 'Static Backdrop'))
            ->staticBackdrop()
            ->centered()
            ->body('<p>I will not close if you click outside me. Don\'t even try.</p>')
            ->footer((new Button('Understood'))->variant('primary')->data('bs-dismiss', 'modal'));
    },
    '(new Modal(\'staticModal\', \'Title\'))
    ->staticBackdrop()
    ->centered()'
);

// --- Tooltips ---

Showcase::example(
    'Tooltips',
    'Hover over the buttons to see tooltips.',
    function () {
        echo (new Tooltip(
            (new Button('Tooltip on top'))->render(),
            'Tooltip on top'
        ))->placement('top')->addClass('d-inline-block me-2');

        echo (new Tooltip(
            (new Button('Tooltip on right'))->variant('secondary')->render(),
            'Tooltip on right'
        ))->placement('right')->addClass('d-inline-block me-2');
    },
    'new Tooltip((new Button(\'...\'))->render(), \'Message\')
    ->placement(\'top\')'
);

// --- Popovers ---

Showcase::example(
    'Popovers',
    'Click the buttons to toggle popovers.',
    function () {
        echo (new Popover(
            (new Button('Popover on top'))->render(),
            'Popover Title',
            'And here\'s some amazing content. It\'s very engaging. Right?'
        ))->placement('top')->addClass('d-inline-block me-2');

        echo (new Popover(
            (new Button('Popover on right'))->variant('info')->render(),
            'Another Popover',
            'This popover is on the right and has different content.'
        ))->placement('right')->addClass('d-inline-block me-2');
    },
    'new Popover((new Button(\'...\'))->render(), \'Title\', \'Content\')
    ->placement(\'top\')'
);

// --- Toasts ---

Showcase::example(
    'Live Toast',
    'Click the button to show a toast message.',
    function () {
        echo (new Button('Show Live Toast'))
            ->variant('success')
            ->id('liveToastBtn');

        // Container for toasts
        echo '<div class="toast-container position-fixed bottom-0 end-0 p-3">';
        echo (new Toast('Live Toast Title', 'Hello, world! This is a toast message.'))
            ->id('liveToast')
            ->time('11 mins ago');
        echo '</div>';
    },
    '(new Toast(\'Live Toast Title\', \'Body\'))
    ->id(\'liveToast\')
    ->time(\'Just now\')'
);

?>

<!-- Initialize Tooltips and Toasts -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize Tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })

        // Initialize Popovers
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })

        // Initialize Live Toast Demo
        const toastTrigger = document.getElementById('liveToastBtn')
        const toastLiveExample = document.getElementById('liveToast')
        if (toastTrigger) {
            toastTrigger.addEventListener('click', () => {
                const toast = new bootstrap.Toast(toastLiveExample)
                toast.show()
            })
        }
    });
</script>