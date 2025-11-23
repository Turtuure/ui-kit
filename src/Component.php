<?php

declare(strict_types=1);

namespace Archon\UIKit;

/**
 * Base abstract class for all UI components.
 * Provides fluent methods for managing HTML attributes and rendering.
 */
abstract class Component
{
    /**
     * @var array<string, string> Key-value pairs of HTML attributes
     */
    protected array $attributes = [];

    /**
     * @var array<string, bool> List of CSS classes (key is class name, value is existence)
     */
    protected array $classes = [];

    /**
     * Set the HTML ID attribute.
     */
    public function id(string $id): static
    {
        $this->attributes['id'] = $id;

        return $this;
    }

    /**
     * Add one or more CSS classes (space-separated).
     */
    public function addClass(string $class): static
    {
        $parts = explode(' ', $class);
        foreach ($parts as $part) {
            if (trim($part) !== '') {
                $this->classes[trim($part)] = true;
            }
        }

        return $this;
    }

    /**
     * Remove a CSS class.
     */
    public function removeClass(string $class): static
    {
        unset($this->classes[$class]);

        return $this;
    }

    /**
     * Set a specific HTML attribute.
     */
    public function setAttribute(string $key, string $value): static
    {
        $this->attributes[$key] = $value;

        return $this;
    }

    /**
     * Set a data attribute (e.g., data-toggle="modal").
     */
    public function data(string $key, string $value): static
    {
        $this->attributes["data-{$key}"] = $value;

        return $this;
    }

    /**
     * Render the component's HTML.
     */
    abstract public function render(): string;

    /**
     * Allow the object to be echoed directly.
     */
    public function __toString(): string
    {
        return $this->render();
    }

    /**
     * Helper to compile attributes and classes into a string for the HTML tag.
     */
    protected function buildAttributes(): string
    {
        $finalAttributes = $this->attributes;

        if (!empty($this->classes)) {
            // Sort classes alphabetically for consistent output
            $sortedClasses = array_keys($this->classes);
            sort($sortedClasses);
            $classString = implode(' ', $sortedClasses);

            // Specific handling if class attribute was manually set via setAttribute
            if (isset($finalAttributes['class'])) {
                // Merge and re-sort if existing class attribute is present
                $existingClasses = explode(' ', $finalAttributes['class']);
                $mergedClasses = array_unique(array_merge($existingClasses, $sortedClasses));
                sort($mergedClasses);
                $finalAttributes['class'] = implode(' ', $mergedClasses);
            } else {
                $finalAttributes['class'] = $classString;
            }
        }

        // Sort all final attributes alphabetically for consistent output
        ksort($finalAttributes);

        $html = '';
        foreach ($finalAttributes as $key => $value) {
            // Simple escaping for attribute values to prevent basic XSS in attributes
            $safeValue = htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
            $html .= sprintf(' %s="%s"', $key, $safeValue);
        }

        return $html;
    }
}