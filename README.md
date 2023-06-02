# ACF — Separate Concerns

## Installation

You can install this package with Composer:

```bash
composer require broskees/acf-separate-concerns
```

You can publish the config file with:

```shell
$ wp acorn vendor:publish --provider="Broskees\AcfSeparateConcerns\Providers\AcfComposerServiceProvider"
```

## Usage

This package is just a wrapper for ACF Composer to relocate ACF fields without changing the `ACORN_BASEPATH` constant.

This package is used identically, just reference [ACF Composer's Docs](https://github.com/log1x/acf-composer).

By default fields will be placed in the `${WP_CONTENT_DIR}/acf` directory. But this directory and be changed with the `acf_composer_path` filter.

### Example

```php
<?php
/**
 * Plugin Name:  Relocate ACF Fields
 * Plugin URI:   https://digitaldyve.com/
 * Description:  Relocates ACF Fields outside of the theme
 * Version:      1.0.0
 * Author:       Digital Dyve
 * Author URI:   https://digitaldyve.com/
 * License:      MIT
 */

add_filter('acf_composer_path', function ($path) {
    if (!defined('WP_CONTENT_DIR')) {
        return $path;
    }

    return WP_CONTENT_DIR.DIRECTORY_SEPARATOR.'my-own-directory-name-here';
});
```
