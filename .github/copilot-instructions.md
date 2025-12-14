<!-- Copilot / AI agent instructions for Delivery-and-shipping-tracker-system -->
# Quick context
- This is a Laravel 12 application (PHP ^8.2) using Vite/Tailwind for frontend assets.
- Key entry points:
  - routes/web.php — route definitions (notably admin/dashboard, shipments, customers)
  - app/Http/Controllers — controller logic (AuthController, ShipmentController)
  - app/Models — domain models (Customer.php, Shipment.php, User.php)
  - resources/views/admindashboard/admin-dashboard.blade.php — large admin UI with inlined JS and fetch calls
  - database/migrations — schema for shipments/customers/users
  - composer.json / package.json — Composer & npm scripts used for dev and build

# What you need to know to be productive
- Dev workflow (quick):
  1. `composer install`
  2. copy `.env.example` to `.env` (Windows PowerShell: `Copy-Item .env.example .env -Force`)
  3. `php artisan key:generate`
  4. `php artisan migrate` (or run `composer run setup` to perform setup script from composer.json)
  5. `npm install` then `npm run dev` (hot / Vite) or `npm run build` (prod)
- Alternative: `composer run dev` runs a multi-process dev environment (uses `concurrently`, starts `php artisan serve`, queue workers and `vite`). Use it only when `concurrently` is available and you want all services started together.

- Run tests: `composer run test` (or `php artisan test` / `vendor/bin/phpunit`). `phpunit.xml` exists at project root.

# Project-specific patterns & gotchas
- Blade + inlined JS: `resources/views/admindashboard/admin-dashboard.blade.php` contains heavy inline JavaScript that issues `fetch()` calls to endpoints like `/shipments` and `/customers`. These routes are protected by the `auth` middleware — API requests will require a valid session/CSRF token.
- CSRF: Views include a `<meta name="csrf-token">`. When editing or extracting JS, preserve Blade `{{ }}` syntax and `@csrf` tokens. If converting inline JS to modules, inject CSRF header from the meta tag.
- Routing: `routes/web.php` is the single-file place for web routes. The controllers referenced (e.g., `ShipmentController`) implement RESTful endpoints — follow existing naming when adding new routes.
- Models/migrations: check `app/Models/Shipment.php` and `Customer.php` for mass-assignable fields (`$fillable`) and auto-generated tracking_number logic (Shipment::boot creating TRK-...). When adding fields, update migrations, models, and front-end forms in `resources/views`.
- Frontend build: Vite + `laravel-vite-plugin` is used. Assets live under `resources/js` and `resources/css`. Use `npm run dev` for local development and `npm run build` for CI/production artifacts.

# Integration & background services
- Queue / background: composer `dev` script starts `php artisan queue:listen --tries=1` and `php artisan pail --timeout=0`. Be cautious editing queue consumers; you can run `php artisan queue:work` standalone for testing.
- External deps: primary PHP deps are in `composer.json` (laravel/framework, laravel/tinker). JS deps include `axios`, `vite`, `tailwindcss` — keep changes compatible with current versions in `package.json`.

# Tests & debugging tips
- Unit/Feature tests live in `tests/Unit` and `tests/Feature`. Use `php artisan test --filter <TestName>` to run specific tests.
- To debug controllers: set `APP_DEBUG=true` in `.env` and inspect storage/logs/laravel.log. For immediate route testing, use `php artisan serve` and authenticate via the UI or create a seeded test user.

# Editing conventions & examples
- When modifying views, keep Blade echoes and directives (`{{ }}`, `@csrf`, `@if`, `@foreach`) intact. Example: do not replace `{{ $sofiaCruzEmail }}` with hard-coded values unless intentionally seeding demo data.
- JS fetch examples to emulate from `admin-dashboard.blade.php`:
  - POST new shipment: `fetch('/shipments', { method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token }, body: JSON.stringify(data) })`
  - GET shipments: `fetch('/shipments')` (requires session/auth)

# Files to check when changing domain logic
- routes/web.php
- app/Http/Controllers/*Controller.php (Auth, Shipment, Customer)
- app/Models/*.php
- resources/views/admindashboard/admin-dashboard.blade.php
- database/migrations/*create_*.php
- database/seeders/DatabaseSeeder.php

# When in doubt
- Preserve middleware and auth checks when editing API endpoints. If you need to test unauthenticated endpoints, either create a dedicated route in `routes/web.php` for local testing or run tests that mock authentication.
- Ask for clarification if a UI change spans Blade and JS (e.g., moving inline JS into a module). Provide both server-side and client-side diffs in PRs.

# Next steps for maintainers (ask the user)
- Confirm preferred local database (sqlite vs MySQL) for recommended setup steps.
- Tell me if you want inline JS moved into `resources/js` modules and I will propose a refactor checklist.

-- End
