<?php

declare(strict_types=1);

namespace Archon\UIKit\Feedback;

use Archon\UIKit\Component;

/**
 * Represents a Bootstrap-styled alert component.
 */
class Alert extends Component
{
    private string $content;
    private string $variant = 'primary'; // Corresponds to Bootstrap's alert-primary, etc.
    private bool $dismissible = false;

    public function __construct(string $content)
    {
        $this->content = $content;
        $this->addClass('alert'); // Base alert class
        $this->variant($this->variant); // Apply default variant
        $this->setAttribute('role', 'alert');
    }

    /**
     * Set the alert's content.
     */
    public function content(string $content): static
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Set the alert's color variant (e.g., primary, secondary, success, danger).
     */
    public function variant(string $variant): static
    {
        // Remove previous variant class if it exists
        if ($this->variant) {
            $this->removeClass("alert-{$this->variant}");
        }

        $this->variant = $variant;
        $this->addClass("alert-{$this->variant}");

        return $this;
    }

    /**
     * Make the alert dismissible.
     */
    public function dismissible(bool $dismissible = true): static
    {
        $this->dismissible = $dismissible;
        if ($dismissible) {
            $this->addClass('alert-dismissible fade show');
        } else {
            $this->removeClass('alert-dismissible fade show');
        }

        return $this;
    }

    public function render(): string
    {
        $attributes = $this->buildAttributes();

        $closeButton = '';
        if ($this->dismissible) {
            $closeButton = '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        }

        return sprintf('<div%s>%s%s</div>', $attributes, $this->content, $closeButton);
    }
}
