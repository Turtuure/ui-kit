<?php

declare(strict_types=1);

namespace Archon\UIKit\Overlays;

use Archon\UIKit\Component;

/**
 * Represents a Bootstrap Toast component.
 */
class Toast extends Component
{
    private string $headerContent = '';
    private string $bodyContent = '';
    private string $time = '';
    private bool $autohide = true;
    private int $delay = 5000;

    public function __construct(string $header, string $body)
    {
        $this->headerContent = $header;
        $this->bodyContent = $body;
        
        $this->addClass('toast');
        $this->setAttribute('role', 'alert');
        $this->setAttribute('aria-live', 'assertive');
        $this->setAttribute('aria-atomic', 'true');
    }

    /**
     * Set the time indicator text (e.g., "11 mins ago").
     */
    public function time(string $time): static
    {
        $this->time = $time;
        return $this;
    }

    /**
     * Set autohide behavior.
     */
    public function autohide(bool $autohide = true): static
    {
        $this->autohide = $autohide;
        $this->data('bs-autohide', $autohide ? 'true' : 'false');
        return $this;
    }

    /**
     * Set delay in milliseconds before hiding.
     */
    public function delay(int $delay): static
    {
        $this->delay = $delay;
        $this->data('bs-delay', (string) $delay);
        return $this;
    }

    public function render(): string
    {
        $attributes = $this->buildAttributes();

        $timeHtml = '';
        if ($this->time) {
            $timeHtml = sprintf('<small>%s</small>', htmlspecialchars($this->time, ENT_QUOTES, 'UTF-8'));
        }

        return sprintf(
            '<div%s>
                <div class="toast-header">
                    <strong class="me-auto">%s</strong>
                    %s
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    %s
                </div>
            </div>',
            $attributes,
            $this->headerContent, // Allow HTML in header (e.g., icons)
            $timeHtml,
            $this->bodyContent // Allow HTML in body
        );
    }
}
