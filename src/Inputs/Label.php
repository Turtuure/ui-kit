<?php

declare(strict_types=1);

namespace Archon\UIKit\Inputs;

use Archon\UIKit\Component;

/**
 * Represents an HTML <label> component.
 */
class Label extends Component
{
    private string $text;
    private ?string $forId = null;

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    /**
     * Set the text content of the label.
     */
    public function text(string $text): static
    {
        $this->text = $text;
        return $this;
    }

    /**
     * Associate the label with an input by its ID.
     */
    public function for(string $id): static
    {
        $this->forId = $id;
        $this->setAttribute('for', $id);
        return $this;
    }

    public function render(): string
    {
        $attributes = $this->buildAttributes();

        return sprintf('<label%s>%s</label>', $attributes, htmlspecialchars($this->text, ENT_QUOTES, 'UTF-8'));
    }
}
