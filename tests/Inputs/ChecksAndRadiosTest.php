<?php

declare(strict_types=1);

namespace Archon\UIKit\Tests\Inputs;

use Archon\UIKit\Inputs\ChecksAndRadios\Checkbox;
use Archon\UIKit\Inputs\ChecksAndRadios\Radio;
use PHPUnit\Framework\TestCase;

final class ChecksAndRadiosTest extends TestCase
{
    public function testCheckboxRendersCorrectly(): void
    {
        $checkbox = new Checkbox('accept_terms', 'I accept the terms');
        $html = $checkbox->render();
        
        $this->assertStringContainsString('<div class="form-check">', $html);
        $this->assertStringContainsString('name="accept_terms"', $html);
        $this->assertStringContainsString('type="checkbox"', $html);
        $this->assertStringContainsString('value="1"', $html);
        $this->assertStringContainsString('class="form-check-input"', $html);
        $this->assertStringContainsString('<label class="form-check-label" for="checkbox', $html); // ID will be unique
        $this->assertStringContainsString('>I accept the terms</label>', $html);
    }

    public function testCheckboxCheckedAndDisabled(): void
    {
        $checkbox = (new Checkbox('newsletter', 'Subscribe'))
            ->checked()
            ->disabled();
        $html = $checkbox->render();
        
        $this->assertStringContainsString('checked="checked"', $html);
        $this->assertStringContainsString('disabled="disabled"', $html);
    }

    public function testCheckboxInline(): void
    {
        $checkbox = (new Checkbox('option1', 'Option 1'))->inline();
        $this->assertStringContainsString('class="form-check form-check-inline"', $checkbox->render());
    }

    public function testRadioRendersCorrectly(): void
    {
        $radio = new Radio('gender', 'male', 'Male');
        $html = $radio->render();

        $this->assertStringContainsString('<div class="form-check">', $html);
        $this->assertStringContainsString('name="gender"', $html);
        $this->assertStringContainsString('type="radio"', $html);
        $this->assertStringContainsString('value="male"', $html);
        $this->assertStringContainsString('class="form-check-input"', $html);
        $this->assertStringContainsString('<label class="form-check-label" for="radio', $html); // ID will be unique
        $this->assertStringContainsString('>Male</label>', $html);
    }

    public function testRadioCheckedAndDisabled(): void
    {
        $radio = (new Radio('payment', 'credit', 'Credit Card'))
            ->checked()
            ->disabled();
        $html = $radio->render();
        
        $this->assertStringContainsString('checked="checked"', $html);
        $this->assertStringContainsString('disabled="disabled"', $html);
    }

    public function testRadioInline(): void
    {
        $radio = (new Radio('options', 'yes', 'Yes'))->inline();
        $this->assertStringContainsString('class="form-check form-check-inline"', $radio->render());
    }
}
