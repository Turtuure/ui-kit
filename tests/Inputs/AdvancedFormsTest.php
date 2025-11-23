<?php

declare(strict_types=1);

namespace Archon\UIKit\Tests\Inputs;

use Archon\UIKit\Elements\Button\Button;
use Archon\UIKit\Inputs\FileUpload;
use Archon\UIKit\Inputs\InputGroup;
use Archon\UIKit\Inputs\TextInput;
use PHPUnit\Framework\TestCase;

final class AdvancedFormsTest extends TestCase
{
    public function testInputGroupRendersCorrectly(): void
    {
        $group = new InputGroup(
            '@',
            new TextInput('username')
        );
        $html = $group->render();
        
        $this->assertStringContainsString('class="input-group"', $html);
        $this->assertStringContainsString('<span class="input-group-text">@</span>', $html);
        $this->assertStringContainsString('<input', $html);
        $this->assertStringContainsString('name="username"', $html);
    }

    public function testInputGroupWithButton(): void
    {
        $group = new InputGroup(
            new TextInput('search'),
            new Button('Search')
        );
        $html = $group->render();
        
        $this->assertStringContainsString('name="search"', $html);
        $this->assertStringContainsString('<button', $html);
        $this->assertStringContainsString('>Search</button>', $html);
    }

    public function testInputGroupSize(): void
    {
        $group = (new InputGroup())->size('lg');
        $html = $group->render();
        
        $this->assertStringContainsString('class="input-group input-group-lg"', $html); // Sorted alphabetically
    }

    public function testFileUploadRendersCorrectly(): void
    {
        $file = new FileUpload('avatar');
        $html = $file->render();
        
        $this->assertStringContainsString('<input', $html);
        $this->assertStringContainsString('type="file"', $html);
        $this->assertStringContainsString('name="avatar"', $html);
        $this->assertStringContainsString('class="form-control"', $html);
    }

    public function testFileUploadMultiple(): void
    {
        $file = (new FileUpload('docs'))->multiple();
        $html = $file->render();
        
        $this->assertStringContainsString('multiple="multiple"', $html);
        $this->assertStringContainsString('name="docs[]"', $html);
    }

    public function testFileUploadSizeAndDisabled(): void
    {
        $file = (new FileUpload('file'))
            ->size('sm')
            ->disabled();
        $html = $file->render();
        
        $this->assertStringContainsString('class="form-control form-control-sm"', $html); // Sorted
        $this->assertStringContainsString('disabled="disabled"', $html);
    }
}
