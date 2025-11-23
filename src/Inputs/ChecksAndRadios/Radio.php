<?php

declare(strict_types=1);

namespace Archon\UIKit\Inputs\ChecksAndRadios;

use Archon\UIKit\Component;
use Archon\UIKit\Inputs\Label;

/**
 * Represents a Bootstrap radio input with its label.
 * Radio buttons with the same name attribute form a group.
 */
class Radio extends Component
{
    private string $name;
    private string $labelContent = '';
    private string $value;
    private bool $checked = false;
    private bool $disabled = false;
    private bool $inline = false;

    public function __construct(string $name, string $value, string $labelContent)
    {
        $this->name = $name;
        $this->value = $value;
        $this->labelContent = $labelContent;
        $this->addClass('form-check-input');
        $this->setAttribute('type', 'radio');
        $this->setAttribute('name', $name);
        $this->setAttribute('value', $value);
    }

    /**
     * Set the radio button label content.
     */
    public function label(string $labelContent): static
    {
        $this->labelContent = $labelContent;
        return $this;
    }

    /**
     * Set the radio button value.
     */
    public function value(string $value): static
    {
        $this->value = $value;
        $this->setAttribute('value', $value);
        return $this;
    }

    /**
     * Mark the radio button as checked.
     */
    public function checked(bool $checked = true): static
    {
        $this->checked = $checked;
        if ($checked) {
            $this->setAttribute('checked', 'checked');
        } else {
            unset($this->attributes['checked']);
        }
        return $this;
    }

    /**
     * Disable the radio button.
     */
    public function disabled(bool $disabled = true): static
    {
        $this->disabled = $disabled;
        if ($disabled) {
            $this->setAttribute('disabled', 'disabled');
        } else {
            unset($this->attributes['disabled']);
        }
        return $this;
    }

    /**
     * Render the radio button inline with other controls.
     */
    public function inline(bool $inline = true): static
    {
        $this->inline = $inline;
        return $this; // Class applied at render for wrapping div
    }

    public function render(): string
    {
        $inputId = $this->attributes['id'] ?? uniqid('radio');
        $this->id($inputId); // Ensure the input has an ID for the label

        $attributes = $this->buildAttributes();

        $label = (new Label($this->labelContent))->for($inputId)->addClass('form-check-label');

        $wrapperClasses = ['form-check'];
        if ($this->inline) {
            $wrapperClasses[] = 'form-check-inline';
        }

        return sprintf(
            '<div class="%s">
                <input%s>
                %s
            </div>',
            implode(' ', $wrapperClasses),
            $attributes,
            $label->render()
        );
    }
}
