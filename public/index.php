<?php

declare(strict_types=1);

/**
 * Archon UI Kit Development Entry Point
 */

// 1. Autoloading
$autoloadPath = __DIR__ . '/../vendor/autoload.php';
$composerLoaded = false;
if (file_exists($autoloadPath)) {
    require_once $autoloadPath;
    $composerLoaded = true;
}

// 2. Routing Logic
$page = $_GET['page'] ?? 'home';
$showcasePath = __DIR__ . '/showcase/' . $page . '.php';

// Sanitize page input to allow alphanumeric, dashes, and slashes only
if (!preg_match('/^[a-z0-9\-\/]+$/', $page) || !file_exists($showcasePath)) {
    $page = 'home';
    $showcasePath = __DIR__ . '/showcase/home.php';
}

// Helper to check active state for menu items
function isActive(string $current, string $target): string {
    return $current === $target ? 'active' : '';
}

// Helper to check active state for menu groups (to keep them open)
function isGroupActive(string $current, string $groupPrefix): bool {
    return strpos($current, $groupPrefix) === 0;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archon UI Kit - Dev Environment</title>
    
    <!-- Local Bootstrap CSS -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Archon UI Kit Custom Styles -->
    <link href="/assets/css/archon-ui.css" rel="stylesheet">
    
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Local Bootstrap JS -->
    <script src="/assets/js/bootstrap.bundle.min.js" defer></script>
    
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            margin: 0;
            background-color: var(--archon-bg-body);
        }
        
        /* Sidebar Styling */
        .sidebar {
            width: 280px;
            border-right: 1px solid var(--archon-border-color);
            background-color: var(--archon-bg-surface);
            height: 100vh;
            position: sticky;
            top: 0;
            overflow-y: auto;
            padding-top: 1rem;
        }
        
        .sidebar .nav-link {
            color: var(--archon-text-base);
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            margin-bottom: 0.125rem;
        }
        
        .sidebar .nav-link:hover {
            background-color: var(--archon-bg-hover);
        }
        
        .sidebar .nav-link.active {
            color: var(--archon-primary);
            background-color: rgba(13, 110, 253, 0.1); /* Light primary bg */
            font-weight: 600;
        }

        .sidebar .btn-toggle {
            display: inline-flex;
            align-items: center;
            padding: .5rem 1rem;
            width: 100%;
            font-weight: 600;
            color: var(--archon-text-muted);
            background-color: transparent;
            border: 0;
            text-align: left;
        }
        
        .sidebar .btn-toggle:hover,
        .sidebar .btn-toggle[aria-expanded="true"] {
            color: var(--archon-text-base);
            background-color: var(--archon-bg-hover);
        }

        .sidebar .btn-toggle::after {
            width: 1.25em;
            line-height: 0;
            content: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='rgba%280,0,0,.5%29' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 14l6-6-6-6'/%3e%3c/svg%3e");
            transition: transform .35s ease;
            transform-origin: .5em 50%;
            margin-left: auto;
        }

        .sidebar .btn-toggle[aria-expanded="true"]::after {
            transform: rotate(90deg);
        }

        .sidebar .btn-toggle-nav .nav-link {
            padding-left: 2.5rem; /* Indent child items */
            font-size: 0.95rem;
        }

        /* Content Area */
        .main-content {
            flex: 1;
            padding: 2rem;
            overflow-y: auto;
            height: 100vh;
        }
        
        .content-card {
            background: var(--archon-bg-surface);
            border-radius: var(--archon-border-radius-lg);
            padding: 2rem;
            box-shadow: var(--archon-shadow-sm);
            height: 100%; /* Fill height if content is short */
        }
    </style>
</head>
<body>

<div class="d-flex w-100">
    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column flex-shrink-0 p-3">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none px-3">
            <i class="bi bi-box-seam text-primary fs-4 me-2"></i>
            <span class="fs-5 fw-bold">Archon UI</span>
        </a>
        <hr>
        <ul class="nav flex-column mb-auto list-unstyled ps-0">
            <li class="mb-1">
                <a href="/?page=home" class="nav-link <?php echo isActive($page, 'home'); ?>">
                    <i class="bi bi-house-door me-2"></i> Home
                </a>
            </li>

            <!-- Elements -->
            <li class="mb-1">
                <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#elements-collapse" aria-expanded="<?php echo isGroupActive($page, 'elements/') ? 'true' : 'false'; ?>">
                    <i class="bi bi-puzzle me-2"></i> Elements
                </button>
                <div class="collapse <?php echo isGroupActive($page, 'elements/') ? 'show' : ''; ?>" id="elements-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="/?page=elements/buttons" class="nav-link <?php echo isActive($page, 'elements/buttons'); ?>">Buttons</a></li>
                        <li><a href="/?page=elements/spinners" class="nav-link <?php echo isActive($page, 'elements/spinners'); ?>">Spinners</a></li>
                        <li><a href="/?page=elements/typography" class="nav-link <?php echo isActive($page, 'elements/typography'); ?>">Typography</a></li>
                    </ul>
                </div>
            </li>

            <!-- Forms -->
            <li class="mb-1">
                <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#forms-collapse" aria-expanded="<?php echo isGroupActive($page, 'forms/') ? 'true' : 'false'; ?>">
                    <i class="bi bi-ui-checks me-2"></i> Forms
                </button>
                <div class="collapse <?php echo isGroupActive($page, 'forms/') ? 'show' : ''; ?>" id="forms-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="/?page=forms/text-inputs" class="nav-link <?php echo isActive($page, 'forms/text-inputs'); ?>">Text Inputs</a></li>
                        <li><a href="/?page=forms/checks-radios" class="nav-link <?php echo isActive($page, 'forms/checks-radios'); ?>">Checks & Radios</a></li>
                        <li><a href="/?page=forms/selects" class="nav-link <?php echo isActive($page, 'forms/selects'); ?>">Selects</a></li>
                        <li><a href="/?page=forms/advanced" class="nav-link <?php echo isActive($page, 'forms/advanced'); ?>">Advanced</a></li>
                    </ul>
                </div>
            </li>

            <!-- Navigation -->
            <li class="mb-1">
                <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#navigation-collapse" aria-expanded="<?php echo isGroupActive($page, 'navigation/') ? 'true' : 'false'; ?>">
                    <i class="bi bi-compass me-2"></i> Navigation
                </button>
                <div class="collapse <?php echo isGroupActive($page, 'navigation/') ? 'show' : ''; ?>" id="navigation-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="/?page=navigation/navs" class="nav-link <?php echo isActive($page, 'navigation/navs'); ?>">Base Nav</a></li>
                        <li><a href="/?page=navigation/navbar" class="nav-link <?php echo isActive($page, 'navigation/navbar'); ?>">Navbar</a></li>
                        <li><a href="/?page=navigation/breadcrumbs" class="nav-link <?php echo isActive($page, 'navigation/breadcrumbs'); ?>">Breadcrumbs</a></li>
                        <li><a href="/?page=navigation/pagination" class="nav-link <?php echo isActive($page, 'navigation/pagination'); ?>">Pagination</a></li>
                        <li><a href="/?page=navigation/drawers" class="nav-link <?php echo isActive($page, 'navigation/drawers'); ?>">Drawers</a></li>
                        <li><a href="/?page=navigation/steppers" class="nav-link <?php echo isActive($page, 'navigation/steppers'); ?>">Steppers</a></li>
                    </ul>
                </div>
            </li>

            <!-- Overlays -->
            <li class="mb-1">
                <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#overlays-collapse" aria-expanded="<?php echo isGroupActive($page, 'overlays/') ? 'true' : 'false'; ?>">
                    <i class="bi bi-window-stack me-2"></i> Overlays
                </button>
                <div class="collapse <?php echo isGroupActive($page, 'overlays/') ? 'show' : ''; ?>" id="overlays-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="/?page=overlays/modals" class="nav-link <?php echo isActive($page, 'overlays/modals'); ?>">Modals</a></li>
                        <li><a href="/?page=overlays/tooltips" class="nav-link <?php echo isActive($page, 'overlays/tooltips'); ?>">Tooltips</a></li>
                        <li><a href="/?page=overlays/popovers" class="nav-link <?php echo isActive($page, 'overlays/popovers'); ?>">Popovers</a></li>
                        <li><a href="/?page=overlays/toasts" class="nav-link <?php echo isActive($page, 'overlays/toasts'); ?>">Toasts</a></li>
                    </ul>
                </div>
            </li>

            <!-- Data Display -->
            <li class="mb-1">
                <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#data-collapse" aria-expanded="<?php echo isGroupActive($page, 'data-display/') ? 'true' : 'false'; ?>">
                    <i class="bi bi-table me-2"></i> Data Display
                </button>
                <div class="collapse <?php echo isGroupActive($page, 'data-display/') ? 'show' : ''; ?>" id="data-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="/?page=data-display/cards" class="nav-link <?php echo isActive($page, 'data-display/cards'); ?>">Cards</a></li>
                        <li><a href="/?page=data-display/tables" class="nav-link <?php echo isActive($page, 'data-display/tables'); ?>">Tables</a></li>
                        <li><a href="/?page=data-display/badges" class="nav-link <?php echo isActive($page, 'data-display/badges'); ?>">Badges</a></li>
                        <li><a href="/?page=data-display/list-groups" class="nav-link <?php echo isActive($page, 'data-display/list-groups'); ?>">List Groups</a></li>
                        <li><a href="/?page=data-display/tree-view" class="nav-link <?php echo isActive($page, 'data-display/tree-view'); ?>">Tree View</a></li>
                    </ul>
                </div>
            </li>

            <!-- Media -->
            <li class="mb-1">
                <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#media-collapse" aria-expanded="<?php echo isGroupActive($page, 'media/') ? 'true' : 'false'; ?>">
                    <i class="bi bi-film me-2"></i> Media
                </button>
                <div class="collapse <?php echo isGroupActive($page, 'media/') ? 'show' : ''; ?>" id="media-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="/?page=media/players" class="nav-link <?php echo isActive($page, 'media/players'); ?>">Players</a></li>
                    </ul>
                </div>
            </li>

            <!-- Data Viz -->
            <li class="mb-1">
                <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#dataviz-collapse" aria-expanded="<?php echo isGroupActive($page, 'data-viz/') ? 'true' : 'false'; ?>">
                    <i class="bi bi-graph-up me-2"></i> Data Viz
                </button>
                <div class="collapse <?php echo isGroupActive($page, 'data-viz/') ? 'show' : ''; ?>" id="dataviz-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="/?page=data-viz/charts" class="nav-link <?php echo isActive($page, 'data-viz/charts'); ?>">Charts</a></li>
                    </ul>
                </div>
            </li>

            <!-- Layout -->
            <li class="mb-1">
                <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#layout-collapse" aria-expanded="<?php echo isGroupActive($page, 'layout/') ? 'true' : 'false'; ?>">
                    <i class="bi bi-grid-3x3-gap me-2"></i> Layout
                </button>
                <div class="collapse <?php echo isGroupActive($page, 'layout/') ? 'show' : ''; ?>" id="layout-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="/?page=layout/grid" class="nav-link <?php echo isActive($page, 'layout/grid'); ?>">Grid System</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="d-flex justify-content-end mb-3">
            <div class="text-small text-muted d-flex align-items-center">
                <?php if ($composerLoaded): ?>
                    <i class="bi bi-check-circle-fill text-success me-2"></i> Archon Environment Ready
                <?php else: ?>
                    <i class="bi bi-exclamation-triangle-fill text-warning me-2"></i> Composer Missing
                <?php endif; ?>
            </div>
        </div>

        <?php if ($composerLoaded):
            // Include the component showcase file
            include $showcasePath;
        else:
        ?>
            <div class="text-center py-5">
                <p class="lead text-danger">Composer dependencies are not loaded. Please run `composer install`.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>