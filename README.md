# Laravel eCommerce Starter

This repository now contains a Laravel-oriented eCommerce scaffold with the requested stack:

- **Frontend:** Blade + Tailwind + Alpine + Vite
- **Backend:** Laravel controllers + services pattern
- **Database:** MySQL
- **Cache:** Redis
- **Payments:** Razorpay
- **Admin panel:** Filament (dependency added)
- **Storage:** AWS S3-compatible disk (MinIO in Docker for local dev)

## Included feature scaffolding

### Customer side
- Product catalog
- Search and filters
- Cart
- Checkout
- Payment gateway integration point (Razorpay order creation)
- Order tracking
- Wishlist

### Admin CMS
- Product management view
- Category-ready domain model
- Order management view
- Coupons/users/inventory/analytics are prepared in architecture and can be extended via Filament resources.

## Packages added in `composer.json`
- `gloudemans/shoppingcart`
- `spatie/laravel-medialibrary`
- `spatie/laravel-permission`
- `filament/filament`
- `razorpay/razorpay`

## Local development (Docker)

```bash
docker compose up --build
```

This starts:
- `app` (PHP + Composer)
- `mysql`
- `redis`
- `minio` (S3-compatible)

## Notes

Network restrictions in this environment prevented downloading Composer dependencies from Packagist. The project structure and integration points are provided so you can run `composer install` in a normal networked environment and continue development.
