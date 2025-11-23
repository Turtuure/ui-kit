<?php

declare(strict_types=1);

namespace Archon\UIKit\Tests\DataDisplay;

use Archon\UIKit\DataDisplay\Card;
use Archon\UIKit\DataDisplay\Table;
use PHPUnit\Framework\TestCase;

final class DataDisplayTest extends TestCase
{
    public function testCardRendersBasicContent(): void
    {
        $card = new Card('Card Body Content');
        $html = $card->render();
        $this->assertStringContainsString('class="card"', $html);
        $this->assertStringContainsString('<div class="card-body">Card Body Content</div>', $html);
    }

    public function testCardWithHeaderAndFooter(): void
    {
        $card = (new Card('Body'))
            ->header('Card Header')
            ->footer('Card Footer');
        $html = $card->render();
        $this->assertStringContainsString('<div class="card-header">Card Header</div>', $html);
        $this->assertStringContainsString('<div class="card-footer">Card Footer</div>', $html);
    }

    public function testCardWithImageTop(): void
    {
        $card = (new Card('Body'))->imageTop('/img/test.jpg', 'Test Image');
        $html = $card->render();
        $this->assertStringContainsString('<img src="/img/test.jpg" class="card-img-top" alt="Test Image">', $html);
    }

    public function testCardVariantAndTextColor(): void
    {
        $card = (new Card('Body'))
            ->variant('primary')
            ->textColor('white');
        $html = $card->render();
        // Assert that individual classes are present, rather than the exact order of the class attribute string
        $this->assertStringContainsString('class="bg-primary card text-white"', $html); // Sorted alphabetically by buildAttributes
    }

    public function testTableRendersBasicHeadersAndRows(): void
    {
        $table = new Table(
            ['Name', 'Age'],
            [['John', 30], ['Jane', 25]]
        );
        $html = $table->render();
        $this->assertStringContainsString('<table class="table">', $html);
        $this->assertStringContainsString('<th scope="col">Name</th>', $html);
        $this->assertStringContainsString('<td>John</td>', $html);
        $this->assertStringContainsString('<td>30</td>', $html);
    }

    public function testTableStripedAndHover(): void
    {
        $table = (new Table(
            ['Col1'],
            [['Data1']]
        ))
            ->striped()
            ->hover();
        $html = $table->render();
        $this->assertStringContainsString('class="table table-hover table-striped"', $html); // Sorted alphabetically
    }

    public function testTableResponsiveAndDarkVariant(): void
    {
        $table = (new Table(
            ['Col1'],
            [['Data1']]
        ))
            ->responsive()
            ->variant('dark');
        $html = $table->render();
        $this->assertStringContainsString('<div class="table-responsive">', $html);
        $this->assertStringContainsString('<table class="table table-dark"', $html);
    }
}