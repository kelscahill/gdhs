# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a WordPress theme called GDHS based on Sage 9 with Timber integration. It combines the Sage 9 modern development workflow with Timber's Twig templating system.

## Development Commands

### Initial Setup
```bash
yarn dev                      # Full setup: installs yarn, npm, composer dependencies, builds assets, and starts dev server
```

### Build Commands
```bash
yarn build                    # Compile assets for development
yarn build:production         # Compile and optimize assets for production
yarn start                    # Watch files and compile on changes with BrowserSync
```

### Code Quality
```bash
yarn lint                     # Run all linters (scripts and styles)
yarn lint:scripts             # Lint JavaScript files
yarn lint:styles              # Lint CSS/SCSS files
composer test                 # Run PHP CodeSniffer (phpcs)
```

## Architecture

### Hybrid Template System
This theme uses both Blade and Timber/Twig templates:
- **Blade templates** (`resources/views/*.blade.php`): Primary template files that integrate with Timber
- **Twig patterns** (`resources/views/patterns/*.twig`): Reusable components rendered via Timber

### Key Directories
- `app/`: PHP application logic
  - `Controllers/`: Page controllers for passing data to templates
  - `setup.php`: Theme configuration, navigation menus, post types, and features
  - `timber.php`: Timber initialization and context setup
  - `filters.php`: WordPress filters
  - `helpers.php`: Helper functions
- `resources/views/`: Blade templates and Twig patterns
- `resources/assets/`: Source files for styles, scripts, and images
  - `config.json`: Build configuration with local development URL

### Controller Pattern
Controllers in `app/Controllers/` automatically pass data to corresponding Blade templates using the soberwp/controller package. Example: `App.php` provides data to all templates, `FrontPage.php` to `front-page.blade.php`.

### Asset Building
Webpack 3 is used for asset compilation with:
- Sass/SCSS compilation
- ES6 JavaScript transpilation
- BrowserSync for live reloading
- Image optimization

## Local Development Configuration

Before starting development:
1. Update `resources/assets/config.json`:
   - Set `devUrl` to your local WordPress URL (currently `http://gdhs.local`)
   - Ensure `publicPath` matches the theme path (`/wp-content/themes/gdhs`)

## Dependencies

### PHP (Composer)
- PHP >= 8.0
- Timber/Timber for Twig templating
- Laravel Illuminate/Support for Blade
- Roots/sage-lib for Sage utilities

### JavaScript (Node/Yarn)
- Node.js >= 10.12.0
- jQuery 3.3.1
- Webpack 3 for bundling
- BrowserSync for development

## WordPress Integration

### Required Plugins
- Timber must be installed and activated as a WordPress plugin

### Theme Features
The theme is configured in `app/setup.php` and includes:
- Custom navigation menus
- Widget areas (sidebars)
- Post thumbnail support
- Theme support declarations

### ACF Integration
ACF JSON sync is enabled with field definitions stored in `resources/acf-json/`