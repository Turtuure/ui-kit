<?php

declare(strict_types=1);

namespace Archon\UIKit\DataDisplay\Lists;

use Archon\UIKit\Component;

/**
 * Represents a Bootstrap List Group component.
 */
class ListGroup extends Component
{
    private array $items = []; // Array of ['content' => string|Component, 'href' => ?string, 'active' => bool, 'disabled' => bool, 'badge' => ?Component]
    private bool $flush = false;
    private bool $numbered = false;

    /**
     * @param string|Component ...$items Initial list items.
     */
    public function __construct(string|Component ...$items)
    {
        $this->addClass('list-group');
        // Loop through and call add() for each item with defaults
        foreach ($items as $item) {
            $this->add($item);
        }
    }

    /**
     * Add a list item.
     * @param string|Component $content The content of the list item.
     * @param string|null $href If provided, renders an <a> tag, otherwise a <li>.
     * @param bool $active Whether the item is active.
     * @param bool $disabled Whether the item is disabled.
     * @param Component|null $badge Optional Badge component to append.
     */
    public function add(string|Component $content, ?string $href = null, bool $active = false, bool $disabled = false, ?Component $badge = null): static
    {
        $this->items[] = compact('content', 'href', 'active', 'disabled', 'badge');
        return $this;
    }

    /**
     * Render list group items edge-to-edge.
     */
    public function flush(bool $flush = true): static
    {
        $this->flush = $flush;
        if ($flush) {
            $this->addClass('list-group-flush');
        } else {
            $this->removeClass('list-group-flush');
        }
        return $this;
    }

    /**
     * Render as an ordered (numbered) list.
     */
    public function numbered(bool $numbered = true): static
    {
        $this->numbered = $numbered;
        if ($numbered) {
            $this->addClass('list-group-numbered');
        } else {
            $this->removeClass('list-group-numbered');
        }
        return $this;
    }

    public function render(): string
    {
        $attributes = $this->buildAttributes();

        $itemsHtml = '';
        foreach ($this->items as $item) {
            $itemClass = 'list-group-item';
            $itemAttributes = '';
            $itemContent = (string) $item['content'];

            if ($item['active']) {
                $itemClass .= ' active';
                $itemAttributes .= ' aria-current="true"';
            }
            if ($item['disabled']) {
                $itemClass .= ' disabled';
                $itemAttributes .= ' aria-disabled="true"';
            }

            if ($item['href']) {
                $tag = 'a';
                $itemClass .= ' list-group-item-action';
                $itemAttributes .= sprintf(' href="%s" ', htmlspecialchars($item['href'], ENT_QUOTES, 'UTF-8'));
            } else {
                $tag = 'li';
            }

            $badgeHtml = '';
            if ($item['badge']) {
                $badgeHtml = sprintf('<span class="ms-auto">%s</span>', $item['badge']->render());
                $itemClass .= ' d-flex justify-content-between align-items-start'; // For badges
            }

            $itemsHtml .= sprintf(
                '<%1$s class="%2$s"%3$s>%4$s%5$s</%1$s>',
                $tag,
                trim($itemClass),
                trim($itemAttributes),
                $itemContent,
                $badgeHtml
            );
        }

        $listTag = $this->numbered ? 'ol' : 'ul';

        return sprintf(
            '<%1$s%2$s>%3$s</%1$s>',
            $listTag,
            $attributes,
            $itemsHtml
        );
    }
}
