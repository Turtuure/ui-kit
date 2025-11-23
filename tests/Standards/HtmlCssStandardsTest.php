<?php

declare(strict_types=1);

namespace Archon\UIKit\Tests\Standards;

use PHPUnit\Framework\TestCase;

class HtmlCssStandardsTest extends TestCase
{
    /**
     * Checks that all rendered HTML is valid and all class names follow Bootstrap conventions.
     * This is a basic smoke test for standards compliance.
     */
    public function testHtmlAndCssStandards(): void
    {
        $components = [
            new \Archon\UIKit\Elements\Button\Button('Test'),
            new \Archon\UIKit\Feedback\Alert('Alert!'),
            new \Archon\UIKit\Inputs\TextInput('email', 'email'),
            new \Archon\UIKit\Inputs\Textarea('message'),
            new \Archon\UIKit\Layout\Structure\Row('Content'),
            new \Archon\UIKit\Overlays\Popover('Click me', 'Title', 'Content'),
        ];

        foreach ($components as $component) {
            $html = $component->render();
            // Basic HTML tag check: allow paired tags or self-closing tags
            $this->assertMatchesRegularExpression('/^<([a-z]+)([^>]*)>([\s\S]*<\/\1>|)$/i', $html, 'HTML must have valid opening/closing or be self-closing');
            // Class attribute should follow Bootstrap naming
            if (preg_match('/class="([^"]+)"/', $html, $matches)) {
                $classes = explode(' ', $matches[1]);
                foreach ($classes as $class) {
                    $this->assertMatchesRegularExpression('/^(btn(-[a-z0-9]+)?|alert(-[a-z0-9]+)?|form-control|g-\d|is-valid|is-invalid|row|text-[a-z]+|btn-close|fade|show|popover)$/', $class, "Class '$class' should follow Bootstrap conventions");
                }
            }
        }
    }
}
