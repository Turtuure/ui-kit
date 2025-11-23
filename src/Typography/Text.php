<?php

declare(strict_types=1);

namespace Archon\UIKit\Typography;

use Archon\UIKit\Component;

/**
 * Represents a general text component.
 */
class Text extends Component
{
    private string $content;
    private string $tag = 'p'; // Default to paragraph

    public function __construct(string $content)
    {
        $this->content = $content;
    }

    /**
     * Set the text content.
     */
    public function content(string $content): static
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Set the HTML tag to use (e.g., 'p', 'span', 'div').
     */
    public function tag(string $tag): static
    {
        $this->tag = $tag;
        return $this;
    }

    /**
     * Apply Bootstrap text muted style.
     */
    public function muted(bool $muted = true): static
    {
        if ($muted) {
            $this->addClass('text-muted');
        } else {
            $this->removeClass('text-muted');
        }
        return $this;
    }

    public function render(): string
    {
        $attributes = $this->buildAttributes();
        return sprintf('<%s%s>%s</%s>', $this->tag, $attributes, htmlspecialchars($this->content, ENT_QUOTES, 'UTF-8'), $this->tag);
    }
}
