# Archon UI Kit API Reference

This document provides a summary of available components and their key methods. For visual examples, run the local development environment.

## Base Component
All components extend `Archon\UIKit\Component`.
*   `id(string $id)`: Set HTML ID.
*   `addClass(string $class)`: Add CSS classes.
*   `removeClass(string $class)`: Remove CSS classes.
*   `setAttribute(string $key, string $value)`: Set arbitrary HTML attribute.
*   `data(string $key, string $value)`: Set `data-*` attribute.
*   `render()`: Return HTML string.

---

## Elements `Archon\UIKit\Elements`

### Button
`new Button(string $label)`
*   `type(string $type)`: 'button', 'submit', 'reset'.
*   `variant(string $variant)`: 'primary', 'secondary', etc.
*   `outline(bool $outline)`: Toggle outline style.
*   `size(string $size)`: 'sm', 'lg'.
*   `tag(string $tag)`: 'button' or 'a'.
*   `textColor(string $color)`: Set utility class text color.

### Badge
`new Badge(string $text)`
*   `variant(string $variant)`: Color variant.
*   `pill(bool $pill)`: Rounded pill style.
*   `textColor(string $color)`: Set text color.

### Spinner
`new Spinner(string $type = 'border')`
*   `type(string $type)`: 'border', 'grow'.
*   `variant(string $variant)`: Color variant.
*   `size(string $size)`: 'sm'.
*   `label(string $label)`: Accessibility label.

---

## Forms `Archon\UIKit\Inputs`

### TextInput
`new TextInput(string $name, string $type = 'text')`
*   `value(string $value)`
*   `placeholder(string $placeholder)`
*   `disabled(bool $disabled)`
*   `readonly(bool $readonly)`
*   `valid(bool $isValid)`
*   `invalid(bool $isInvalid)`

### Textarea
`new Textarea(string $name)`
*   `rows(int $rows)`
*   (Inherits value, placeholder, disabled, readonly, valid, invalid)

### Checkbox / Radio `Archon\UIKit\Inputs\ChecksAndRadios`
`new Checkbox(string $name, string $label)`
`new Radio(string $name, string $value, string $label)`
*   `checked(bool $checked)`
*   `disabled(bool $disabled)`
*   `inline(bool $inline)`

### Select `Archon\UIKit\Inputs\Selects`
`new Select(string $name, array $options = [])`
*   `options(array $options)`: Array of value=>text or full option arrays.
*   `placeholder(string $text)`: First disabled option.
*   `multiple(bool $multiple)`
*   `disabled(bool $disabled)`

### InputGroup
`new InputGroup(string|Component ...$items)`
*   `add(string|Component ...$items)`
*   `size(string $size)`

### FileUpload
`new FileUpload(string $name)`
*   `multiple(bool $multiple)`
*   `disabled(bool $disabled)`
*   `size(string $size)`

### Label
`new Label(string $text)`
*   `for(string $id)`

### FormGroup
`new FormGroup(Label $label, Component $input)`
*   `helpText(string $text)`
*   `feedbackText(string $text)`

---

## Navigation `Archon\UIKit\Navigation`

### Nav
`new Nav(string|Component ...$items)`
*   `tabs()`: Style as tabs.
*   `pills()`: Style as pills.
*   `fill()`: Fill width.
*   `vertical()`: Vertical stack.

### Navbar
`new Navbar(string $brand)`
*   `add(string|Component ...$items)`
*   `bgColor(string $color)`: 'light', 'dark', 'primary'.
*   `expand(string $breakpoint)`: 'lg', 'md', 'sm' (or null for always expanded).

### Breadcrumb
`new Breadcrumb(array $items)` (Array of 'Label' => 'URL')

### Pagination
`new Pagination(int $totalPages, int $currentPage, string $urlPattern)`
*   `size(string $size)`

### Drawer (Offcanvas)
`new Drawer(string $id, string $title)`
*   `placement(string $placement)`: 'start', 'end', 'top', 'bottom'.
*   `backdrop(bool $show)`
*   `scroll(bool $allow)`

### Stepper
`new Stepper(array $steps, int $currentStep)`
*   `vertical(bool $vertical)`

---

## Overlays `Archon\UIKit\Overlays`

### Modal
`new Modal(string $id, string $title)`
*   `body(string|Component $content)`
*   `footer(string|Component $content)`
*   `staticBackdrop(bool $static)`
*   `centered(bool $centered)`
*   `size(string $size)`

### Tooltip
`new Tooltip(string $content, string $message)`
*   `placement(string $placement)`
*   `tag(string $tag)`

### Popover
`new Popover(string $content, string $title, string $message)`
*   `placement(string $placement)`
*   `tag(string $tag)`

### Toast
`new Toast(string $header, string $body)`
*   `time(string $time)`
*   `autohide(bool $autohide)`
*   `delay(int $ms)`

---

## Data Display `Archon\UIKit\DataDisplay`

### Card
`new Card(string|Component $body)`
*   `header(string|Component $content)`
*   `footer(string|Component $content)`
*   `imageTop(string $src, string $alt)`
*   `variant(string $variant)`
*   `textColor(string $color)`

### Table
`new Table(array $headers, array $rows)`
*   `striped(bool $striped)`
*   `hover(bool $hover)`
*   `bordered(bool $bordered)`
*   `small(bool $small)`
*   `responsive(bool $responsive)`
*   `variant(string $variant)`

### ListGroup `Archon\UIKit\DataDisplay\Lists`
`new ListGroup(string|Component ...$items)`
*   `add(string|Component $content, string|null $href, bool $active, bool $disabled, Component $badge)`
*   `flush(bool $flush)`
*   `numbered(bool $numbered)`

### TreeView
`new TreeView(array $data)`
*   `open(bool $open)`

---

## Charts `Archon\UIKit\Charts`

### Chart
`new Chart(string $type)` ('bar', 'line', 'pie', 'doughnut')
*   `labels(array $labels)`
*   `addDataset(string $label, array $data, ...)`

---

## Typography `Archon\UIKit\Typography`

### Text
`new Text(string $content)`
*   `tag(string $tag)`
*   `muted(bool $muted)`

### Heading
`new Heading(string $content, int $level)`
*   `display(int $size)`

---

## Layout `Archon\UIKit\Layout\Structure`

### Container
`new Container(string|Component ...$content)`
*   `fluid(bool $fluid)`

### Row
`new Row(string|Component ...$content)`
*   `gutter(int $size)`

### Column
`new Column(string|Component ...$content)`
*   `xs(int $size)`
*   `sm(int $size)`
*   `md(int $size)`
*   `lg(int $size)`
*   `xl(int $size)`
