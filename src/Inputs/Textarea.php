<?php

declare(strict_types=1);

namespace Archon\UIKit\Inputs;

use Archon\UIKit\Component;

/**
 * Represents a Bootstrap-styled textarea component.
 */
class Textarea extends Component
{
    private string $name;
    private string $value = '';
    private ?string $placeholder = null;
    private int $rows = 3;
    private bool $disabled = false;
    private bool $readonly = false;
    private bool $isValid = false;
    private bool $isInvalid = false;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->addClass('form-control'); // Always add the base Bootstrap class
        $this->setAttribute('name', $name);
        $this->setAttribute('rows', (string) $this->rows);
    }

    /**
     * Set the textarea's name attribute.
     */
    public function name(string $name): static
    {
        $this->name = $name;
        $this->setAttribute('name', $name);
        return $this;
    }

    /**
     * Set the textarea's value.
     */
    public function value(string $value): static
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Set the textarea's placeholder text.
     */
    public function placeholder(string $placeholder): static
    {
        $this->placeholder = $placeholder;
        $this->setAttribute('placeholder', $placeholder);
        return $this;
    }

    /**
     * Set the number of rows for the textarea.
     */    
    public function rows(int $rows): static
    {
        $this->rows = $rows;
        $this->setAttribute('rows', (string) $rows);
        return $this;
    }

    /**
     * Disable the textarea.
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
     * Make the textarea read-only.
     */
    public function readonly(bool $readonly = true): static
    {
        $this->readonly = $readonly;
        if ($readonly) {
            $this->setAttribute('readonly', 'readonly');
        } else {
            unset($this->attributes['readonly']);
        }
        return $this;
    }

    /**
     * Mark the textarea as valid (adds Bootstrap's is-valid class).
     */
    public function valid(bool $isValid = true): static
    {
        $this->isValid = $isValid;
        if ($isValid) {
            $this->addClass('is-valid');
            $this->removeClass('is-invalid');
            $this->isInvalid = false;
        } else {
            $this->removeClass('is-valid');
        }
        return $this;
    }

    /**
     * Mark the textarea as invalid (adds Bootstrap's is-invalid class).
     */
    public function invalid(bool $isInvalid = true): static
    {
        $this->isInvalid = $isInvalid;
        if ($isInvalid) {
            $this->addClass('is-invalid');
            $this->removeClass('is-valid');
            $this->isValid = false;
        } else {
            $this->removeClass('is-invalid');
        }
        return $this;
    }

    public function render(): string
    {
        $attributes = $this->buildAttributes();

        // The value goes between the <textarea> tags
        return sprintf('<textarea%s>%s</textarea>', $attributes, htmlspecialchars($this->value, ENT_QUOTES, 'UTF-8'));
    }
}
