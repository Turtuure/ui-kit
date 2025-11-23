<?php

declare(strict_types=1);

namespace Archon\UIKit\Tests\Elements\Button;

use Archon\UIKit\Elements\Button\Button;
use PHPUnit\Framework\TestCase;

final class ButtonTest extends TestCase
{
    public function testButtonRendersWithCorrectLabel(): void
    {
        $button = new Button('Click Me');
        $this->assertStringContainsString('>Click Me</button>', $button->render());
    }

    public function testButtonHasDefaultClasses(): void
    {
        $button = new Button('Test');
        $html = $button->render();
        $this->assertStringContainsString('class="', $html);
        $this->assertStringContainsString('btn', $html);
        $this->assertStringContainsString('btn-primary', $html);
    }

    public function testButtonVariantCanBeChanged(): void
    {
        $button = (new Button('Test'))->variant('success');
        $html = $button->render();
        $this->assertStringContainsString('btn-success', $html);
        $this->assertStringNotContainsString('btn-primary', $html);
    }

    public function testButtonOutlineVariant(): void
    {
        $button = (new Button('Test'))->variant('danger')->outline();
        $html = $button->render();
        $this->assertStringContainsString('btn-outline-danger', $html);
        $this->assertStringNotContainsString('btn-danger', $html);
    }

    public function testButtonSize(): void
    {
        $button = (new Button('Test'))->size('lg');
        $html = $button->render();
        $this->assertStringContainsString('btn-lg', $html);
        $this->assertStringContainsString('btn-primary', $html);
    }

    public function testButtonType(): void
    {
        $button = (new Button('Submit'))->type('submit');
        $this->assertStringContainsString('type="submit"', $button->render());
    }

    public function testButtonCustomAttribute(): void
    {
        $button = (new Button('Test'))->setAttribute('data-test', 'value');
        $this->assertStringContainsString('data-test="value"', $button->render());
    }

    public function testButtonDataAttribute(): void
    {
        $button = (new Button('Test'))->data('toggle', 'modal');
        $this->assertStringContainsString('data-toggle="modal"', $button->render());
    }

    public function testAddingMultipleClasses(): void
    {
        $button = (new Button('Test'))->addClass('custom-class-1 custom-class-2');
        $html = $button->render();
        $this->assertStringContainsString('custom-class-1', $html);
        $this->assertStringContainsString('custom-class-2', $html);
    }

    public function testRemovingClass(): void
    {
        $button = (new Button('Test'))->addClass('custom-class')->removeClass('custom-class');
        $this->assertStringNotContainsString('custom-class', $button->render());
    }
}