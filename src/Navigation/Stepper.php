<?php

declare(strict_types=1);

namespace Archon\UIKit\Navigation;

use Archon\UIKit\Component;

/**
 * Represents a custom Stepper component for multi-step wizards.
 * Uses Bootstrap utilities to create a visual step indicator.
 */
class Stepper extends Component
{
    private array $steps = []; // Array of ['label' => string, 'status' => 'active'|'completed'|'pending']
    private bool $vertical = false;

    /**
     * @param array $steps Array of step labels.
     * @param int $currentStep 1-based index of the current active step.
     */
    public function __construct(array $steps = [], int $currentStep = 1)
    {
        $this->addClass('d-flex justify-content-between align-items-center mb-4');
        
        foreach ($steps as $index => $label) {
            $stepNumber = $index + 1;
            $status = 'pending';
            if ($stepNumber < $currentStep) {
                $status = 'completed';
            } elseif ($stepNumber === $currentStep) {
                $status = 'active';
            }
            $this->addStep($label, $status);
        }
    }

    /**
     * Add a step manually.
     */
    public function addStep(string $label, string $status = 'pending'): static
    {
        $this->steps[] = compact('label', 'status');
        return $this;
    }

    public function vertical(bool $vertical = true): static
    {
        $this->vertical = $vertical;
        if ($vertical) {
            $this->removeClass('flex-row justify-content-between align-items-center');
            $this->addClass('flex-column align-items-start gap-3');
        } else {
            $this->addClass('flex-row justify-content-between align-items-center');
            $this->removeClass('flex-column align-items-start gap-3');
        }
        return $this;
    }

    public function render(): string
    {
        $attributes = $this->buildAttributes();
        $stepsHtml = '';

        foreach ($this->steps as $index => $step) {
            $stepNumber = $index + 1;
            $statusClass = '';
            $iconHtml = sprintf('<span class="step-number">%d</span>', $stepNumber);

            switch ($step['status']) {
                case 'completed':
                    $statusClass = 'text-success';
                    $iconHtml = '<i class="bi bi-check-circle-fill"></i>'; // Bootstrap Icon check
                    break;
                case 'active':
                    $statusClass = 'text-primary fw-bold';
                    $iconHtml = sprintf('<span class="badge rounded-pill bg-primary">%d</span>', $stepNumber);
                    break;
                case 'pending':
                default:
                    $statusClass = 'text-muted';
                    $iconHtml = sprintf('<span class="badge rounded-pill bg-secondary">%d</span>', $stepNumber);
                    break;
            }

            $stepsHtml .= sprintf(
                '<div class="step-item d-flex align-items-center %s">
                    <div class="fs-4 me-2">%s</div>
                    <div>%s</div>
                </div>',
                $statusClass,
                $iconHtml,
                htmlspecialchars($step['label'], ENT_QUOTES, 'UTF-8')
            );
            
            // Add a connector line between steps if horizontal and not the last step
            if (!$this->vertical && $index < count($this->steps) - 1) {
                 $stepsHtml .= '<div class="flex-grow-1 border-top border-2 mx-3 text-muted opacity-25"></div>';
            }
        }

        return sprintf('<div%s>%s</div>', $attributes, $stepsHtml);
    }
}
