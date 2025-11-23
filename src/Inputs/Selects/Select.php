<?php

declare(strict_types=1);

namespace Archon\UIKit\Inputs\Selects;

use Archon\UIKit\Component;

/**
 * Represents a Bootstrap-styled select dropdown component.
 */
class Select extends Component
{
    private string $name;
    private array $options = []; // Array of ['value' => string, 'text' => string, 'selected' => bool, 'disabled' => bool]
    private array $optgroups = []; // Array of ['label' => string, 'options' => array]
    private ?string $placeholder = null;
    private bool $multiple = false;
    private bool $disabled = false;

    /**
     * @param string $name The name attribute of the select element.
     * @param array $options Optional: Array of options. Each option is ['value' => 'some_value', 'text' => 'Display Text'].
     *                          Can also be a simple associative array 'value' => 'text'.
     */
    public function __construct(string $name, array $options = [])
    {
        $this->name = $name;
        $this->addClass('form-select');
        $this->setAttribute('name', $name);
        $this->options($options);
    }

    /**
     * Set/overwrite the options for the select. Can be flat or array of associative arrays.
     */
    public function options(array $options): static
    {
        $this->options = [];
        foreach ($options as $value => $text) {
            if (is_array($text) && isset($text['value'], $text['text'])) {
                $this->options[] = array_merge(['selected' => false, 'disabled' => false], $text);
            } else {
                $this->options[] = ['value' => (string) $value, 'text' => (string) $text, 'selected' => false, 'disabled' => false];
            }
        }
        return $this;
    }

    /**
     * Add an option to the select.
     */
    public function addOption(string $value, string $text, bool $selected = false, bool $disabled = false): static
    {
        $this->options[] = compact('value', 'text', 'selected', 'disabled');
        return $this;
    }

    /**
     * Set/overwrite optgroups for the select.
     * Each optgroup is ['label' => 'Group Label', 'options' => [[...], [...]]].
     */
    public function optgroups(array $optgroups): static
    {
        $this->optgroups = $optgroups;
        return $this;
    }

    /**
     * Set a placeholder option (often the first, disabled and selected).
     */
    public function placeholder(string $placeholder, string $value = ''): static
    {
        $this->placeholder = $placeholder;
        array_unshift($this->options, ['value' => $value, 'text' => $placeholder, 'selected' => true, 'disabled' => true]);
        return $this;
    }

    /**
     * Enable multiple selection.
     */
    public function multiple(bool $multiple = true): static
    {
        $this->multiple = $multiple;
        if ($multiple) {
            $this->setAttribute('multiple', 'multiple');
            // Append [] to name if it's not already there for multiple selection array handling
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
     * Disable the select.
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

    public function render(): string
    {
        $attributes = $this->buildAttributes();

        $optionsHtml = '';

        // Render standard options
        foreach ($this->options as $option) {
            $selected = ($option['selected'] ?? false) ? ' selected' : '';
            $disabled = ($option['disabled'] ?? false) ? ' disabled' : '';
            $optionsHtml .= sprintf(
                '<option value="%s"%s%s>%s</option>',
                htmlspecialchars($option['value'], ENT_QUOTES, 'UTF-8'),
                $selected,
                $disabled,
                htmlspecialchars($option['text'], ENT_QUOTES, 'UTF-8')
            );
        }

        // Render optgroups
        foreach ($this->optgroups as $optgroup) {
            $groupOptionsHtml = '';
            foreach ($optgroup['options'] as $option) {
                $selected = ($option['selected'] ?? false) ? ' selected' : '';
                $disabled = ($option['disabled'] ?? false) ? ' disabled' : '';
                $groupOptionsHtml .= sprintf(
                    '<option value="%s"%s%s>%s</option>',
                    htmlspecialchars($option['value'], ENT_QUOTES, 'UTF-8'),
                    $selected,
                    $disabled,
                    htmlspecialchars($option['text'], ENT_QUOTES, 'UTF-8')
                );
            }
            $optionsHtml .= sprintf(
                '<optgroup label="%s">%s</optgroup>',
                htmlspecialchars($optgroup['label'], ENT_QUOTES, 'UTF-8'),
                $groupOptionsHtml
            );
        }

        return sprintf('<select%s>%s</select>', $attributes, $optionsHtml);
    }
}
