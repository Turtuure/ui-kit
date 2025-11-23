<?php

declare(strict_types=1);

namespace Archon\UIKit\Navigation;

use Archon\UIKit\Component;

/**
 * Represents a Bootstrap Breadcrumb component.
 */
class Breadcrumb extends Component
{
    private array $items = []; // Array of ['text' => string, 'href' => ?string, 'active' => bool]

    /**
     * @param array $items Associative array of 'Text' => 'URL'. The last item is typically active.
     */
    public function __construct(array $items = [])
    {
        $this->setAttribute('aria-label', 'breadcrumb');
        foreach ($items as $text => $href) {
            $this->add($text, $href);
        }
    }

    /**
     * Add a breadcrumb item.
     * @param string $text The text to display.
     * @param string|null $href The URL. If null, the item is considered active (current page).
     */
    public function add(string $text, ?string $href = null): static
    {
        $this->items[] = [
            'text' => $text,
            'href' => $href,
            'active' => ($href === null)
        ];
        return $this;
    }

    public function render(): string
    {
        $attributes = $this->buildAttributes(); // Usually empty for <nav> or custom classes

        $itemsHtml = '';
        foreach ($this->items as $item) {
            $itemContent = htmlspecialchars($item['text'], ENT_QUOTES, 'UTF-8');
            $liClass = 'breadcrumb-item';
            $ariaCurrent = '';

            if ($item['active']) {
                $liClass .= ' active';
                $ariaCurrent = ' aria-current="page"';
            } else {
                $itemContent = sprintf('<a href="%s">%s</a>', htmlspecialchars($item['href'], ENT_QUOTES, 'UTF-8'), $itemContent);
            }

            $itemsHtml .= sprintf('<li class="%s"%s>%s</li>', $liClass, $ariaCurrent, $itemContent);
        }

        return sprintf(
            '<nav%s><ol class="breadcrumb">%s</ol></nav>',
            $attributes,
            $itemsHtml
        );
    }
}
