<?php

declare(strict_types=1);

namespace Archon\UIKit\Tests\Typography;

use Archon\UIKit\Typography\Heading;
use Archon\UIKit\Typography\Text;
use PHPUnit\Framework\TestCase;

final class TypographyTest extends TestCase
{
    public function testTextRendersWithContent(): void
    {
        $text = new Text('Hello World');
        $this->assertStringContainsString('<p>Hello World</p>', $text->render());
    }

    public function testTextWithDifferentTag(): void
    {
        $text = (new Text('Span Content'))->tag('span');
        $this->assertStringContainsString('<span>Span Content</span>', $text->render());
    }

    public function testTextMuted(): void
    {
        $text = (new Text('Muted Text'))->muted();
        $this->assertStringContainsString('class="text-muted"', $text->render());
    }

    public function testHeadingRendersCorrectly(): void
    {
        $heading = new Heading('Page Title', 1);
        $this->assertStringContainsString('<h1>Page Title</h1>', $heading->render());
    }

    public function testHeadingLevelChange(): void
    {
        $heading = (new Heading('Subtitle'))->level(3);
        $this->assertStringContainsString('<h3>Subtitle</h3>', $heading->render());
    }

    public function testHeadingWithDisplaySize(): void
    {
        $heading = (new Heading('Display Heading', 1))->display(4);
        $this->assertStringContainsString('<h1 class="display-4">Display Heading</h1>', $heading->render());
    }

    public function testHeadingThrowsExceptionForInvalidLevel(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Heading('Invalid', 7);
    }

    public function testHeadingThrowsExceptionForInvalidDisplaySize(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        (new Heading('Invalid'))->display(0);
    }

    public function testHeadingLevelAndDisplayCoexist(): void
    {
        $heading = (new Heading('Styled Heading', 2))->display(5);
        $this->assertStringContainsString('<h2 class="display-5">Styled Heading</h2>', $heading->render());
    }
}
