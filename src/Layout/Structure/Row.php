<?php

declare(strict_types=1);

namespace Archon\UIKit\Layout\Structure;

use Archon\UIKit\Component;

/**
 * Represents a Bootstrap grid row.
 */
class Row extends Component
{
    private string $content = '';

    /**
     * @param string|Component ...$content Columns or content to put inside the row.
     */
    public function __construct(string|Component ...$content)
    {
        $this->addClass('row');
        $this->add(...$content);
    }

    /**
     * Add content (usually Columns) to the row.
     */
    public function add(string|Component ...$content): static
    {
        foreach ($content as $item) {
            $this->content .= (string) $item;
        }
        return $this;
    }

    /**
     * Set the gutter size (0-5).
     * @see https://getbootstrap.com/docs/5.3/layout/gutters/
     */
    public function gutter(int $size): static
    {
        // Remove existing gutter classes just in case
        foreach ([0, 1, 2, 3, 4, 5] as $g) {
            $this->removeClass("g-$g");
            $this->removeClass("gx-$g");
            $this->removeClass("gy-$g");
        }
        
        $this->addClass("g-{$size}");
        return $this;
    }

    public function render(): string
    {
        $attributes = $this->buildAttributes(['class']);
        return sprintf('<div%s>%s</div>', $attributes, $this->content);
    }
}
