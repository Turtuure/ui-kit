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
$page = $_GET['page'] ?? 'home'; // Default to 'home' page
$showcasePath = __DIR__ . '/showcase/' . $page . '.php';

// Ensure only allowed pages are loaded and prevent directory traversal
$allowedPages = [
    'home',
    'buttons',
    'forms',
    'layout',
    'alerts',
    'typography',
    // Add new component pages here as they are created
];

if (!in_array($page, $allowedPages, true) || !file_exists($showcasePath)) {
    $page = 'home'; // Fallback to home if page is not allowed or doesn't exist
    $showcasePath = __DIR__ . '/showcase/home.php';
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
    
    <!-- Bootstrap Icons CDN (for reliability of font files) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        /* Global body styling to ensure our custom fonts/colors apply */
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column; /* Allow content to flow vertically */
            align-items: center;
            padding: 2rem;
            margin: 0;
        }
        .hero-card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            padding: 2rem; /* Slightly reduced padding */
            max-width: 1200px; /* Increased max-width for sidebar + content */
            width: 100%;
            display: flex; /* Use flexbox for main content area */
            flex-direction: row; /* Sidebar and content side-by-side */
            align-items: flex-start; /* Align items to the top */
        }
        .sidebar {
            min-width: 220px; /* Fixed width for sidebar */
            margin-right: 2rem;
            padding-top: 1rem;
            border-right: 1px solid var(--archon-gray-200);
            height: 100%; /* Take full height of parent */
        }
        .sidebar .nav-link {
            font-weight: 500;
            color: var(--archon-text-base);
            padding: 0.5rem 1rem;
        }
        .sidebar .nav-link.active {
            color: var(--archon-primary);
            background-color: var(--archon-gray-100);
            border-radius: 0.375rem;
        }
        .content-area {
            flex-grow: 1;
            padding-left: 2rem;
        }
        .showcase-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .showcase-header h1, .showcase-header p {
            margin-bottom: 0;
        }
    </style>
</head>
<body>

    <div class="hero-card">
        <div class="sidebar d-none d-md-block">
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-1 mb-1 text-muted text-uppercase">
                <span>Components</span>
            </h6>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link <?php echo ($page === 'home') ? 'active' : ''; ?>" href="/?page=home">
                        <i class="bi bi-house me-2"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($page === 'buttons') ? 'active' : ''; ?>" href="/?page=buttons">
                        <i class="bi bi-box-fill me-2"></i> Buttons
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($page === 'forms') ? 'active' : ''; ?>" href="/?page=forms">
                        <i class="bi bi-ui-checks me-2"></i> Forms
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($page === 'layout') ? 'active' : ''; ?>" href="/?page=layout">
                        <i class="bi bi-grid-3x3-gap me-2"></i> Layout
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($page === 'alerts') ? 'active' : ''; ?>" href="/?page=alerts">
                        <i class="bi bi-info-circle-fill me-2"></i> Alerts
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($page === 'typography') ? 'active' : ''; ?>" href="/?page=typography">
                        <i class="bi bi-fonts me-2"></i> Typography
                    </a>
                </li>
                <!-- New components will be added here -->
            </ul>
        </div>

        <div class="content-area">
            <div class="showcase-header mb-4">
                <div class="text-center mb-4">
                    <i class="bi bi-box-seam text-primary" style="font-size: 3rem;"></i>
                    <h1 class="display-6 fw-bold mb-1">Archon UI Kit</h1>
                    <p class="lead text-muted">Development Environment</p>
                </div>
                <hr class="my-4 opacity-25">
                <div class="d-flex justify-content-center gap-3 mb-4">
                    <div class="d-flex align-items-center text-small text-muted">
                        <i class="bi bi-check-circle-fill text-success me-2"></i> Environment Ready
                    </div>
                    
                    <?php if ($composerLoaded): ?>
                        <div class="d-flex align-items-center text-small text-success">
                            <i class="bi bi-check-circle-fill me-2"></i> Dependencies Loaded
                        </div>
                    <?php else: ?>
                        <div class="d-flex align-items-center text-small text-warning">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i> Composer not installed. Run `composer install`
                        </div>
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

    <!-- Local Bootstrap JS -->
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>