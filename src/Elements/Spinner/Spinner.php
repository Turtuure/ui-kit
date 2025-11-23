<?php

declare(strict_types=1);

namespace Archon\UIKit\Elements\Spinner;

use Archon\UIKit\Component;

/**
 * Represents a Bootstrap Spinner component.
 */
class Spinner extends Component
{
    private string $type = 'border'; // border or grow
    private string $variant = ''; // primary, secondary, etc.
    private string $size = ''; // sm
    private ?string $label = null;

    public function __construct(string $type = 'border')
    {
        $this->type = $type;
        $this->addClass("spinner-{$type}");
        $this->setAttribute('role', 'status');
    }

    /**
     * Set the spinner type (border or grow).
     */
    public function type(string $type): static
    {
        // Remove previous type class
        $this->removeClass("spinner-{$this->type}");
        $this->type = $type;
        $this->addClass("spinner-{$type}");
        return $this;
    }

    /**
     * Set the spinner color variant (e.g., primary, secondary, light).
     */
    public function variant(string $variant): static
    {
        // Remove previous variant class
        if ($this->variant) {
            $this->removeClass("text-{$this->variant}");
        }
        $this->variant = $variant;
        $this->addClass("text-{$variant}");
        return $this;
    }

    /**
     * Set the spinner size (sm).
     */
    public function size(string $size): static
    {
        // Remove previous size class
        if ($this->size) {
            $this->removeClass("spinner-{$this->type}-{$this->size}");
        }
        $this->size = $size;
        if ($size) {
            $this->addClass("spinner-{$this->type}-{$this->size}");
        }
        return $this;
    }

    /**
     * Add a visually hidden label for accessibility.
     */
    public function label(string $label): static
    {
        $this->label = $label;
        return $this;
    }

    public function render(): string
    {
        $attributes = $this->buildAttributes();

        $labelHtml = '';
        if ($this->label) {
            $labelHtml = sprintf('<span class="visually-hidden">%s</span>', htmlspecialchars($this->label, ENT_QUOTES, 'UTF-8'));
        }

        return sprintf('<div%s>%s</div>', $attributes, $labelHtml);
    }
}
