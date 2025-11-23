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
        $this->assertStringContainsString('class="alert alert-primary"', $alert->render());
        $this->assertStringContainsString('role="alert"', $alert->render());
    }

    public function testAlertVariantCanBeChanged(): void
    {
        $alert = (new Alert('Test'))->variant('success');
        $this->assertStringContainsString('class="alert alert-success"', $alert->render());
        $this->assertStringNotContainsString('alert-primary', $alert->render());
    }

    public function testDismissibleAlert(): void
    {
        $alert = (new Alert('Dismiss me!'))->dismissible();
        $html = $alert->render();
        $this->assertStringContainsString('class="alert alert-primary alert-dismissible fade show"', $html);
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
