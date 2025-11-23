<?php

declare(strict_types=1);

namespace Archon\UIKit\Inputs;

use Archon\UIKit\Component;

/**
 * Represents a Bootstrap-styled form group component, encapsulating a label and an input.
 */
class FormGroup extends Component
{
    private Label $label;
    private Component $input;
    private ?string $helpText = null;
    private ?string $feedbackText = null;
    private ?string $inputId = null;

    /**
     * @param Label $label The label component.
     * @param Component $input The input component (e.g., TextInput, Textarea).
     */
    public function __construct(Label $label, Component $input)
    {
        $this->label = $label;
        $this->input = $input;
        $this->addClass('mb-3'); // Default Bootstrap margin for form groups

        // Attempt to get the ID from the input and link the label
        $inputId = $this->input->attributes['id'] ?? null;
        if ($inputId) {
            $this->label->for($inputId);
            $this->inputId = $inputId;
        }
    }

    /**
     * Set help text to display below the input.
     */
    public function helpText(string $text): static
    {
        $this->helpText = $text;
        return $this;
    }

    /**
     * Set validation feedback text (e.g., for valid or invalid state).
     */
    public function feedbackText(string $text): static
    {
        $this->feedbackText = $text;
        return $this;
    }

    /**
     * Render the form group HTML.
     */
    public function render(): string
    {
        $attributes = $this->buildAttributes();

        $html = sprintf('<div%s>', $attributes);
        $html .= $this->label->render();
        $html .= $this->input->render();

        if ($this->helpText) {
            $html .= sprintf('<div id="%sHelp" class="form-text">%s</div>', $this->inputId, htmlspecialchars($this->helpText, ENT_QUOTES, 'UTF-8'));
        }

        // Render feedback text if the input is in a valid/invalid state
        if ($this->feedbackText) {
            if (isset($this->input->classes['is-invalid'])) {
                $html .= sprintf('<div class="invalid-feedback">%s</div>', htmlspecialchars($this->feedbackText, ENT_QUOTES, 'UTF-8'));
            } elseif (isset($this->input->classes['is-valid'])) {
                $html .= sprintf('<div class="valid-feedback">%s</div>', htmlspecialchars($this->feedbackText, ENT_QUOTES, 'UTF-8'));
            }
        }

        $html .= '</div>';

        return $html;
    }
}
