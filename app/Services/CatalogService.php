<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CatalogService
{
    public function search(array $filters = []): LengthAwarePaginator
    {
        return Product::query()
            ->when($filters['search'] ?? null, fn ($query, $search) => $query->where('name', 'like', "%{$search}%"))
            ->when($filters['category_id'] ?? null, fn ($query, $category) => $query->where('category_id', $category))
            ->where('is_active', true)
            ->orderByDesc('id')
            ->paginate(12)
            ->withQueryString();
    }
}
