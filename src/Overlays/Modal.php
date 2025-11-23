<?php

declare(strict_types=1);

namespace Archon\UIKit\Overlays;

use Archon\UIKit\Component;

/**
 * Represents a Bootstrap Modal component.
 */
class Modal extends Component
{
    private string $title = '';
    private string $body = '';
    private string $footer = '';
    private bool $staticBackdrop = false;
    private bool $centered = false;
    private string $size = ''; // sm, lg, xl

    public function __construct(string $id, string $title)
    {
        $this->id($id);
        $this->title = $title;
        $this->addClass('modal fade');
        $this->setAttribute('tabindex', '-1');
        $this->setAttribute('aria-hidden', 'true');
    }

    /**
     * Set the modal body content.
     */
    public function body(string|Component $content): static
    {
        $this->body = (string) $content;
        return $this;
    }

    /**
     * Set the modal footer content.
     */
    public function footer(string|Component $content): static
    {
        $this->footer = (string) $content;
        return $this;
    }

    /**
     * Enable static backdrop (modal will not close when clicking outside).
     */
    public function staticBackdrop(bool $static = true): static
    {
        $this->staticBackdrop = $static;
        if ($static) {
            $this->data('bs-backdrop', 'static');
            $this->data('bs-keyboard', 'false');
        } else {
            unset($this->attributes['data-bs-backdrop']);
            unset($this->attributes['data-bs-keyboard']);
        }
        return $this;
    }

    /**
     * Center the modal vertically.
     */
    public function centered(bool $centered = true): static
    {
        $this->centered = $centered;
        return $this;
    }

    /**
     * Set the modal size (sm, lg, xl, fullscreen).
     */
    public function size(string $size): static
    {
        $this->size = $size;
        return $this;
    }

    public function render(): string
    {
        // Build the dialog class string
        $dialogClasses = ['modal-dialog'];
        if ($this->centered) {
            $dialogClasses[] = 'modal-dialog-centered';
        }
        if ($this->size) {
            $dialogClasses[] = "modal-{$this->size}";
        }
        $dialogClassString = implode(' ', $dialogClasses);

        $attributes = $this->buildAttributes();
        $labelledBy = $this->attributes['id'] . 'Label';
        // Add aria-labelledby if not manually set
        if (!isset($this->attributes['aria-labelledby'])) {
            $attributes .= sprintf(' aria-labelledby="%s"', $labelledBy);
        }

        return sprintf(
            '<div%s>
                <div class="%s">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="%s">%s</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            %s
                        </div>
                        %s
                    </div>
                </div>
            </div>',
            $attributes,
            $dialogClassString,
            $labelledBy,
            htmlspecialchars($this->title, ENT_QUOTES, 'UTF-8'),
            $this->body, // Allow HTML in body
            $this->footer ? '<div class="modal-footer">' . $this->footer . '</div>' : ''
        );
    }
}
