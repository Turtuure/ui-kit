# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added
- Documentation: Added `TESTS.md` guide for running and writing tests.

## [1.0.0] - 2025-11-23

### Added
- **Initial Release**: Launch of the Archon UI Kit.
- **Core Architecture**:
    - Abstract `Component` base class with fluent attribute management.
    - Design Tokens and CSS variables (`archon-ui.css`).
    - Local font support (Inter, Merriweather, Roboto Mono).
- **Components**:
    - **Elements**: Buttons, Badges, Spinners.
    - **Forms**: TextInput, Textarea, Checkbox, Radio, Select, InputGroup, FileUpload, Labels, FormGroups.
    - **Navigation**: Navbar, Nav (Tabs/Pills), Breadcrumbs, Pagination, Drawer (Offcanvas), Stepper.
    - **Overlays**: Modal, Tooltip, Popover, Toast.
    - **Data Display**: Card, Table, ListGroup, TreeView, Charts (Chart.js wrapper).
    - **Layout**: Container, Row, Column (Grid system).
    - **Media**: Video, Audio players.
    - **Typography**: Text, Heading utilities.
- **Development Environment**:
    - Fluid Dashboard layout for component showcase.
    - dedicated pages for all component categories.
- **Documentation**:
    - `README.md` with installation and usage instructions.
    - `docs/API.md` reference guide.
    - Governance files (`CONTRIBUTING.md`, `CODE_OF_CONDUCT.md`, `SECURITY.md`).
- **CI/CD**:
    - GitHub Actions workflow (`ci.yml`) for PHPUnit, PHP-CS-Fixer, and PHPStan.
