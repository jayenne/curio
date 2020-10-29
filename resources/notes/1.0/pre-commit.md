# Pre-commit code checking

- [Cdoe Sniff](#code-sniff)
- [Code Lint](#code-lint)
- [Code Fix](#code-fix)

## PHP-Code_Sniffer
>[PHP-Codesniffer](https://cylab.be/blog/22/using-php-codesniffer-in-a-laravel-project)
> is a great tool that enforces everybody is using the same coding standard when contributing to a project. For a Laravel project, there are however a few caveats to handle...

<a name="code-sniffer"></a>
### Lint your code first
From project root run: `./vendor/bin/phpcs`

<a name="code-fixer"></a>
### You may now fix and beautify your code 
From project root run: `./vendor/bin/phpcbf`

## PHPCS
<a name="code-linter"></a>
### Lint your code first
From project root run: `php artisan fixer:fix --dry-run`

<a name="code-fix"></a>
### Modify the files that need to be fixed
From project root run: `php artisan fixer:fix`

---