<?php

declare(strict_types=1);

namespace Archon\UIKit\Elements\Button;

use Archon\UIKit\Component;

/**
 * Represents a Bootstrap-styled button component.
 */
class Button extends Component
{
    private string $label;
    private string $type = 'button';
    private string $variant = 'primary';
    private bool $outline = false;
    private string $size = ''; // lg, sm, or empty

    public function __construct(string $label)
    {
        $this->label = $label;
        $this->addClass('btn'); // Always add the base btn class
        $this->variant($this->variant); // Apply default variant
    }

    /**
     * Set the button's label.
     */
    public function label(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Set the button's type (e.g., button, submit, reset).
     */
    public function type(string $type): static
    {
        $this->type = $type;
        $this->setAttribute('type', $type);

        return $this;
    }

    /**
     * Set the button's color variant (e.g., primary, secondary, success).
     */
    public function variant(string $variant): static
    {
        // Remove previous variant class if it exists
        if ($this->variant) {
            $oldVariantClass = $this->outline ? "btn-outline-{$this->variant}" : "btn-{$this->variant}";
            $this->removeClass($oldVariantClass);
        }

        $this->variant = $variant;
        $newVariantClass = $this->outline ? "btn-outline-{$this->variant}" : "btn-{$this->variant}";
        $this->addClass($newVariantClass);

        return $this;
    }

    /**
     * Make the button an outline variant.
     */
    public function outline(bool $outline = true): static
    {
        // Only change if the state is different
        if ($this->outline !== $outline) {
            // Remove current variant class based on old outline state
            $oldVariantClass = $this->outline ? "btn-outline-{$this->variant}" : "btn-{$this->variant}";
            $this->removeClass($oldVariantClass);

            $this->outline = $outline;

            // Add new variant class based on new outline state
            $newVariantClass = $this->outline ? "btn-outline-{$this->variant}" : "btn-{$this->variant}";
            $this->addClass($newVariantClass);
        }

        return $this;
    }

    /**
     * Set the button's size (lg, sm, or empty for default).
     */
    public function size(string $size): static
    {
        // Remove previous size class if it exists
        if ($this->size) {
            $this->removeClass("btn-{$this->size}");
        }

        $this->size = $size;
        if ($size) {
            $this->addClass("btn-{$this->size}");
        }

        return $this;
    }

    public function render(): string
    {
        $attributes = $this->buildAttributes();

        return sprintf('<button%s>%s</button>', $attributes, htmlspecialchars($this->label, ENT_QUOTES, 'UTF-8'));
    }
}