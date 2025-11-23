<?php

declare(strict_types=1);

namespace Archon\UIKit\Tests\Overlays;

use Archon\UIKit\Overlays\Modal;
use Archon\UIKit\Overlays\Toast;
use Archon\UIKit\Overlays\Tooltip;
use Archon\UIKit\Overlays\Popover;
use PHPUnit\Framework\TestCase;

final class OverlaysTest extends TestCase
{
    public function testModalRendersCorrectly(): void
    {
        $modal = (new Modal('myModal', 'Modal Title'))
            ->body('<p>Modal content</p>')
            ->footer('<button>Close</button>');
        
        $html = $modal->render();
        $this->assertStringContainsString('id="myModal"', $html);
        $this->assertStringContainsString('class="fade modal"', $html); // Sorted attributes
        $this->assertStringContainsString('Modal Title', $html);
        $this->assertStringContainsString('<p>Modal content</p>', $html);
        $this->assertStringContainsString('<div class="modal-footer"><button>Close</button></div>', $html);
    }

    public function testModalStaticBackdrop(): void
    {
        $modal = (new Modal('staticModal', 'Title'))->staticBackdrop();
        $html = $modal->render();
        $this->assertStringContainsString('data-bs-backdrop="static"', $html);
        $this->assertStringContainsString('data-bs-keyboard="false"', $html);
    }

    public function testModalCenteredAndSize(): void
    {
        $modal = (new Modal('centerModal', 'Title'))
            ->centered()
            ->size('lg');
        
        $html = $modal->render();
        $this->assertStringContainsString('modal-dialog-centered', $html);
        $this->assertStringContainsString('modal-lg', $html);
    }

    public function testTooltipRendersCorrectly(): void
    {
        $tooltip = new Tooltip('Hover me', 'Tooltip Message');
        $html = $tooltip->render();
        
        $this->assertStringContainsString('data-bs-toggle="tooltip"', $html);
        $this->assertStringContainsString('data-bs-title="Tooltip Message"', $html);
        $this->assertStringContainsString('Hover me', $html);
        $this->assertStringContainsString('<span', $html); // Default tag
    }

    public function testTooltipPlacementAndTag(): void
    {
        $tooltip = (new Tooltip('Button', 'Msg'))
            ->placement('bottom')
            ->tag('button');
        
        $html = $tooltip->render();
        $this->assertStringContainsString('data-bs-placement="bottom"', $html);
        $this->assertStringContainsString('<button', $html);
    }

    public function testToastRendersCorrectly(): void
    {
        $toast = (new Toast('Toast Header', 'Toast Body'))
            ->time('just now');
        
        $html = $toast->render();
        $this->assertStringContainsString('class="toast"', $html);
        $this->assertStringContainsString('Toast Header', $html);
        $this->assertStringContainsString('Toast Body', $html);
        $this->assertStringContainsString('<small>just now</small>', $html);
    }

    public function testToastOptions(): void
    {
        $toast = (new Toast('Header', 'Body'))
            ->autohide(false)
            ->delay(10000);
        
        $html = $toast->render();
        $this->assertStringContainsString('data-bs-autohide="false"', $html);
        $this->assertStringContainsString('data-bs-delay="10000"', $html);
    }

    public function testPopoverRendersCorrectly(): void
    {
        $popover = new Popover('Click me', 'Popover Title', 'And here\'s some amazing content. It\'s very engaging. Right?');
        $html = $popover->render();

        $this->assertStringContainsString('data-bs-toggle="popover"', $html);
        $this->assertStringContainsString('data-bs-title="Popover Title"', $html);
        $this->assertStringContainsString('data-bs-content="And here&#039;s some amazing content. It&#039;s very engaging. Right?"', $html);
        $this->assertStringContainsString('Click me', $html);
        $this->assertStringContainsString('<span', $html); // Default tag is now span
    }

    public function testPopoverPlacementAndTag(): void
    {
        $popover = (new Popover('Link', 'Link Popover', 'Content'))
            ->placement('left')
            ->tag('a')
            ->setAttribute('href', '#');
        
        $html = $popover->render();
        $this->assertStringContainsString('data-bs-placement="left"', $html);
        $this->assertStringContainsString('<a', $html);
        $this->assertStringContainsString('href="#"', $html);
    }
}