<?php

declare(strict_types=1);

namespace Archon\UIKit\Tests\Elements;

use Archon\UIKit\Elements\Badge\Badge;
use PHPUnit\Framework\TestCase;

final class BadgeTest extends TestCase
{
    public function testBadgeRendersCorrectly(): void
    {
        $badge = new Badge('New');
        $this->assertStringContainsString('class="badge text-bg-primary"', $badge->render());
        $this->assertStringContainsString('>New</span>', $badge->render());
    }

    public function testBadgeVariant(): void
    {
        $badge = (new Badge('Success'))->variant('success');
        $this->assertStringContainsString('class="badge text-bg-success"', $badge->render());
    }

    public function testBadgePill(): void
    {
        $badge = (new Badge('Pill'))->pill();
        $this->assertStringContainsString('rounded-pill', $badge->render());
    }
}
