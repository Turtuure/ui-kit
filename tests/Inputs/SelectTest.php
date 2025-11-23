<?php

declare(strict_types=1);

namespace Archon\UIKit\Tests\Inputs;

use Archon\UIKit\Inputs\Selects\Select;
use PHPUnit\Framework\TestCase;

final class SelectTest extends TestCase
{
    public function testSelectRendersWithOptions(): void
    {
        $select = new Select('country', [
            'us' => 'United States',
            'ca' => 'Canada',
        ]);
        $html = $select->render();
        
        $this->assertStringContainsString('<select', $html);
        $this->assertStringContainsString('name="country"', $html);
        $this->assertStringContainsString('class="form-select"', $html);
        $this->assertStringContainsString('<option value="us">United States</option>', $html);
        $this->assertStringContainsString('<option value="ca">Canada</option>', $html);
    }

    public function testSelectWithPreselectedOption(): void
    {
        $select = new Select('status', [
            ['value' => 'active', 'text' => 'Active'],
            ['value' => 'inactive', 'text' => 'Inactive', 'selected' => true],
        ]);
        $html = $select->render();
        $this->assertStringContainsString('<option value="inactive" selected>Inactive</option>', $html);
    }

    public function testSelectWithPlaceholder(): void
    {
        $select = (new Select('choice', [
            'one' => 'Option One',
            'two' => 'Option Two',
        ]))->placeholder('Choose an option');
        $html = $select->render();
        
        $this->assertStringContainsString('<option value="" selected disabled>Choose an option</option>', $html);
        $this->assertStringContainsString('<option value="one">Option One</option>', $html);
    }

    public function testSelectMultiple(): void
    {
        $select = (new Select('tags', ['red', 'blue']))->multiple();
        $html = $select->render();
        
        $this->assertStringContainsString('name="tags[]"', $html);
        $this->assertStringContainsString('multiple="multiple"', $html);
    }

    public function testSelectDisabled(): void
    {
        $select = (new Select('field'))->disabled();
        $this->assertStringContainsString('disabled="disabled"', $select->render());
    }

    public function testSelectOptgroups(): void
    {
        $select = (new Select('food'))->optgroups([
            ['label' => 'Fruits', 'options' => [
                ['value' => 'apple', 'text' => 'Apple'],
                ['value' => 'banana', 'text' => 'Banana'],
            ]],
            ['label' => 'Vegetables', 'options' => [
                ['value' => 'carrot', 'text' => 'Carrot'],
            ]],
        ]);
        $html = $select->render();

        $this->assertStringContainsString('<optgroup label="Fruits">', $html);
        $this->assertStringContainsString('<option value="apple">Apple</option>', $html);
        $this->assertStringContainsString('<optgroup label="Vegetables">', $html);
        $this->assertStringContainsString('<option value="carrot">Carrot</option>', $html);
    }
}
