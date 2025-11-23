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
    private string $tag = 'button';

    public function __construct(string $label)
    {
        $this->label = $label;
        $this->addClass('btn'); // Always add the base btn class
        $this->variant($this->variant); // Apply default variant
    }

    /**
     * Set the HTML tag (e.g., 'a', 'button').
     */
    public function tag(string $tag): static
    {
        $this->tag = $tag;
        return $this;
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

    /**
     * Set the text color (e.g., white, primary, success).
     * Useful with dark backgrounds or specific contrast needs.
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
        // Automatically switch to <a> if href is present and tag wasn't manually changed from button
        if (isset($this->attributes['href']) && $this->tag === 'button') {
            $this->tag = 'a';
            // Remove 'type' attribute for anchors as it's invalid/unnecessary
            unset($this->attributes['type']);
        }

        $attributes = $this->buildAttributes();

        return sprintf('<%1$s%2$s>%3$s</%1$s>', $this->tag, $attributes, htmlspecialchars($this->label, ENT_QUOTES, 'UTF-8'));
    }
}