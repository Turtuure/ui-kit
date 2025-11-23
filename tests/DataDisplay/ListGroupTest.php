<?php

declare(strict_types=1);

namespace Archon\UIKit\Tests\DataDisplay;

use Archon\UIKit\DataDisplay\Lists\ListGroup;
use Archon\UIKit\Elements\Badge\Badge;
use PHPUnit\Framework\TestCase;

final class ListGroupTest extends TestCase
{
    public function testListGroupRendersBasicItems(): void
    {
        $listGroup = new ListGroup(
            'An item',
            'A second item',
            'A third item'
        );
        $html = $listGroup->render();
        
        $this->assertStringContainsString('<ul', $html);
        $this->assertStringContainsString('class="list-group"', $html);
        $this->assertStringContainsString('<li class="list-group-item">An item</li>', $html);
        $this->assertStringContainsString('<li class="list-group-item">A second item</li>', $html);
        $this->assertStringContainsString('<li class="list-group-item">A third item</li>', $html);
    }

    public function testListGroupWithLinksAndActiveItem(): void
    {
        $listGroup = (new ListGroup())
            ->add('The current link', '#', true)
            ->add('A second link item', '#second');
        $html = $listGroup->render();

        // Assert the active linked item
        $this->assertStringContainsString('<a', $html);
        $this->assertStringContainsString('href="#"', $html);
        $this->assertStringContainsString('aria-current="true"', $html);
        $this->assertStringContainsString('class="', $html); // Check for class attribute existence
        $this->assertStringContainsString('list-group-item', $html);
        $this->assertStringContainsString('active', $html);
        $this->assertStringContainsString('list-group-item-action', $html);
        $this->assertStringContainsString('>The current link</a>', $html);

        // Assert the second linked item
        $this->assertStringContainsString('href="#second"', $html);
        $this->assertStringContainsString('>A second link item</a>', $html);
        $this->assertStringNotContainsString('aria-current="true" class="list-group-item list-group-item-action active"', $html); // ensure no duplicate active class
    }

    public function testListGroupWithNumberedItems(): void
    {
        $listGroup = (new ListGroup('First item', 'Second item'))
            ->numbered();
        $html = $listGroup->render();

        $this->assertStringContainsString('<ol class="list-group list-group-numbered">', $html);
        $this->assertStringContainsString('<li class="list-group-item">First item</li>', $html);
    }

    public function testListGroupWithBadge(): void
    {
        $badge = new Badge('14');
        $listGroup = (new ListGroup())
            ->add('A list item with a badge', null, false, false, $badge);
        $html = $listGroup->render();

        $this->assertStringContainsString('<li', $html);
        $this->assertStringContainsString('class="', $html); // Check for class attribute existence
        $this->assertStringContainsString('list-group-item', $html);
        $this->assertStringContainsString('d-flex', $html);
        $this->assertStringContainsString('justify-content-between', $html);
        $this->assertStringContainsString('align-items-start', $html);
        $this->assertStringContainsString('A list item with a badge', $html);
        $this->assertStringContainsString('<span class="ms-auto"><span class="badge text-bg-primary">14</span></span>', $html);
    }

    public function testListGroupFlush(): void
    {
        $listGroup = (new ListGroup('Item'))->flush();
        $this->assertStringContainsString('class="list-group list-group-flush"', $listGroup->render());
    }
}
