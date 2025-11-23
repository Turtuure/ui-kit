<?php

declare(strict_types=1);

namespace Archon\UIKit\Inputs;

use Archon\UIKit\Component;

/**
 * Represents a Bootstrap File Input component.
 */
class FileUpload extends Component
{
    private string $name;
    private bool $multiple = false;
    private bool $disabled = false;
    private string $size = ''; // sm, lg

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->addClass('form-control');
        $this->setAttribute('type', 'file');
        $this->setAttribute('name', $name);
    }

    /**
     * Allow multiple file selection.
     */
    public function multiple(bool $multiple = true): static
    {
        $this->multiple = $multiple;
        if ($multiple) {
            $this->setAttribute('multiple', 'multiple');
            // Ensure name handles array
            if (substr($this->name, -2) !== '[]') {
                $this->setAttribute('name', $this->name . '[]');
            }
        } else {
            unset($this->attributes['multiple']);
            if (substr($this->attributes['name'], -2) === '[]') {
                $this->setAttribute('name', substr($this->attributes['name'], 0, -2));
            }
        }
        return $this;
    }

    /**
     * Disable the file input.
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
     * Set the size of the file input (sm, lg).
     */
    public function size(string $size): static
    {
        // Remove previous size class
        if ($this->size) {
            $this->removeClass("form-control-{$this->size}");
        }
        $this->size = $size;
        if ($size) {
            $this->addClass("form-control-{$size}");
        }
        return $this;
    }

    public function render(): string
    {
        $attributes = $this->buildAttributes();
        return sprintf('<input%s>', $attributes);
    }
}
