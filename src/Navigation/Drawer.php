<?php

declare(strict_types=1);

namespace Archon\UIKit\Navigation;

use Archon\UIKit\Component;

/**
 * Represents a Bootstrap Offcanvas (Drawer) component.
 */
class Drawer extends Component
{
    private string $title = '';
    private string $body = '';
    private string $placement = 'start'; // start, end, top, bottom
    private bool $backdrop = true;
    private bool $scroll = false; // Allow body scrolling

    public function __construct(string $id, string $title = '')
    {
        $this->id($id);
        $this->title = $title;
        $this->addClass('offcanvas');
        $this->setAttribute('tabindex', '-1');
        $this->placement($this->placement); // Set initial placement class
    }

    /**
     * Set the placement of the drawer (start, end, top, bottom).
     */
    public function placement(string $placement): static
    {
        // Remove existing placement class
        foreach (['start', 'end', 'top', 'bottom'] as $p) {
            $this->removeClass("offcanvas-{$p}");
        }
        $this->placement = $placement;
        $this->addClass("offcanvas-{$placement}");
        return $this;
    }

    /**
     * Set the drawer body content.
     */
    public function body(string|Component $content): static
    {
        $this->body = (string) $content;
        return $this;
    }

    /**
     * Configure backdrop behavior.
     * @param bool $backdrop True to show backdrop, false to hide.
     */
    public function backdrop(bool $backdrop = true): static
    {
        $this->backdrop = $backdrop;
        $this->data('bs-backdrop', $backdrop ? 'true' : 'false');
        return $this;
    }

    /**
     * Enable body scrolling while drawer is open.
     */
    public function scroll(bool $scroll = true): static
    {
        $this->scroll = $scroll;
        $this->data('bs-scroll', $scroll ? 'true' : 'false');
        return $this;
    }

    public function render(): string
    {
        $attributes = $this->buildAttributes();
        $labelledBy = $this->attributes['id'] . 'Label';
        
        if (!isset($this->attributes['aria-labelledby'])) {
            $attributes .= sprintf(' aria-labelledby="%s"', $labelledBy);
        }

        return sprintf(
            '<div%s>
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="%s">%s</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    %s
                </div>
            </div>',
            $attributes,
            $labelledBy,
            htmlspecialchars($this->title, ENT_QUOTES, 'UTF-8'),
            $this->body
        );
    }
}
