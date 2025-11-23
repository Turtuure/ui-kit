<?php

declare(strict_types=1);

namespace Archon\UIKit\Navigation;

use Archon\UIKit\Component;

/**
 * Represents a Bootstrap Navbar component.
 */
class Navbar extends Component
{
    private string $brandContent = ''; // Content for the brand link
    private string $navContent = '';    // Content inside the collapsible div (Nav components, etc.)
    private string $bgColor = 'light'; // bg-light, bg-dark, etc.
    private ?string $expand = 'lg'; // lg, md, sm, or null for always expanded

    /**
     * @param string $brand The brand text or HTML for the navbar.
     */
    public function __construct(string $brand = '')
    {
        $this->brandContent = $brand;
        $this->addClass('navbar');
        // Initialize bgColor and expand after adding 'navbar' base class
        $this->bgColor($this->bgColor);
        $this->expand($this->expand);
    }

    /**
     * Set the brand text or HTML.
     */
    public function brand(string $brand): static
    {
        $this->brandContent = $brand;
        return $this;
    }

    /**
     * Add content to the main collapsible area of the navbar.
     */
    public function add(string|Component ...$content): static
    {
        foreach ($content as $item) {
            $this->navContent .= (string) $item;
        }
        return $this;
    }

    /**
     * Set the background color variant (e.g., light, dark, primary).
     */
    public function bgColor(string $color): static
    {
        // Remove all previous background color classes and navbar-light/dark classes
        foreach (['light', 'dark', 'primary', 'secondary', 'success', 'danger', 'warning', 'info'] as $c) {
            $this->removeClass("bg-{$c}");
        }
        $this->removeClass('navbar-light');
        $this->removeClass('navbar-dark');

        $this->bgColor = $color;
        $this->addClass("bg-{$color}");

        // Adjust navbar-light or navbar-dark class based on background for text contrast
        if (in_array($color, ['light', 'white', 'warning', 'info', 'success'], true)) {
            $this->addClass('navbar-light');
        } else {
            $this->addClass('navbar-dark');
        }

        return $this;
    }

    /**
     * Set the breakpoint for collapsing the navbar (e.g., 'lg', 'md', 'sm', or null for always expanded).
     */
    public function expand(?string $breakpoint): static
    {
        // Remove existing expand classes
        foreach (['sm', 'md', 'lg', 'xl', 'xxl'] as $bp) {
            $this->removeClass("navbar-expand-{$bp}");
        }

        $this->expand = $breakpoint;
        if ($breakpoint) {
            $this->addClass("navbar-expand-{$breakpoint}");
        }
        return $this;
    }

    public function render(): string
    {
        $attributes = $this->buildAttributes();

        $brandHtml = '';
        if ($this->brandContent) {
            $brandHtml = sprintf('<a class="navbar-brand" href="/">%s</a>', $this->brandContent);
        }

        $toggler = '';
        $collapsibleContent = $this->navContent;

        if ($this->expand !== null) { // If expand is NOT null, it means it can collapse, so we need a toggler and collapsible div
            $togglerId = $this->attributes['id'] ?? uniqid('navbarCollapse'); // Unique ID for toggler target

            $toggler = sprintf('
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#%s" aria-controls="%s" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            ', $togglerId, $togglerId);

            // Wrap content in collapsible div
            $collapsibleContent = sprintf('
                <div class="collapse navbar-collapse" id="%s">
                    %s
                </div>
            ', $togglerId, $this->navContent);
        }

        return sprintf(
            '<nav%s>%s%s%s</nav>',
            $attributes,
            $brandHtml,
            $toggler,
            $collapsibleContent
        );
    }
}