# Contributing to Archon UI Kit

We welcome contributions to the Archon UI Kit! To ensure a smooth collaboration process, please follow these guidelines.

## Code of Conduct

Please review our [Code of Conduct](CODE_OF_CONDUCT.md) to understand the standards of behavior we expect.

## How to Contribute

### 1. Fork the Repository
Fork the `archon/ui-kit` repository to your own GitHub account.

### 2. Clone Your Fork
Clone your forked repository to your local machine:

```bash
git clone https://github.com/YOUR_GITHUB_USERNAME/ui-kit.git
cd ui-kit
```

### 3. Install Dependencies
Ensure you have PHP 8.0+ and Composer installed. Then, install the project dependencies:

```bash
composer install
```

### 4. Create a New Branch
Create a new branch for your feature or bug fix. Use a descriptive name (e.g., `feature/add-new-component`, `bugfix/fix-modal-issue`).

```bash
git checkout -b feature/your-feature-name
```

### 5. Develop Your Changes

*   **Coding Style:** Adhere to the existing coding style. Run `vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.dist.php` to automatically fix most style issues.
*   **Tests:** All new features or bug fixes **must** include corresponding PHPUnit tests. Place your tests in the `tests/` directory, mirroring the `src/` folder structure.
*   **Showcase:** If you're adding a new UI component, ensure it's integrated into the local [Development Environment](#-development-environment) for visual verification. Create a new showcase file (e.g., `public/showcase/my-component.php`) and link it in `public/index.php`.
*   **Static Analysis:** Ensure your code passes static analysis checks:
    ```bash
    vendor/bin/phpstan analyse --configuration=phpstan.neon --level=8
    ```

### 6. Run Tests
Before submitting your pull request, ensure all tests pass:

```bash
vendor/bin/phpunit
```

### 7. Commit Your Changes
Write clear, concise commit messages.

```bash
git add .
git commit -m "feat: Add new component X" # or "fix: Resolve issue Y"
```

### 8. Push to Your Fork

```bash
git push origin feature/your-feature-name
```

### 9. Create a Pull Request
Open a pull request from your branch to the `main` branch of the `archon/ui-kit` repository. Provide a clear description of your changes.

---

Thank you for contributing to the Archon UI Kit!
