# Testing Archon UI Kit

This document outlines how to run and write tests for the Archon UI Kit. Maintaining a robust test suite is crucial for ensuring the quality, stability, and reliability of our UI components.

## Testing Philosophy

Our goal is to ensure that each UI component:
*   Renders correct and semantic HTML output.
*   Applies Bootstrap classes and attributes as expected.
*   Handles various states (e.g., active, disabled, valid, invalid) correctly.
*   Maintains expected behavior across different configurations.
*   Does not introduce regressions when changes are made.

## Prerequisites

Before running tests, ensure you have:
*   PHP 8.0+ installed.
*   Composer installed.
*   The project dependencies installed: `composer install`.
*   (Optional but Recommended) PHP extension for code coverage (e.g., Xdebug or PCOV) for generating coverage reports.

## Running Tests

All tests are written using [PHPUnit](https://phpunit.de/).

### Run All Tests
To execute the entire test suite:

```bash
vendor/bin/phpunit
```

### Run Specific Test Suite
To run tests only for a specific component category (e.g., `Elements`):

```bash
vendor/bin/phpunit tests/Elements
```

### Run a Single Test File
To run tests from a specific file (e.g., `ButtonTest.php`):

```bash
vendor/bin/phpunit tests/Elements/Button/ButtonTest.php
```

### Generate Code Coverage Report
If you have Xdebug or PCOV installed and enabled, you can generate an HTML code coverage report:

```bash
vendor/bin/phpunit --coverage-html build/coverage
```

Open `build/coverage/index.html` in your browser to view the report.

## Writing New Tests

When adding new components or fixing bugs, new tests are required.

### Test Directory Structure
Tests should mirror the `src/` directory structure. For example, tests for `src/Elements/Button/Button.php` are found in `tests/Elements/Button/ButtonTest.php`.

### Test File Naming
Test files should be named `[ComponentName]Test.php`.

### Basic Test Example

```php
<?php

declare(strict_types=1);

namespace Archon\UIKit\Tests\NewCategory;

use Archon\UIKit\NewCategory\MyComponent;
use PHPUnit\Framework\TestCase;

final class MyComponentTest extends TestCase
{
    public function testMyComponentRendersCorrectly(): void
    {
        $component = new MyComponent('Hello');
        $html = $component->render();
        
        $this->assertStringContainsString('<div class="my-component-class">Hello</div>', $html);
    }

    public function testMyComponentWithOption(): void
    {
        $component = (new MyComponent('Test'))->option(true);
        $html = $component->render();
        
        $this->assertStringContainsString('data-option="true"', $html);
    }
}
```

### Assertions
We primarily use `assertStringContainsString` and `assertStringNotContainsString` to check for the presence or absence of specific HTML snippets, classes, and attributes. Be mindful that HTML attribute order can vary, so focus on individual parts rather than exact full tag matches.

## Continuous Integration

All tests are automatically run on every Pull Request to the `main` branch via GitHub Actions. This helps ensure that no changes are merged that break existing functionality or introduce new issues.
