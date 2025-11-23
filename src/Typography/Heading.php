<?php

declare(strict_types=1);

namespace Archon\UIKit\Typography;

use Archon\UIKit\Component;

/**
 * Represents an HTML heading component (h1-h6) with Bootstrap display classes.
 */
class Heading extends Component
{
    private string $content;
    private int $level = 1; // H1-H6
    private ?int $displaySize = null; // Bootstrap display-1 to display-6

    public function __construct(string $content, int $level = 1)
    {
        if ($level < 1 || $level > 6) {
            throw new \InvalidArgumentException('Heading level must be between 1 and 6.');
        }
        $this->content = $content;
        $this->level = $level;
    }

    /**
     * Set the heading text content.
     */
    public function content(string $content): static
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Set the HTML heading level (h1-h6).
     */
    public function level(int $level): static
    {
        if ($level < 1 || $level > 6) {
            throw new \InvalidArgumentException('Heading level must be between 1 and 6.');
        }
        $this->level = $level;
        return $this;
    }

    /**
     * Apply Bootstrap display heading style (display-1 to display-6).
     */
    public function display(int $size): static
    {
        if ($size < 1 || $size > 6) {
            throw new \InvalidArgumentException('Display size must be between 1 and 6.');
        }
        // Remove previous display class if it exists
        if ($this->displaySize) {
            $this->removeClass("display-{$this->displaySize}");
        }
        $this->displaySize = $size;
        $this->addClass("display-{$this->displaySize}");
        return $this;
    }

    public function render(): string
    {
        $tag = "h{$this->level}";
        $attributes = $this->buildAttributes();
        return sprintf('<%s%s>%s</%s>', $tag, $attributes, htmlspecialchars($this->content, ENT_QUOTES, 'UTF-8'), $tag);
    }
}
