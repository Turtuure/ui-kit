<?php

declare(strict_types=1);

namespace Archon\UIKit\Tests\Feedback;

use Archon\UIKit\Feedback\Alert;
use PHPUnit\Framework\TestCase;

final class AlertTest extends TestCase
{
    public function testAlertRendersWithContent(): void
    {
        $alert = new Alert('Simple alert message');
        $this->assertStringContainsString('>Simple alert message</div>', $alert->render());
    }

    public function testAlertHasDefaultClasses(): void
    {
        $alert = new Alert('Test');
        $html = $alert->render();
        $this->assertStringContainsString('class="', $html);
        $this->assertStringContainsString('alert', $html);
        $this->assertStringContainsString('alert-primary', $html);
        $this->assertStringContainsString('role="alert"', $html);
    }

    public function testAlertVariantCanBeChanged(): void
    {
        $alert = (new Alert('Test'))->variant('success');
        $html = $alert->render();
        $this->assertStringContainsString('alert-success', $html);
        $this->assertStringNotContainsString('alert-primary', $html);
    }

    public function testDismissibleAlert(): void
    {
        $alert = (new Alert('Dismiss me!'))->dismissible();
        $html = $alert->render();
        $this->assertStringContainsString('alert-dismissible', $html);
        $this->assertStringContainsString('fade', $html);
        $this->assertStringContainsString('show', $html);
        $this->assertStringContainsString('<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>', $html);
    }

    public function testAlertNotDismissibleByDefault(): void
    {
        $alert = new Alert('Not dismissible');
        $html = $alert->render();
        $this->assertStringNotContainsString('alert-dismissible', $html);
        $this->assertStringNotContainsString('btn-close', $html);
    }

    public function testAlertCustomAttribute(): void
    {
        $alert = (new Alert('Test'))->setAttribute('data-test', 'value');
        $this->assertStringContainsString('data-test="value"', $alert->render());
    }
}