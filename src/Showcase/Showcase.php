<?php

declare(strict_types=1);

namespace Archon\UIKit\Showcase;

class Showcase
{
    /**
     * Renders a component example with a title, description, and the component itself.
     */
    public static function example(string $title, string $description, callable $renderCallback, ?string $codeSnippet = null): void
    {
        echo '<div class="card mb-4">';
        echo '    <div class="card-header">';
        echo '        <h5 class="card-title mb-0">' . htmlspecialchars($title) . '</h5>';
        echo '    </div>
';
        echo '    <div class="card-body">';
        echo '        <p class="card-text text-muted mb-3">' . htmlspecialchars($description) . '</p>';
        echo '        <div class="p-3 border rounded mb-3 bg-light d-flex flex-wrap align-items-center justify-content-start gap-2">';
        // Execute the callback to render the component
        $renderCallback();
        echo '        </div>';
        if ($codeSnippet) {
            // Using our custom class 'code-snippet' defined in archon-ui.css
            echo '        <pre class="code-snippet"><code>' . htmlspecialchars($codeSnippet) . '</code></pre>';
        }
        echo '    </div>';
        echo '</div>';
    }
}