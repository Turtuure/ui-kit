<?php

declare(strict_types=1);

namespace Archon\UIKit\Layout\Structure;

use Archon\UIKit\Component;

/**
 * Represents a Bootstrap grid column.
 */
class Column extends Component
{
    private string $content = '';

    /**
     * @param string|Component ...$content Content inside the column.
     */
    public function __construct(string|Component ...$content)
    {
        // By default, it's a flexible column ('col') unless specific sizes are set
        $this->addClass('col'); 
        $this->add(...$content);
    }

    /**
     * Add content to the column.
     */
    public function add(string|Component ...$content): static
    {
        foreach ($content as $item) {
            $this->content .= (string) $item;
        }
        return $this;
    }

    /**
     * Set column size for Extra Small (xs) devices (<576px).
     * @param int|string $size Number 1-12 or 'auto'.
     */
    public function xs(int|string $size): static
    {
        $this->removeClass('col'); // Remove default flexible class if specific size is set
        $this->addClass("col-{$size}");
        return $this;
    }

    /**
     * Set column size for Small (sm) devices (>=576px).
     */
    public function sm(int|string $size): static
    {
        $this->addClass("col-sm-{$size}");
        return $this;
    }

    /**
     * Set column size for Medium (md) devices (>=768px).
     */
    public function md(int|string $size): static
    {
        $this->addClass("col-md-{$size}");
        return $this;
    }

    /**
     * Set column size for Large (lg) devices (>=992px).
     */
    public function lg(int|string $size): static
    {
        $this->addClass("col-lg-{$size}");
        return $this;
    }

    /**
     * Set column size for Extra Large (xl) devices (>=1200px).
     */
    public function xl(int|string $size): static
    {
        $this->addClass("col-xl-{$size}");
        return $this;
    }

    public function render(): string
    {
        $attributes = $this->buildAttributes();
        return sprintf('<div%s>%s</div>', $attributes, $this->content);
    }
}
