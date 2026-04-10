# UPNEZ Agency OS

UPNEZ Agency OS is a Laravel 11 + Livewire 3 Agency CRM and Operations platform designed for shared hosting deployment on Hostinger.

## Stack
- Laravel 11 (PHP 8.2+)
- Livewire 3 + Alpine.js + Tailwind CSS 3
- MySQL 8
- Chart.js (CDN)
- SortableJS (CDN)
- DomPDF (`barryvdh/laravel-dompdf`)
- Spatie Permission (`spatie/laravel-permission`)

## Core Modules
- Owner Dashboard with KPI tiles and chart APIs
- CRM: Leads, Deals, Clients, Contacts
- Operations: Projects, Tasks, Time Tracking, Files
- Finance: Invoices, Bills, Cashflow, P&L, Payments, Expenses
- Intelligence dashboards
- Settings: Company, Users, Email, Integrations
- In-app email compose modal and notification panel with polling

## Setup (Local)
```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm run build
php artisan serve
```

Default seeded owner account:
- `owner@upnez.com`
- password: `password`

## Hostinger Deployment (`https://app.upnez.com`)
1. Upload project to `~/public_html`.
2. Set document root to `~/public_html/public` (or use `.htaccess` redirect).
3. Create Hostinger MySQL DB and update `.env`.
4. Run:
   ```bash
   composer install --optimize-autoloader --no-dev
   php artisan key:generate --force
   php artisan migrate --force --seed
   npm install
   npm run build
   php artisan storage:link
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```
5. Set `QUEUE_CONNECTION=sync`.
6. Configure SMTP settings in `.env` (Hostinger / Mailgun / SendGrid / Gmail).
7. Add cron job in Hostinger scheduler:
   ```bash
   php /home/username/public_html/artisan schedule:run
   ```
   Run every minute.
8. Ensure SSL is enabled and `APP_URL=https://app.upnez.com`.

## Notes
- Notification drawer uses Livewire polling every 30 seconds (no WebSockets needed).
- Invoice PDFs are generated from `/invoices/{invoice}/pdf`.
- Chart data endpoints are available in `routes/api.php`.
