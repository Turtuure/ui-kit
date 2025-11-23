<?php

declare(strict_types=1);

namespace Archon\UIKit\Tests\Navigation;

use Archon\UIKit\Navigation\Breadcrumb;
use Archon\UIKit\Navigation\Pagination;
use PHPUnit\Framework\TestCase;

final class BreadcrumbPaginationTest extends TestCase
{
    public function testBreadcrumbRendersCorrectly(): void
    {
        $breadcrumb = new Breadcrumb([
            'Home' => '/',
            'Library' => '/library',
            'Data' => null // Active
        ]);
        
        $html = $breadcrumb->render();
        $this->assertStringContainsString('aria-label="breadcrumb"', $html);
        $this->assertStringContainsString('<li class="breadcrumb-item"><a href="/">Home</a></li>', $html);
        $this->assertStringContainsString('<li class="breadcrumb-item active" aria-current="page">Data</li>', $html);
    }

    public function testPaginationRendersCorrectly(): void
    {
        $pagination = new Pagination(3, 1); // 3 pages, current page 1
        $html = $pagination->render();
        
        $this->assertStringContainsString('aria-label="Page navigation"', $html);
        $this->assertStringContainsString('class="pagination"', $html);
        // Previous button disabled
        $this->assertStringContainsString('<li class="page-item disabled">', $html);
        // Page 1 active
        $this->assertStringContainsString('<li class="page-item active">', $html);
        // Page 2 link
        $this->assertStringContainsString('href="?page=2"', $html);
    }

    public function testPaginationSize(): void
    {
        $pagination = (new Pagination(5))->size('lg');
        $this->assertStringContainsString('pagination-lg', $pagination->render());
    }
}
