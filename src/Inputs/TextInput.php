<?php

declare(strict_types=1);

namespace Archon\UIKit\Inputs;

use Archon\UIKit\Component;

/**
 * Represents a Bootstrap-styled text input component.
 */
class TextInput extends Component
{
    private string $name;
    private string $type = 'text';
    private string $value = '';
    private ?string $placeholder = null;
    private bool $disabled = false;
    private bool $readonly = false;
    private bool $isValid = false;
    private bool $isInvalid = false;

    public function __construct(string $name, string $type = 'text')
    {
        $this->name = $name;
        $this->type = $type;
        $this->addClass('form-control'); // Always add the base Bootstrap class
        $this->setAttribute('name', $name);
        $this->setAttribute('type', $type);
    }

    /**
     * Set the input's name attribute.
     */
    public function name(string $name): static
    {
        $this->name = $name;
        $this->setAttribute('name', $name);
        return $this;
    }

    /**
     * Set the input's type attribute (e.g., text, email, password, number).
     */
    public function type(string $type): static
    {
        $this->type = $type;
        $this->setAttribute('type', $type);
        return $this;
    }

    /**
     * Set the input's value.
     */
    public function value(string $value): static
    {
        $this->value = $value;
        $this->setAttribute('value', $value);
        return $this;
    }

    /**
     * Set the input's placeholder text.
     */
    public function placeholder(string $placeholder): static
    {
        $this->placeholder = $placeholder;
        $this->setAttribute('placeholder', $placeholder);
        return $this;
    }

    /**
     * Disable the input.
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
     * Make the input read-only.
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
     * Mark the input as valid (adds Bootstrap's is-valid class).
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
     * Mark the input as invalid (adds Bootstrap's is-invalid class).
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

        return sprintf('<input%s>', $attributes);
    }
}
