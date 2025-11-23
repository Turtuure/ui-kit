<?php

declare(strict_types=1);

namespace Archon\UIKit\Tests\Navigation;

use Archon\UIKit\Navigation\Nav;
use Archon\UIKit\Navigation\Navbar;
use PHPUnit\Framework\TestCase;

final class NavigationTest extends TestCase
{
    public function testNavRendersBasicList(): void
    {
        $nav = new Nav('<li>Item 1</li>', '<li>Item 2</li>');
        $html = $nav->render();
        $this->assertStringContainsString('<ul', $html);
        $this->assertStringContainsString('class="nav"', $html);
        $this->assertStringContainsString('<li>Item 1</li>', $html);
        $this->assertStringContainsString('<li>Item 2</li>', $html);
        $this->assertStringContainsString('</ul>', $html);
    }

    public function testNavTabs(): void
    {
        $nav = (new Nav())->tabs();
        $html = $nav->render();
        $this->assertStringContainsString('class="nav nav-tabs"', $html);
        $this->assertStringNotContainsString('nav-pills', $html);
    }

    public function testNavPills(): void
    {
        $nav = (new Nav())->pills();
        $html = $nav->render();
        $this->assertStringContainsString('class="nav nav-pills"', $html);
        $this->assertStringNotContainsString('nav-tabs', $html);
    }

    public function testNavFill(): void
    {
        $nav = (new Nav())->fill();
        $html = $nav->render();
        $this->assertStringContainsString('class="nav nav-fill"', $html);
    }

    public function testNavVertical(): void
    {
        $nav = (new Nav())->vertical();
        $html = $nav->render();
        $this->assertStringContainsString('class="flex-column nav"', $html); // Sorted alphabetically
    }

    public function testNavbarRendersWithBrand(): void
    {
        $navbar = new Navbar('My Brand');
        $html = $navbar->render();
        $this->assertStringContainsString('<a class="navbar-brand" href="/">My Brand</a>', $html);
        $this->assertStringContainsString('class="bg-light navbar navbar-expand-lg navbar-light"', $html);
        $this->assertStringContainsString('<button class="navbar-toggler"', $html);
        $this->assertStringContainsString('collapse navbar-collapse', $html);
    }

    public function testNavbarBgColor(): void
    {
        $navbar = (new Navbar('Brand'))->bgColor('dark');
        $html = $navbar->render();
        $this->assertStringContainsString('class="bg-dark navbar navbar-dark navbar-expand-lg"', $html);
        $this->assertStringNotContainsString('navbar-light', $html);
    }

    public function testNavbarExpandBreakpoint(): void
    {
        $navbar = (new Navbar('Brand'))->expand('sm');
        $html = $navbar->render();
        $this->assertStringContainsString('class="bg-light navbar navbar-expand-sm navbar-light"', $html);
        $this->assertStringContainsString('<button class="navbar-toggler"', $html); // Toggler should be present
        $this->assertStringContainsString('collapse navbar-collapse', $html);
    }

    public function testNavbarAlwaysExpanded(): void
    {
        $navbar = (new Navbar('Brand'))->expand(null);
        $html = $navbar->render();
        $this->assertStringNotContainsString('navbar-expand-', $html);
        $this->assertStringNotContainsString('navbar-toggler', $html); // No toggler when always expanded
        $this->assertStringNotContainsString('collapse navbar-collapse', $html); // No collapse div when always expanded
        $this->assertStringContainsString('<nav class="bg-light navbar navbar-light"><a class="navbar-brand" href="/">Brand</a>', $html); // Just brand and content
    }

    public function testNavbarWithContent(): void
    {
        $navContent = new Nav('<li class="nav-item"><a class="nav-link" href="#">Link</a></li>');
        $navbar = (new Navbar('Brand'))->add($navContent);
        $html = $navbar->render();
        $this->assertStringContainsString('<a class="navbar-brand" href="/">Brand</a>', $html);
        $this->assertStringContainsString('class="collapse navbar-collapse"', $html);
        $this->assertStringContainsString('<ul class="nav"><li class="nav-item"><a class="nav-link" href="#">Link</a></li></ul>', $html);
    }
}
