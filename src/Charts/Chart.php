<?php

declare(strict_types=1);

namespace Archon\UIKit\Charts;

use Archon\UIKit\Component;

/**
 * Represents a Chart.js chart component.
 * Renders a canvas and the associated JavaScript initialization.
 */
class Chart extends Component
{
    private string $type;
    private array $data = [
        'labels' => [],
        'datasets' => []
    ];
    private array $options = [
        'responsive' => true,
    ];

    /**
     * @param string $type Chart type (bar, line, pie, doughnut).
     */
    public function __construct(string $type = 'bar')
    {
        $this->type = $type;
        $this->id(uniqid('chart_')); // Default unique ID
    }

    /**
     * Set the labels for the chart.
     */
    public function labels(array $labels): static
    {
        $this->data['labels'] = $labels;
        return $this;
    }

    /**
     * Add a dataset to the chart.
     * @param string $label Label for the dataset.
     * @param array $data Data points.
     * @param string|array|null $backgroundColor Background color(s).
     * @param string|array|null $borderColor Border color(s).
     */
    public function addDataset(string $label, array $data, string|array|null $backgroundColor = null, string|array|null $borderColor = null): static
    {
        $dataset = [
            'label' => $label,
            'data' => $data,
            'borderWidth' => 1
        ];

        if ($backgroundColor) {
            $dataset['backgroundColor'] = $backgroundColor;
        }
        if ($borderColor) {
            $dataset['borderColor'] = $borderColor;
        }

        $this->data['datasets'][] = $dataset;
        return $this;
    }

    public function render(): string
    {
        $id = $this->attributes['id'];
        $config = [
            'type' => $this->type,
            'data' => $this->data,
            'options' => $this->options
        ];
        $jsonConfig = json_encode($config);

        $canvas = sprintf('<canvas id="%s" width="400" height="200"></canvas>', $id);
        
        // Script to initialize chart. Assumes Chart.js is loaded.
        // Using a small helper check to ensure script doesn't crash if Chart is missing (though it shouldn't be).
        $script = sprintf('
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    if (typeof Chart !== "undefined") {
                        const ctx = document.getElementById("%s").getContext("2d");
                        new Chart(ctx, %s);
                    } else {
                        console.error("Chart.js is not loaded.");
                    }
                });
            </script>
        ', $id, $jsonConfig);

        return $canvas . $script;
    }
}
