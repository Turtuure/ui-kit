<?php

declare(strict_types=1);

namespace Archon\UIKit\Overlays;

use Archon\UIKit\Component;

/**
 * Represents a Bootstrap Popover.
 * Renders a wrapper element (default: span) with popover attributes.
 */
class Popover extends Component
{
    private string $content;
    private string $title;
    private string $message;
    private string $placement = 'right'; // top, bottom, left, right, auto
    private string $tag = 'span'; // Default to span to avoid nested buttons

    /**
     * @param string $content The text or HTML that triggers the popover.
     * @param string $title The title of the popover.
     * @param string $message The body content of the popover.
     */
    public function __construct(string $content, string $title, string $message)
    {
        $this->content = $content;
        $this->title = $title;
        $this->message = $message;
        
        // Bootstrap 5 Popover attributes
        $this->data('bs-toggle', 'popover');
        $this->data('bs-title', $title);
        $this->data('bs-content', $message);
        $this->data('bs-container', 'body'); // Prevent clipping
        $this->placement($this->placement);
    }

    /**
     * Set the popover placement.
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
