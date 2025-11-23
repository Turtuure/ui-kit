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
        $this->assertStringContainsString('class="btn btn-primary"', $button->render());
    }

    public function testButtonVariantCanBeChanged(): void
    {
        $button = (new Button('Test'))->variant('success');
        $this->assertStringContainsString('class="btn btn-success"', $button->render());
    }

    public function testButtonOutlineVariant(): void
    {
        $button = (new Button('Test'))->variant('danger')->outline();
        $this->assertStringContainsString('class="btn btn-outline-danger"', $button->render());
    }

    public function testButtonSize(): void
    {
        $button = (new Button('Test'))->size('lg');
        $this->assertStringContainsString('class="btn btn-primary btn-lg"', $button->render());
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
        $this->assertStringContainsString('class="btn btn-primary custom-class-1 custom-class-2"', $button->render());
    }

    public function testRemovingClass(): void
    {
        $button = (new Button('Test'))->addClass('custom-class')->removeClass('custom-class');
        $this->assertStringContainsString('class="btn btn-primary"', $button->render());
        $this->assertStringNotContainsString('custom-class', $button->render());
    }
}
