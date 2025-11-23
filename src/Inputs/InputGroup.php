<?php

declare(strict_types=1);

namespace Archon\UIKit\Inputs;

use Archon\UIKit\Component;

/**
 * Represents a Bootstrap Input Group.
 * Allows attaching text, buttons, or other controls to inputs.
 */
class InputGroup extends Component
{
    private array $items = []; // Array of components or strings (wrapped in spans)
    private string $size = ''; // sm, lg

    /**
     * @param string|Component ...$items Initial items in the group.
     */
    public function __construct(string|Component ...$items)
    {
        $this->addClass('input-group');
        $this->add(...$items);
    }

    /**
     * Add an item to the input group.
     * If content is a string, it's wrapped in <span class="input-group-text">.
     * If content is a Component, it's added directly.
     */
    public function add(string|Component ...$items): static
    {
        foreach ($items as $item) {
            if (is_string($item)) {
                // Strings are treated as input-group-text
                $this->items[] = sprintf('<span class="input-group-text">%s</span>', htmlspecialchars($item, ENT_QUOTES, 'UTF-8'));
            } else {
                $this->items[] = $item;
            }
        }
        return $this;
    }

    /**
     * Set the size of the input group (sm, lg).
     */
    public function size(string $size): static
    {
        // Remove previous size class
        if ($this->size) {
            $this->removeClass("input-group-{$this->size}");
        }
        $this->size = $size;
        if ($size) {
            $this->addClass("input-group-{$size}");
        }
        return $this;
    }

    public function render(): string
    {
        $attributes = $this->buildAttributes();
        $content = '';

        foreach ($this->items as $item) {
            $content .= (string) $item;
        }

        return sprintf('<div%s>%s</div>', $attributes, $content);
    }
}
