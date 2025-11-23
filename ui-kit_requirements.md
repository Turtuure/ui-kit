# PHP & Bootstrap UI Kit Requirements and Implementation Guide

This document outlines the technical specifications, architecture, and implementation plan for a server-side rendered UI Kit using **PHP**, **Bootstrap**, and **Vanilla CSS**.

## 1. Technical Architecture

### 1.1. Technology Stack
*   **Backend:** PHP 8.x (Strict Typing).
*   **CSS Framework:** Bootstrap 5 (Latest Stable).
*   **Custom Styling:** Vanilla CSS (utilizing CSS Variables/Custom Properties) for theme overrides and custom components not covered by Bootstrap.
*   **JavaScript:** Vanilla JavaScript (ES6+). No heavy frontend frameworks (React/Vue). Reliance on Bootstrap's native JS (via `data-bs-*` attributes) where possible.

### 1.2. Component Structure (PHP)
Each UI component will be a reusable PHP Class or Trait.
*   **Input:** Components accept parameters (props) via their Constructor or Fluent Setters.
*   **Output:** A `render()` method returns the raw HTML string.
*   **Escaping:** All text inputs must be automatically escaped to prevent XSS.

**Example Pattern:**
```php
echo (new Button('Submit'))
    ->setType('submit')
    ->addClass('btn-primary')
    ->render();
```

## 2. State Management Strategy

Since this is a server-side rendered (SSR) architecture, "State Management" is split into two distinct lifecycles:

### 2.1. Server-Side State (Data & Persistence)
*   **Responsibility:** PHP.
*   **Mechanism:** Data is passed to components during instantiation.
*   **Persistence:** Form inputs, validation errors, and flash messages are maintained via PHP Sessions/Requests and re-injected into components upon page reload.
    *   *Example:* A text input component checks if `$_SESSION['old_input']['email']` exists and pre-fills the `value` attribute.

### 2.2. Client-Side State (Interactivity)
*   **Responsibility:** Bootstrap JS & Vanilla JS.
*   **Mechanism:** Ephemeral UI state (is the modal open? is the dropdown expanded?) is handled by the browser DOM.
*   **Events:** Custom Vanilla JS Event Listeners will be used for complex interactions that go beyond standard Bootstrap behavior (e.g., dynamic data fetching for a search bar).

## 3. Design System & Tokens

We will strictly adhere to a token-based design system using CSS Variables, overriding Bootstrap defaults where necessary.

*   **Colors:** `--primary`, `--secondary`, `--success`, `--danger`, `--surface-bg`, `--text-main`.
*   **Spacing:** Mapping Bootstrap's spacing utility (`p-1` to `p-5`) to consistent rem-based variables.
*   **Typography:** Standardized font-families, line-heights, and scaling.

## 4. Implementation Roadmap (MoSCoW)

Components are categorized by priority and complexity.

### Phase 1: The Foundation (Must Have)
*Essential building blocks required for 80% of the UI.*

*   **Layout & Grid:** Container, Row, Column (Wrappers around Bootstrap Grid).
*   **Typography:** Headings, Paragraphs, Blockquotes, Text Utilities.
*   **Buttons:** Variants (Primary, Secondary, Outline, Link), Sizes, Loading State.
*   **Forms (Basic):** Text Input, Textarea, Checkbox, Radio, Select, Labels, Help Text, Error States.
*   **Alerts:** Static success/error/warning messages.
*   **Icons:** Integration mechanism (SVG or Font Icon wrapper).

### Phase 2: Interactive Molecules (Should Have)
*Components requiring JavaScript interaction or complex HTML structures.*

*   **Navigation:** Navbar, Breadcrumbs, Pagination, Tabs/Pills.
*   **Overlays:** Modals, Tooltips, Popovers, Toasts (Notification messages).
*   **Data Display:** Tables (Basic), Badges, Lists (Grouped), Cards (Headers, Footers, Bodies).
*   **Dropdowns:** Standard and Split-button dropdowns.
*   **Spinners/Loaders:** Integration with buttons and full-page overlays.

### Phase 3: Complex Organisms (Could Have)
*Advanced components for specific use cases.*

*   **Advanced Forms:** Date Pickers (JS wrapper), File Uploaders (with preview), Rich Text Editors, Multi-selects.
*   **Data Viz:** Charts/Graphs wrappers.
*   **Wizards:** Steppers with server-side validation handling between steps.
*   **Drawers/Offcanvas:** Slide-in sidebars.
*   **Tree Views:** Hierarchical data display.

## 5. Definition of Done (Component Standards)

Every PHP component must meet these criteria before acceptance:

1.  **Render Method:** Must return valid, semantic HTML.
2.  **Customization:** Must allow arbitrary HTML attributes (ID, Class, Data attributes) to be injected.
3.  **Accessibility:**
    *   Forms must have associated `<label>`.
    *   Interactive elements must use correct `aria-*` attributes (Bootstrap handles most, but custom wrappers must verify).
    *   Keyboard navigable.
4.  **XSS Safe:** All user-supplied content rendered inside the component must be escaped.
5.  **Documentation:** A usage example in the `docs/` folder showing the PHP code and resulting HTML.

## 6. Detailed Component Categorization

(Refined grouping of the original requirement list)

### Inputs
*   Forms, Selects & Pickers, Sliders & Range Inputs, Toggle Groups, Multi-select Components, Image Cropper/Editor, Inline Editing Components, Search Bars.

### Feedback
*   Alerts & Notifications, Toast Messages, Progress Indicators, Skeleton Loaders, Form Validation Messages, Empty State Illustrations.

### Navigation
*   Menus, Breadcrumbs, Pagination & Steppers, Tabs & Accordions, Drawer Menus, App Bars / Toolbars, Sticky Elements.

### Data Display
*   Lists & Tables, Cards & Panels, Avatars & Badges, Tag/Chip Components, Timeline & Activity Feeds, Tree Views, Calendar Views.

### Overlays
*   Modals & Dialogs, Tooltips & Popovers, Contextual Action Bars.

### Utilities
*   Clipboard Utilities, Drag-and-Drop Zones, Resizable Panels, Fullscreen Toggle.
