<?php

declare(strict_types=1);

namespace Archon\UIKit\Navigation;

use Archon\UIKit\Component;

/**
 * Represents a Bootstrap Pagination component.
 */
class Pagination extends Component
{
    private int $totalPages;
    private int $currentPage;
    private string $urlPattern; // e.g., '/page/{page}' or '?page={page}'
    private string $size = ''; // sm, lg

    /**
     * @param int $totalPages Total number of pages.
     * @param int $currentPage Current active page.
     * @param string $urlPattern Pattern for generating links. Use {page} as a placeholder.
     */
    public function __construct(int $totalPages, int $currentPage = 1, string $urlPattern = '?page={page}')
    {
        $this->totalPages = $totalPages;
        $this->currentPage = $currentPage;
        $this->urlPattern = $urlPattern;
        $this->setAttribute('aria-label', 'Page navigation');
    }

    /**
     * Set the size of the pagination (sm, lg).
     */
    public function size(string $size): static
    {
        $this->size = $size;
        return $this;
    }

    public function render(): string
    {
        $attributes = $this->buildAttributes(); // Attributes for the <nav> element

        $ulClass = 'pagination';
        if ($this->size) {
            $ulClass .= " pagination-{$this->size}";
        }

        $itemsHtml = '';

        // Previous Button
        $prevDisabled = $this->currentPage <= 1;
        $prevUrl = $prevDisabled ? '#' : str_replace('{page}', (string) ($this->currentPage - 1), $this->urlPattern);
        $itemsHtml .= sprintf(
            '<li class="page-item%s"><a class="page-link" href="%s" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>',
            $prevDisabled ? ' disabled' : '',
            htmlspecialchars($prevUrl, ENT_QUOTES, 'UTF-8')
        );

        // Page Numbers
        for ($i = 1; $i <= $this->totalPages; $i++) {
            $active = $i === $this->currentPage;
            $url = str_replace('{page}', (string) $i, $this->urlPattern);
            $itemsHtml .= sprintf(
                '<li class="page-item%s"><a class="page-link" href="%s">%d</a></li>',
                $active ? ' active' : '',
                htmlspecialchars($url, ENT_QUOTES, 'UTF-8'),
                $i
            );
        }

        // Next Button
        $nextDisabled = $this->currentPage >= $this->totalPages;
        $nextUrl = $nextDisabled ? '#' : str_replace('{page}', (string) ($this->currentPage + 1), $this->urlPattern);
        $itemsHtml .= sprintf(
            '<li class="page-item%s"><a class="page-link" href="%s" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>',
            $nextDisabled ? ' disabled' : '',
            htmlspecialchars($nextUrl, ENT_QUOTES, 'UTF-8')
        );

        return sprintf(
            '<nav%s><ul class="%s">%s</ul></nav>',
            $attributes,
            $ulClass,
            $itemsHtml
        );
    }
}
