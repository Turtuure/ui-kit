<?php

declare(strict_types=1);

namespace Archon\UIKit\Tests\Elements;

use Archon\UIKit\Elements\Spinner\Spinner;
use PHPUnit\Framework\TestCase;

final class SpinnerTest extends TestCase
{
    public function testBorderSpinnerRendersCorrectly(): void
    {
        $spinner = new Spinner('border');
        $html = $spinner->render();
        
        $this->assertStringContainsString('<div', $html);
        $this->assertStringContainsString('role="status"', $html);
        $this->assertStringContainsString('class="spinner-border"', $html);
    }

    public function testGrowSpinnerRendersCorrectly(): void
    {
        $spinner = (new Spinner())->type('grow');
        $html = $spinner->render();
        
        $this->assertStringContainsString('<div', $html);
        $this->assertStringContainsString('role="status"', $html);
        $this->assertStringContainsString('class="spinner-grow"', $html);
    }

    public function testSpinnerVariantAndSize(): void
    {
        $spinner = (new Spinner('border'))
            ->variant('primary')
            ->size('sm');
        $html = $spinner->render();
        
        // Assert individual classes are present, regardless of order within the class attribute
        $this->assertStringContainsString('class="', $html);
        $this->assertStringContainsString('spinner-border', $html);
        $this->assertStringContainsString('spinner-border-sm', $html);
        $this->assertStringContainsString('text-primary', $html);
    }

    public function testSpinnerWithLabel(): void
    {
        $spinner = (new Spinner('border'))
            ->label('Loading...');
        $html = $spinner->render();
        
        $this->assertStringContainsString('<span class="visually-hidden">Loading...</span>', $html);
    }
}