<?php

declare(strict_types=1);

namespace Archon\UIKit\Tests\Layout;

use Archon\UIKit\Layout\Structure\Column;
use Archon\UIKit\Layout\Structure\Container;
use Archon\UIKit\Layout\Structure\Row;
use PHPUnit\Framework\TestCase;

final class StructureTest extends TestCase
{
    public function testContainerRendersCorrectly(): void
    {
        $container = new Container('Content');
        $this->assertStringContainsString('<div class="container">Content</div>', $container->render());
    }

    public function testContainerFluid(): void
    {
        $container = (new Container('Content'))->fluid();
        $this->assertStringContainsString('<div class="container-fluid">Content</div>', $container->render());
    }

    public function testRowRendersCorrectly(): void
    {
        $row = new Row('Content');
        $this->assertStringContainsString('<div class="row">Content</div>', $row->render());
    }

    public function testRowWithGutter(): void
    {
        $row = (new Row('Content'))->gutter(3);
        $html = $row->render();
        $this->assertStringContainsString('class="', $html);
        $this->assertStringContainsString('row', $html);
        $this->assertStringContainsString('g-3', $html);
    }

    public function testColumnDefault(): void
    {
        $col = new Column('Content');
        $this->assertStringContainsString('<div class="col">Content</div>', $col->render());
    }

    public function testColumnBreakpoints(): void
    {
        $col = (new Column('Content'))
            ->xs(12)
            ->md(6)
            ->lg(4);
        
        $html = $col->render();
        $this->assertStringContainsString('col-12', $html);
        $this->assertStringContainsString('col-md-6', $html);
        $this->assertStringContainsString('col-lg-4', $html);
        $this->assertStringNotContainsString('class="col"', $html); // Should replace default 'col'
    }

    public function testNestedLayout(): void
    {
        $layout = new Container(
            new Row(
                (new Column('Left'))->md(6),
                (new Column('Right'))->md(6)
            )
        );

        $html = $layout->render();
        $this->assertStringContainsString('container', $html);
        $this->assertStringContainsString('row', $html);
        $this->assertStringContainsString('col-md-6', $html);
        $this->assertStringContainsString('Left', $html);
        $this->assertStringContainsString('Right', $html);
    }
}