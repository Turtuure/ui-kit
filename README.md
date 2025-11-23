# Archon UI Kit

A comprehensive, server-side rendered PHP UI Kit built on top of **Bootstrap 5**.

The Archon UI Kit provides a fluent, object-oriented PHP interface for generating standard UI components. It eliminates the need to write repetitive HTML boilerplate while ensuring consistency, accessibility, and adherence to design tokens.

## 🚀 Features

*   **Fluent PHP Interface:** Create components with readable, chainable methods (e.g., `new Button('Click')->variant('primary')->size('lg')`).
*   **Bootstrap 5 Core:** Built on the rock-solid foundation of Bootstrap 5.3.
*   **Server-Side Rendering:** Components render directly to HTML strings, perfect for PHP-based applications.
*   **Design Tokens:** Custom CSS variables for consistent theming (`archon-ui.css`).
*   **No Heavy JS Frameworks:** Relies on standard Bootstrap JS (vanilla) and minimal custom scripts.
*   **Accessibility First:** Automatically handles `aria-*` attributes and labeling associations.

## 📦 Installation

Install via Composer:

```bash
composer require archon/ui-kit
```

(Note: This package is currently local to the Archon project monorepo.)

## 🛠 Usage

### Basic Example

```php
use Archon\UIKit\Elements\Button\Button;

echo (new Button('Save Changes'))
    ->variant('primary')
    ->size('lg')
    ->data('bs-toggle', 'modal')
    ->data('bs-target', '#saveModal');
```

### Forms

```php
use Archon\UIKit\Inputs\TextInput;
use Archon\UIKit\Inputs\Label;
use Archon\UIKit\Inputs\FormGroup;

$emailInput = (new TextInput('email', 'email'))
    ->id('userEmail')
    ->placeholder('name@example.com');

echo (new FormGroup(new Label('Email Address'), $emailInput))
    ->helpText('We will never share your email.');
```

## 💻 Development Environment

This repository includes a built-in development environment ("Showcase") to preview and test components.

### Requirements
*   PHP 8.0+
*   Composer

### Setup

1.  Clone the repository.
2.  Install dependencies:
    ```bash
    composer install
    ```
3.  Start a local server pointing to the `public` directory:
    ```bash
    php -S localhost:8000 -t public
    ```
    Or use a tool like **Laragon**, **XAMPP**, or **Valet**.

4.  Visit `http://localhost:8000` in your browser.

## 🏗 Component Library

### Elements
*   **Buttons:** Primary, secondary, outline, sizes.
*   **Badges:** Status indicators, pills.
*   **Spinners:** Loading states.
*   **Typography:** Text and Headings with local font support (Inter).

### Forms
*   **Text Inputs:** Text, email, password, etc.
*   **Textarea:** Multi-line input.
*   **Selects:** Standard and multi-select dropdowns.
*   **Checks & Radios:** Individual and grouped selection controls.
*   **Form Groups:** Label + Input + Help Text/Validation wrapper.

### Navigation
*   **Navbar:** Responsive headers.
*   **Navs:** Tabs, pills, vertical lists.
*   **Breadcrumbs:** Location hierarchy.
*   **Pagination:** Multi-page controls.
*   **Drawers (Offcanvas):** Slide-in sidebars.
*   **Steppers:** Multi-step process indicators.

### Overlays
*   **Modals:** Dialogs with static backdrop support.
*   **Tooltips:** Hover information.
*   **Popovers:** Click-triggered information.
*   **Toasts:** Push notifications.

### Data Display
*   **Cards:** Flexible content containers.
*   **Tables:** Styled, responsive data tables.
*   **List Groups:** Simple or complex lists of items.

## 🧪 Testing

Run the PHPUnit test suite:

```bash
vendor/bin/phpunit
```

## 📄 License

MIT License. See `LICENSE` file for details.
