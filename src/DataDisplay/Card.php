<?php

declare(strict_types=1);

namespace Archon\UIKit\DataDisplay;

use Archon\UIKit\Component;

/**
 * Represents a Bootstrap Card component.
 */
class Card extends Component
{
    private string $header = '';
    private string $body = '';
    private string $footer = '';
    private string $imageTop = '';
    private string $imageBottom = '';
    private string $variant = ''; // bg-primary, border-success, etc.
    private string $textColor = ''; // text-white, text-primary, etc.

    /**
     * @param string|Component $body The main content for the card body.
     */
    public function __construct(string|Component $body = '')
    {
        $this->addClass('card');
        $this->body = (string) $body;
    }

    /**
     * Set the card header content.
     */
    public function header(string|Component $header): static
    {
        $this->header = (string) $header;
        return $this;
    }

    /**
     * Set the card body content.
     */
    public function body(string|Component $body): static
    {
        $this->body = (string) $body;
        return $this;
    }

    /**
     * Set the card footer content.
     */
    public function footer(string|Component $footer): static
    {
        $this->footer = (string) $footer;
        return $this;
    }

    /**
     * Set an image to appear at the top of the card.
     */
    public function imageTop(string $src, string $alt = ''): static
    {
        $this->imageTop = sprintf('<img src="%s" class="card-img-top" alt="%s">', htmlspecialchars($src), htmlspecialchars($alt));
        return $this;
    }

    /**
     * Set an image to appear at the bottom of the card.
     */
    public function imageBottom(string $src, string $alt = ''): static
    {
        $this->imageBottom = sprintf('<img src="%s" class="card-img-bottom" alt="%s">', htmlspecialchars($src), htmlspecialchars($alt));
        return $this;
    }

    /**
     * Set a background color variant (e.g., primary, success, danger) or a border variant.
     * This applies classes like `bg-primary` or `border-success`.
     */
    public function variant(string $variant): static
    {
        // Remove previous variant classes
        foreach (['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'] as $v) {
            $this->removeClass("bg-{$v}");
            $this->removeClass("border-{$v}");
        }

        $this->variant = $variant;
        $this->addClass("bg-{$variant}"); // Default to background variant
        return $this;
    }

    /**
     * Set the text color (e.g., white, primary, success).
     * Useful with dark backgrounds.
     */
    public function textColor(string $color): static
    {
        // Remove previous text color classes
        foreach (['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark', 'white', 'muted'] as $c) {
            $this->removeClass("text-{$c}");
        }

        $this->textColor = $color;
        $this->addClass("text-{$color}");
        return $this;
    }

    public function render(): string
    {
        $attributes = $this->buildAttributes();

        $headerHtml = '';
        if ($this->header) {
            $headerHtml = sprintf('<div class="card-header">%s</div>', $this->header);
        }

        $footerHtml = '';
        if ($this->footer) {
            $footerHtml = sprintf('<div class="card-footer">%s</div>', $this->footer);
        }

        // The card-body wrapper is only rendered if there's actual body content
        $bodyHtml = '';
        if ($this->body) {
            $bodyHtml = sprintf('<div class="card-body">%s</div>', $this->body);
        }

        return sprintf(
            '<div%s>%s%s%s%s%s</div>',
            $attributes,
            $this->imageTop,
            $headerHtml,
            $bodyHtml,
            $footerHtml,
            $this->imageBottom
        );
    }
}
