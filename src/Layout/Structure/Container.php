<?php

declare(strict_types=1);

namespace Archon\UIKit\Layout\Structure;

use Archon\UIKit\Component;

/**
 * Represents a Bootstrap container.
 */
class Container extends Component
{
    private bool $fluid = false;
    private string $content = '';

    /**
     * @param string|Component ...$content Content to put inside the container.
     */
    public function __construct(string|Component ...$content)
    {
        foreach ($content as $item) {
            $this->content .= (string) $item;
        }
        $this->updateClass();
    }

    /**
     * Make the container fluid (width: 100% at all breakpoints).
     */
    public function fluid(bool $fluid = true): static
    {
        $this->fluid = $fluid;
        $this->updateClass();
        return $this;
    }

    /**
     * Add content to the container.
     */
    public function add(string|Component ...$content): static
    {
        foreach ($content as $item) {
            $this->content .= (string) $item;
        }
        return $this;
    }

    private function updateClass(): void
    {
        if ($this->fluid) {
            $this->removeClass('container');
            $this->addClass('container-fluid');
        } else {
            $this->removeClass('container-fluid');
            $this->addClass('container');
        }
    }

    public function render(): string
    {
        $attributes = $this->buildAttributes();
        return sprintf('<div%s>%s</div>', $attributes, $this->content);
    }
}
