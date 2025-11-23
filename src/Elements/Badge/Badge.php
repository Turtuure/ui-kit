<?php

declare(strict_types=1);

namespace Archon\UIKit\Elements\Badge;

use Archon\UIKit\Component;

/**
 * Represents a Bootstrap Badge component.
 */
class Badge extends Component
{
    private string $text;
    private string $variant = 'primary';
    private bool $pill = false;

    public function __construct(string $text)
    {
        $this->text = $text;
        $this->addClass('badge');
        $this->variant($this->variant);
    }

    /**
     * Set the badge text.
     */
    public function text(string $text): static
    {
        $this->text = $text;
        return $this;
    }

    /**
     * Set the badge variant (primary, secondary, etc.).
     */
    public function variant(string $variant): static
    {
        // Remove previous variant class
        if ($this->variant) {
            $this->removeClass("text-bg-{$this->variant}");
        }
        $this->variant = $variant;
        $this->addClass("text-bg-{$variant}"); // Bootstrap 5 uses text-bg-* for badges
        return $this;
    }

    /**
     * Make the badge rounded (pill style).
     */
    public function pill(bool $pill = true): static
    {
        $this->pill = $pill;
        if ($pill) {
            $this->addClass('rounded-pill');
        } else {
            $this->removeClass('rounded-pill');
        }
        return $this;
    }

    /**
     * Set the text color (e.g., white, dark).
     */
    public function textColor(string $color): static
    {
        // Remove previous text color classes
        foreach (['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark', 'white', 'muted'] as $c) {
            $this->removeClass("text-{$c}");
        }
        $this->addClass("text-{$color}");
        return $this;
    }

    public function render(): string
    {
        $attributes = $this->buildAttributes();
        return sprintf('<span%s>%s</span>', $attributes, htmlspecialchars($this->text, ENT_QUOTES, 'UTF-8'));
    }
}
