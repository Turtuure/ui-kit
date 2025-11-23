<?php

declare(strict_types=1);

namespace Archon\UIKit\Tests\DataDisplay;

use Archon\UIKit\DataDisplay\TreeView;
use PHPUnit\Framework\TestCase;

final class TreeViewTest extends TestCase
{
    public function testTreeViewRendersFlatList(): void
    {
        $tree = new TreeView(['Item 1', 'Item 2']);
        $html = $tree->render();
        
        $this->assertStringContainsString('class="tree-view"', $html);
        $this->assertStringContainsString('Item 1', $html);
        $this->assertStringContainsString('Item 2', $html);
        $this->assertStringContainsString('<i class="bi bi-file-earmark text-muted me-1"></i>', $html);
    }

    public function testTreeViewRendersNestedList(): void
    {
        $tree = new TreeView([
            'Folder 1' => [
                'Child 1',
                'Child 2'
            ]
        ]);
        $html = $tree->render();
        
        $this->assertStringContainsString('<details>', $html);
        $this->assertStringContainsString('<summary class="fw-bold cursor-pointer">Folder 1</summary>', $html);
        $this->assertStringContainsString('Child 1', $html);
        $this->assertStringContainsString('Child 2', $html);
    }

    public function testTreeViewOpenState(): void
    {
        $tree = (new TreeView(['Folder' => ['Item']]))->open();
        $html = $tree->render();
        
        $this->assertStringContainsString('<details open>', $html);
    }
}
