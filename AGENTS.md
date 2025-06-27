# AGENTS.md

This file provides guidelines for AI agents working in this repository.

## Commands

- **Install dependencies:** `composer install`
- **Run all tests:** `composer test`
- **Run a single test file:** `composer test testes/Sefaz/LoteGnreTest.php`
- **Run code quality checks:** `./run_quality_checks.sh`

## Workflow

- **Code Quality Analysis:** Run `composer quality-checks`
- **Testing:** Run `composer test` right before committing, even for changes that don't alter code logic.
- **Commit Changes:** After all checks pass and automated fixes are applied, commit changes using `git add <changed_files> && git commit -m "<commit_message>"`.
- **Undo Changes:** If asked to undo the last change, revert the last commit using `git revert HEAD --no-edit`.

### Commit Message Convention

- **Standard:** Use [Conventional Commits](https://www.conventionalcommits.org/) for all commit messages.
- **Format:** `<type>(<scope>): <description>`
  - `type`: `feat`, `fix`, `docs`, `style`, `refactor`, `test`, `chore`, `perf`, `ci`, `build`, `revert`
  - `scope` (optional): The part of the codebase affected (e.g., `auth`, `ui`, `api`)
  - `description`: A concise description of the change.

## Code Style

- **Standard:** Follow PSR-12 for all PHP code.
- **Naming:**
    - Classes: `PascalCase`
    - Methods: `camelCase`
    - Test files: `ClassNameTest.php`
    - Test Methods: `snake_case` (e.g., `test_my_feature`). Note: `phpcs` with PSR-12 will warn about this, but it's the project's convention.
- **Types:** Use strict types (`declare(strict_types=1);`) in all new files. Add type declarations for properties, arguments, and return types wherever possible.
- **Error Handling:** Use custom exceptions from `Sped\Gnre\Exception` where appropriate.
- **Imports:** Keep imports sorted alphabetically.
## Best Practices

- **Code Quality:** Always run `composer quality-checks`. This command should never fail.
- **Testing:** Always run existing tests (`composer test`) right before committing, even on changes that't alter code logic.
- **Consistency:** Adhere to existing code patterns, naming conventions, and architectural choices found in the surrounding codebase.
- **Code Quality Analysis Scope:** Code quality analysis (phpcs, phpstan) should be performed only on modified files unless a whole codebase review is explicitly requested by the user.

## Git Operations

- **Rebasing with Conflicts:** When resolving conflicts during a rebase, always perform a `git commit` after resolving the conflicts and staging the changes, and *before* running `git rebase --continue`. This prevents the rebase process from hanging due to an editor opening.

## Project: nfephp-org/sped-gnre

**Description:** A PHP library for generating and communicating with the SEFAZ (Brazilian tax authority) to issue GNRE (Guia Nacional de Recolhimento de Tributos Estaduais), which is a tax payment guide.

**Language:** PHP >= 8.1

**Key Dependencies:**
* `dompdf/dompdf`: For PDF generation.
* `laminas/laminas-barcode`: For barcode generation.
* `nfephp-org/sped-nfe`: For NFe (Nota Fiscal Eletrônica) related functionalities.

**Project Structure:**
* `lib/Sped/Gnre`: Contains the core source code.
* `exemplos/`: Contains usage examples.
* `testes/`: Contains the test suite.
* `vendor/`: Contains composer dependencies.
* `wsdl/` & `xsd/`: Contains the web service definition and schema files for communicating with SEFAZ.

**Core Functionality:**
* **Configuration:** The `lib/Sped/Gnre/Configuration` directory contains classes for handling the digital certificate (`.pfx` file) and other setup parameters required for communicating with SEFAZ.
* **SEFAZ Communication:** The `lib/Sped/Gnre/Sefaz` directory is the core of the library, containing the logic for creating SOAP envelopes for various SEFAZ operations, such as:
    * Sending a batch of GNREs (`Lote.php`, `LoteV2.php`).
    * Consulting the status of a batch (`Consulta.php`).
    * Querying the configuration of a state (`ConfigUf.php`).
* **Web Service Interaction:** The `lib/Sped/Gnre/Webservice` directory handles the actual communication with the SEFAZ web services using cURL.

**Usage:**
1.  The user creates a `Setup` object with the necessary configurations (certificate, environment, etc.).
2.  The user creates one or more `Guia` objects, representing the GNRE guides to be issued.
3.  The `Guia` objects are added to a `Lote` or `LoteV2` object.
4.  A `Send` object is used to send the `Lote` to the SEFAZ web service.
5.  The library handles the creation of the SOAP request, the communication with the web service, and returns the response from SEFAZ.
