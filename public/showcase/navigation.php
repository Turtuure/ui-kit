<?php

declare(strict_types=1);

use Archon\UIKit\Navigation\Breadcrumb;
use Archon\UIKit\Navigation\Nav;
use Archon\UIKit\Navigation\Navbar;
use Archon\UIKit\Navigation\Pagination;
use Archon\UIKit\Showcase\Showcase;

/**
 * Navigation Showcase Page
 */

echo '<h2>Navigation</h2>';
echo '<p class="lead text-muted">Examples of basic navigation, navbars, breadcrumbs, and pagination.</p>';

Showcase::example(
    'Basic Nav Links',
    'A simple list of navigation links.',
    function () {
        echo new Nav(
            '<li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Active</a></li>',
            '<li class="nav-item"><a class="nav-link" href="#">Link</a></li>',
            '<li class="nav-item"><a class="nav-link" href="#">Link</a></li>',
            '<li class="nav-item"><a class="nav-link disabled" aria-disabled="true">Disabled</a></li>'
        );
    },
    'new Nav(
    \'<li> class="nav-item"\'>' . '\'<a class="nav-link active" aria-current="page" href="#">Active</a></li>\',
    // ... other items
)'
);

Showcase::example(
    'Nav Tabs',
    'Navigation rendered as tabs.',
    function () {
        echo (new Nav(
            '<li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Active</a></li>',
            '<li class="nav-item"><a class="nav-link" href="#">Link</a></li>',
            '<li class="nav-item"><a class="nav-link" href="#">Link</a></li>'
        ))->tabs();
    },
    '(new Nav(...))->tabs()'
);

Showcase::example(
    'Nav Pills (Fill)',
    'Navigation rendered as pills, filling the available width.',
    function () {
        echo (new Nav(
            '<li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Active</a></li>',
            '<li class="nav-item"><a class="nav-link" href="#">Link</a></li>',
            '<li class="nav-item"><a class="nav-link" href="#">Link</a></li>'
        ))->pills()->fill();
    },
    '(new Nav(...))->pills()->fill()'
);

Showcase::example(
    'Vertical Nav Pills',
    'Navigation rendered as vertical pills.',
    function () {
        echo (new Nav(
            '<li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Active</a></li>',
            '<li class="nav-item"><a class="nav-link" href="#">Link</a></li>',
            '<li class="nav-item"><a class="nav-link" href="#">Link</a></li>'
        ))->pills()->vertical();
    },
    '(new Nav(...))->pills()->vertical()'
);

Showcase::example(
    'Basic Navbar',
    'A responsive navbar with a brand and navigation links.',
    function () {
        $navItems = new Nav(
            '<li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Home</a></li>',
            '<li class="nav-item"><a class="nav-link" href="#">Features</a></li>',
            '<li class="nav-item"><a class="nav-link" href="#">Pricing</a></li>'
        );
        echo (new Navbar('Archon Kit'))
            ->add($navItems);
    },
    '$navItems = new Nav(...); newNavbar(\'Archon Kit\')->add($navItems)'
);

Showcase::example(
    'Dark Navbar with Custom Background',
    'A dark-themed navbar with a custom background color and smaller expand breakpoint.',
    function () {
        $navItems = new Nav(
            '<li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Home</a></li>',
            '<li class="nav-item"><a class="nav-link" href="#">Features</a></li>'
        );
        echo (new Navbar('<i class="bi bi-stars"></i> Custom Brand'))
            ->bgColor('primary') // Using our custom primary color token
            ->expand('md')
            ->add($navItems);
    },
    'new Navbar(\'<i class="bi bi-stars"></i> Custom Brand\')
    ->bgColor(\'primary\')
    ->expand(\'md\')
    ->add($navItems)'
);

Showcase::example(
    'Breadcrumb',
    'Indicate the current page location within a navigational hierarchy.',
    function () {
        echo new Breadcrumb([
            'Home' => '#',
            'Library' => '#',
            'Data' => null // Active item (no link)
        ]);
    },
    'new Breadcrumb([
    \'Home\' => \'#\',
    \'Library\' => \'#\',
    \'Data\' => null
])'
);

Showcase::example(
    'Pagination',
    'A set of links for page navigation.',
    function () {
        echo new Pagination(5, 2, '#page-{page}');
        echo (new Pagination(3, 1))->size('lg')->addClass('mt-3');
        echo (new Pagination(3, 1))->size('sm')->addClass('mt-3');
    },
    'new Pagination(5, 2, \'#page-{page}\');
(new Pagination(3, 1))->size(\'lg\');'
);