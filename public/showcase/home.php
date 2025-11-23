<?php

declare(strict_types=1);

use Archon\UIKit\DataDisplay\Card;
use Archon\UIKit\Elements\Badge\Badge;
use Archon\UIKit\Elements\Button\Button;
use Archon\UIKit\Layout\Structure\Column;
use Archon\UIKit\Layout\Structure\Container;
use Archon\UIKit\Layout\Structure\Row;

echo (new Container(
    // Hero Section
    new Row(
        (new Column(
            '<div class="p-5 mb-4 bg-light rounded-3 border">
                <div class="container-fluid py-5">
                    <h1 class="display-5 fw-bold text-primary"><i class="bi bi-box-seam me-3"></i>Archon UI Kit</h1>
                    <p class="col-md-8 fs-4">A robust, server-side rendered PHP component library built on Bootstrap 5. Create beautiful, consistent interfaces with fluent PHP.</p>
                    ' . (new Button('Get Started'))->variant('primary')->size('lg')->setAttribute('href', '/?page=elements/buttons')->tag('a') . '
                    ' . (new Button('View Charts'))->variant('outline-secondary')->size('lg')->setAttribute('href', '/?page=data-viz/charts')->tag('a') . '
                </div>
            </div>'
        ))->md(12)->addClass('mb-4')
    ),

    // Quick Links / Dashboard Cards
    new Row(
        (new Column(
            (new Card(
                '<h5 class="card-title">Components</h5>
                <p class="card-text">Explore the core building blocks like Buttons, Badges, and Spinners.</p>
                ' . (new Button('Browse Elements'))->variant('primary')->setAttribute('href', '/?page=elements/buttons')->tag('a')
            ))->header('<i class="bi bi-puzzle me-2"></i> Elements')
        ))->md(4)->addClass('mb-4'),

        (new Column(
            (new Card(
                '<h5 class="card-title">Forms</h5>
                <p class="card-text">Powerful form controls including advanced inputs, selects, and validations.</p>
                ' . (new Button('View Forms'))->variant('success')->setAttribute('href', '/?page=forms/text-inputs')->tag('a')
            ))->header('<i class="bi bi-ui-checks me-2"></i> Forms')
        ))->md(4)->addClass('mb-4'),

        (new Column(
            (new Card(
                '<h5 class="card-title">Data Display</h5>
                <p class="card-text">Tables, Cards, and Charts to visualize your data effectively.</p>
                ' . (new Button('See Data Viz'))->variant('info')->textColor('white')->setAttribute('href', '/?page=data-viz/charts')->tag('a')
            ))->header('<i class="bi bi-graph-up me-2"></i> Data')
        ))->md(4)->addClass('mb-4')
    ),

    // Status / Info Row
    new Row(
        (new Column(
            (new Card(
                '<ul class="list-unstyled mb-0">
                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i> <strong>PHP 8.x</strong> Strict Typing</li>
                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i> <strong>Bootstrap 5.3</strong> Foundation</li>
                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i> <strong>No Build Step</strong> Required (Standard CSS/JS)</li>
                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i> <strong>Accessible</strong> by Default</li>
                </ul>'
            ))->header('System Status')->footer((new Badge('v1.0.0'))->variant('secondary')->pill() . ' Stable')
        ))->md(6)->addClass('mb-4'),

        (new Column(
            (new Card(
                '<p>The Archon UI Kit is designed to speed up development by providing fluent PHP wrappers for common UI patterns. It reduces context switching between PHP and HTML.</p>
                <p class="text-muted mb-0">Located in: <code>C:\Projects\archon\ui-kit</code></p>'
            ))->header('About')->footer('Archon Internal Project')
        ))->md(6)->addClass('mb-4')
    )
))->fluid();
