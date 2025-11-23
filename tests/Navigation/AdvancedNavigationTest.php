<?php

declare(strict_types=1);

namespace Archon\UIKit\Tests\Navigation;

use Archon\UIKit\Navigation\Drawer;
use Archon\UIKit\Navigation\Stepper;
use PHPUnit\Framework\TestCase;

final class AdvancedNavigationTest extends TestCase
{
    public function testDrawerRendersCorrectly(): void
    {
        $drawer = (new Drawer('myDrawer', 'Drawer Title'))
            ->body('<p>Drawer content</p>');
        
        $html = $drawer->render();
        $this->assertStringContainsString('id="myDrawer"', $html);
        $this->assertStringContainsString('class="offcanvas offcanvas-start"', $html);
        $this->assertStringContainsString('Drawer Title', $html);
        $this->assertStringContainsString('<p>Drawer content</p>', $html);
    }

    public function testDrawerPlacement(): void
    {
        $drawer = (new Drawer('topDrawer'))->placement('top');
        $html = $drawer->render();
        $this->assertStringContainsString('class="offcanvas offcanvas-top"', $html);
        $this->assertStringNotContainsString('offcanvas-start', $html);
    }

    public function testDrawerOptions(): void
    {
        $drawer = (new Drawer('optDrawer'))
            ->backdrop(false)
            ->scroll(true);
        
        $html = $drawer->render();
        $this->assertStringContainsString('data-bs-backdrop="false"', $html);
        $this->assertStringContainsString('data-bs-scroll="true"', $html);
    }

    public function testStepperRendersCorrectly(): void
    {
        $stepper = new Stepper(['Step 1', 'Step 2', 'Step 3'], 2); // Step 2 active
        $html = $stepper->render();
        
        $this->assertStringContainsString('Step 1', $html);
        $this->assertStringContainsString('Step 2', $html);
        $this->assertStringContainsString('Step 3', $html);
        
        // Step 1 should be completed (check circle icon)
        $this->assertStringContainsString('bi-check-circle-fill', $html);
        // Step 2 should be active (primary badge)
        $this->assertStringContainsString('bg-primary', $html);
        // Step 3 should be pending (secondary badge)
        $this->assertStringContainsString('bg-secondary', $html);
    }

    public function testStepperVertical(): void
    {
        $stepper = (new Stepper(['Step 1']))->vertical();
        $html = $stepper->render();
        $this->assertStringContainsString('flex-column', $html);
        $this->assertStringNotContainsString('flex-row', $html);
    }
}
