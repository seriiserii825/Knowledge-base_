# Composer — Install on VPS

## 1. Check PHP

```bash
php -v
```

If PHP is not installed (Ubuntu/Debian):

```bash
sudo apt update
sudo apt install php-cli curl unzip
```

---

## 2. Install Composer globally

Download the installer:

```bash
cd /tmp
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
```

Install Composer:

```bash
php composer-setup.php
sudo mv composer.phar /usr/local/bin/composer
rm composer-setup.php
```

Check installation:

```bash
composer --version
```

---

## 3. Install project dependencies

Go to the directory containing `composer.json`:

```bash
cd /var/www/my-project
```

Install dependencies:

```bash
composer install
```

For production:

```bash
composer install --no-dev --optimize-autoloader
```

This creates:

```text
vendor/
├── autoload.php
├── composer/
└── ...
```

---

## 4. Add a package

```bash
composer require vendor/package
```

Example:

```bash
composer require mpdf/mpdf
```

Development dependency:

```bash
composer require --dev phpunit/phpunit
```

---

## 5. Remove a package

```bash
composer remove vendor/package
```

Example:

```bash
composer remove mpdf/mpdf
```

---

## 6. Update packages

Update all dependencies:

```bash
composer update
```

Update one package:

```bash
composer update mpdf/mpdf
```

> Use `composer install` on production/deployment when `composer.lock` exists.
> Use `composer update` when you intentionally want to change dependency versions.

---

## 7. Use Composer packages in PHP

```php
require_once __DIR__ . '/vendor/autoload.php';
```

---

## 8. Useful commands

```bash
# Composer version
composer --version

# Show installed packages
composer show

# Check composer.json / composer.lock
composer validate

# Check platform requirements (PHP + extensions)
composer check-platform-reqs

# Rebuild autoloader
composer dump-autoload

# Optimized autoloader
composer dump-autoload -o

# Check outdated packages
composer outdated

# Diagnose Composer problems
composer diagnose

# Clear Composer cache
composer clear-cache
```

---

## Typical VPS deployment

```bash
cd /var/www/my-project

git pull

composer install \
  --no-dev \
  --optimize-autoloader \
  --no-interaction
```

Recommended project files:

```text
my-project/
├── composer.json
├── composer.lock
├── vendor/
└── ...
```

Usually:

```text
composer.json   → commit
composer.lock   → commit
vendor/         → don't commit
```

On the VPS, run:

```bash
composer install --no-dev --optimize-autoloader
```
