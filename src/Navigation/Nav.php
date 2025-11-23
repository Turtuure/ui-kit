<?php

declare(strict_types=1);

namespace Archon\UIKit\Navigation;

use Archon\UIKit\Component;

/**
 * Represents a Bootstrap navigation component (nav-tabs, nav-pills, nav-fill, etc.).
 */
class Nav extends Component
{
    private string $content = '';
    private string $type = ''; // e.g., tabs, pills

    /**
     * @param string|Component ...$items Nav items (e.g., <a> tags, or custom NavItem components).
     */
    public function __construct(string|Component ...$items)
    {
        $this->addClass('nav');
        $this->add(...$items);
    }

    /**
     * Add a navigation item to the nav.
     */
    public function add(string|Component ...$items): static
    {
        foreach ($items as $item) {
            $this->content .= (string) $item;
        }
        return $this;
    }

    /**
     * Set the nav type to tabs.
     */
    public function tabs(): static
    {
        $this->removeTypeClasses();
        $this->addClass('nav-tabs');
        $this->type = 'tabs';
        return $this;
    }

    /**
     * Set the nav type to pills.
     */
    public function pills(): static
    {
        $this->removeTypeClasses();
        $this->addClass('nav-pills');
        $this->type = 'pills';
        return $this;
    }

    /**
     * Make the nav items fill the available width.
     */
    public function fill(bool $fill = true): static
    {
        if ($fill) {
            $this->addClass('nav-fill');
        } else {
            $this->removeClass('nav-fill');
        }
        return $this;
    }

    /**
     * Make the nav items justified (equal width).
     */
    public function justified(bool $justified = true): static
    {
        if ($justified) {
            $this->addClass('nav-justified');
        } else {
            $this->removeClass('nav-justified');
        }
        return $this;
    }

    /**
     * Make the nav vertical.
     */
    public function vertical(bool $vertical = true): static
    {
        if ($vertical) {
            $this->addClass('flex-column');
        } else {
            $this->removeClass('flex-column');
        }
        return $this;
    }

    private function removeTypeClasses(): void
    {
        $this->removeClass('nav-tabs');
        $this->removeClass('nav-pills');
    }

    public function render(): string
    {
        $attributes = $this->buildAttributes();
        return sprintf('<ul%s>%s</ul>', $attributes, $this->content);
    }
}
