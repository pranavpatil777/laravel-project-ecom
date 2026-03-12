# Laravel 11 eCommerce Application

A Laravel 11 eCommerce application with:

- Frontend: Blade + Tailwind + Alpine + Vite
- Backend: Laravel Controllers + Services
- Database: MySQL
- Cache/Queue: Redis
- Payments: Razorpay
- Admin Panel: Filament
- Media Storage: AWS S3 (MinIO locally)
- Packages: Laravel Shoppingcart, Spatie Media Library, Spatie Permission

## Core Features

### Customer Side
- Product catalog
- Search & filters
- Cart
- Checkout
- Razorpay order creation integration
- Order tracking
- Wishlist
- Auth (register/login/logout)

### Admin CMS (Filament)
- Product management
- Category management
- Order management
- Coupons
- Users/permissions foundation via Spatie Permission
- Inventory fields in product resource
- Dashboard entry point for analytics extension

## Local Run (Step by Step)

1. Install dependencies:
   ```bash
   composer install
   npm install
   ```
2. Setup env:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
3. Start infra (MySQL/Redis/MinIO):
   ```bash
   docker compose up -d mysql redis minio
   ```
4. Run migrations and seed admin user:
   ```bash
   php artisan migrate
   php artisan db:seed
   ```
5. Run app + assets:
   ```bash
   php artisan serve
   npm run dev
   ```
6. Open:
   - App: http://127.0.0.1:8000
   - Filament Admin: http://127.0.0.1:8000/admin

## Full Docker Run

```bash
docker compose up --build
```

## Deploy (Production)

1. Provision:
   - PHP 8.2+/Nginx
   - MySQL
   - Redis
   - S3 bucket
2. Build release:
   ```bash
   composer install --no-dev --optimize-autoloader
   npm ci && npm run build
   php artisan migrate --force
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```
3. Configure workers:
   - `php artisan queue:work`
   - cron: `* * * * * php /path/artisan schedule:run`
4. Set env values for Razorpay + AWS S3.

## Important Environment Note

The current execution environment cannot access Packagist/GitHub (HTTP 403 tunnel), so dependency installation cannot be completed here. The codebase is prepared to run in a normal networked machine.
