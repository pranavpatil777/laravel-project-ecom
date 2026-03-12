<?php

namespace App\Services;

use App\Models\Coupon;

class CouponService
{
    public function calculateDiscount(?string $code, float $subtotal): float
    {
        if (! $code) {
            return 0.0;
        }

        $coupon = Coupon::query()
            ->where('code', $code)
            ->where('is_active', true)
            ->where(fn ($q) => $q->whereNull('starts_at')->orWhere('starts_at', '<=', now()))
            ->where(fn ($q) => $q->whereNull('ends_at')->orWhere('ends_at', '>=', now()))
            ->first();

        if (! $coupon) {
            return 0.0;
        }

        if ($coupon->type === 'percent') {
            return round($subtotal * ($coupon->value / 100), 2);
        }

        return min($subtotal, (float) $coupon->value);
    }
}
