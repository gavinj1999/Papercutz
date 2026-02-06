# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Magento 2.4.8-p3 e-commerce site with Hyvä Theme framework. Uses DDEV for local development, Tailwind CSS 4.x for styling, and Alpine.js for interactivity.

- **Local URL:** https://papercutz.ddev.site
- **Production Path:** /var/www/papercutz

## Development Environment

Start DDEV:
```bash
ddev start
```

Run Magento commands inside container:
```bash
ddev exec bin/magento <command>
```

## Essential Commands

### Magento CLI
```bash
ddev exec bin/magento cache:clean
ddev exec bin/magento cache:flush
ddev exec bin/magento setup:upgrade --keep-generated
ddev exec bin/magento setup:di:compile
ddev exec bin/magento setup:static-content:deploy en_GB -f
```

### Tailwind CSS (run from theme directory)
```bash
cd app/design/frontend/Papercutz/default/web/tailwind
npm install
npm run watch       # Development with file watching
npm run build       # Production minified build
npm run browser-sync -- --proxy https://papercutz.ddev.site  # Live reload
```

### Composer
```bash
ddev exec composer install
ddev exec composer update <package>
```

## Architecture

### Theme Structure
- **Theme Path:** `app/design/frontend/Papercutz/default/`
- **Parent Theme:** Hyvä default (`hyva-themes/magento2-default-theme`)
- **Tailwind Entry:** `web/tailwind/tailwind-source.css`
- **Compiled CSS:** `web/css/styles.css`

CSS is organized in `web/tailwind/`:
- `base/` - Preflight and print styles
- `components/` - Reusable UI components (buttons, forms, cards)
- `theme/` - Page-specific styles (catalog, customer, CMS)
- `utilities/` - Custom utility classes
- `generated/` - Auto-generated Hyvä sources (do not edit)

### Custom Modules
- `app/code/Papercutz/MediaFix` - Fixes media upload issues on Windows/DDEV (uses copy instead of rename)
- `app/code/Rising5th/ReviewCarousel` - Google Reviews carousel widget

### Hyvä-Specific Patterns
- Use Alpine.js for frontend interactivity
- CSP-compatible JavaScript (no inline scripts)
- Design tokens configured in `web/tailwind/hyva.config.json`
- Run `npm run generate` to regenerate Hyvä sources after module changes

## Deployment

Pushes to `main` trigger automatic deployment via GitHub Actions:
1. Pulls latest code
2. Runs `composer install --no-dev`
3. Clears generated files and cache
4. Runs setup:upgrade, di:compile, static-content:deploy
5. Flushes cache

## Key Configuration Files

- `.ddev/config.yaml` - DDEV configuration (PHP 8.3, MariaDB 10.6, nginx-fpm)
- `app/design/frontend/Papercutz/default/web/tailwind/tailwind.config.js` - Tailwind config
- `app/design/frontend/Papercutz/default/web/tailwind/hyva.config.json` - Hyvä design tokens (colors, etc.)
