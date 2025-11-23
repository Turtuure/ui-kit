<?php

declare(strict_types=1);

namespace Archon\UIKit\DataDisplay;

use Archon\UIKit\Component;

/**
 * Represents a Bootstrap Table component.
 */
class Table extends Component
{
    private array $headers = [];
    private array $rows = [];
    private bool $striped = false;
    private bool $bordered = false;
    private bool $hover = false;
    private bool $small = false;
    private bool $responsive = false;
    private string $variant = ''; // table-dark, table-primary, etc.

    /**
     * @param array $headers Array of header strings.
     * @param array $rows 2D array of row data.
     */
    public function __construct(array $headers = [], array $rows = [])
    {
        $this->addClass('table');
        $this->headers = $headers;
        $this->rows = $rows;
    }

    /**
     * Set table headers.
     */
    public function headers(array $headers): static
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * Set table rows.
     */
    public function rows(array $rows): static
    {
        $this->rows = $rows;
        return $this;
    }

    /**
     * Enable striped rows.
     */
    public function striped(bool $striped = true): static
    {
        $this->striped = $striped;
        if ($striped) {
            $this->addClass('table-striped');
        } else {
            $this->removeClass('table-striped');
        }
        return $this;
    }

    /**
     * Enable bordered table.
     */
    public function bordered(bool $bordered = true): static
    {
        $this->bordered = $bordered;
        if ($bordered) {
            $this->addClass('table-bordered');
        } else {
            $this->removeClass('table-bordered');
        }
        return $this;
    }

    /**
     * Enable hoverable rows.
     */
    public function hover(bool $hover = true): static
    {
        $this->hover = $hover;
        if ($hover) {
            $this->addClass('table-hover');
        } else {
            $this->removeClass('table-hover');
        }
        return $this;
    }

    /**
     * Make table small.
     */
    public function small(bool $small = true): static
    {
        $this->small = $small;
        if ($small) {
            $this->addClass('table-sm');
        } else {
            $this->removeClass('table-sm');
        }
        return $this;
    }

    /**
     * Make table responsive.
     * This wraps the table in a responsive div, so it's handled in render.
     */
    public function responsive(bool $responsive = true): static
    {
        $this->responsive = $responsive;
        return $this;
    }

    /**
     * Set table variant (e.g., dark, primary, success).
     */
    public function variant(string $variant): static
    {
        // Remove previous variant classes
        foreach (['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'] as $v) {
            $this->removeClass("table-{$v}");
        }
        $this->variant = $variant;
        $this->addClass("table-{$variant}");
        return $this;
    }

    public function render(): string
    {
        $attributes = $this->buildAttributes();

        $thead = '';
        if (!empty($this->headers)) {
            $headerCells = array_map(fn($header) => sprintf('<th scope="col">%s</th>', htmlspecialchars($header, ENT_QUOTES, 'UTF-8')), $this->headers);
            $thead = sprintf('<thead><tr>%s</tr></thead>', implode('', $headerCells));
        }

        $tbody = '';
        if (!empty($this->rows)) {
            $rowHtml = array_map(function ($row) {
                $cells = array_map(fn($cell) => sprintf('<td>%s</td>', htmlspecialchars((string) $cell, ENT_QUOTES, 'UTF-8')), $row);
                return sprintf('<tr>%s</tr>', implode('', $cells));
            }, $this->rows);
            $tbody = sprintf('<tbody>%s</tbody>', implode('', $rowHtml));
        }

        $tableHtml = sprintf('<table%s>%s%s</table>', $attributes, $thead, $tbody);

        if ($this->responsive) {
            return sprintf('<div class="table-responsive">%s</div>', $tableHtml);
        }

        return $tableHtml;
    }
}
