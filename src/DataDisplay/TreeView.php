<?php

declare(strict_types=1);

namespace Archon\UIKit\DataDisplay;

use Archon\UIKit\Component;

/**
 * Represents a hierarchical Tree View using semantic <details> and <summary> elements.
 */
class TreeView extends Component
{
    private array $data = [];
    private bool $open = false; // Default open state for top level

    /**
     * @param array $data Nested array of data. Keys are folders, values are children or leaves.
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
        $this->addClass('tree-view');
    }

    /**
     * Set the data for the tree.
     */
    public function setData(array $data): static
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Set default open state for details elements.
     */
    public function open(bool $open = true): static
    {
        $this->open = $open;
        return $this;
    }

    public function render(): string
    {
        $attributes = $this->buildAttributes();
        $content = $this->renderNodes($this->data);

        return sprintf('<div%s>%s</div>', $attributes, $content);
    }

    private function renderNodes(array $nodes): string
    {
        $html = '<ul class="list-unstyled ps-3">';
        
        foreach ($nodes as $key => $value) {
            $html .= '<li class="mb-1">';
            
            if (is_array($value)) {
                // It's a folder (node with children)
                $label = htmlspecialchars((string)$key, ENT_QUOTES, 'UTF-8');
                $children = $this->renderNodes($value);
                $openAttr = $this->open ? ' open' : '';
                
                $html .= sprintf(
                    '<details%s><summary class="fw-bold cursor-pointer">%s</summary>%s</details>',
                    $openAttr,
                    $label,
                    $children
                );
            } else {
                // It's a leaf
                $label = htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
                // If the key is string and value is string, maybe key is label and value is something else? 
                // For simple arrays ['Item 1', 'Item 2'], key is int.
                // For ['Folder' => [...]], key is string.
                // Let's support ['Label' => 'Url/Value'] later? For now, strict tree structure.
                
                // If key is not integer, use key as label and value as... text?
                if (!is_int($key)) {
                     $label = sprintf('<strong>%s</strong>: %s', 
                        htmlspecialchars((string)$key, ENT_QUOTES, 'UTF-8'),
                        $label
                     );
                }
                
                $html .= sprintf('<span><i class="bi bi-file-earmark text-muted me-1"></i>%s</span>', $label);
            }
            
            $html .= '</li>';
        }
        
        $html .= '</ul>';
        return $html;
    }
}
