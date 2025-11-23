<?php

declare(strict_types=1);

namespace Archon\UIKit\Overlays;

use Archon\UIKit\Component;

/**
 * Represents a Bootstrap Tooltip.
 * Renders a wrapper element (default: span) with tooltip attributes.
 */
class Tooltip extends Component
{
    private string $content;
    private string $message;
    private string $placement = 'top'; // top, bottom, left, right
    private string $tag = 'span';

    /**
     * @param string $content The text or HTML that triggers the tooltip.
     * @param string $message The tooltip message.
     */
    public function __construct(string $content, string $message)
    {
        $this->content = $content;
        $this->message = $message;
        
        // Bootstrap 5 Tooltip attributes
        $this->data('bs-toggle', 'tooltip');
        $this->data('bs-title', $message);
        $this->placement($this->placement);
    }

    /**
     * Set the tooltip placement.
     */
    public function placement(string $placement): static
    {
        $this->placement = $placement;
        $this->data('bs-placement', $placement);
        return $this;
    }

    /**
     * Set the HTML tag for the wrapper element.
     */
    public function tag(string $tag): static
    {
        $this->tag = $tag;
        return $this;
    }

    public function render(): string
    {
        $attributes = $this->buildAttributes();
        return sprintf('<%s%s>%s</%s>', $this->tag, $attributes, $this->content, $this->tag);
    }
}
