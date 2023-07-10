<?php

namespace App\Models\Product;

use App\Models\Category\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";
    protected $fillable = [
        'name',
        'price',
        'image',
        'description',
        'exist',
        'category_id'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @param $query
     * @param $searchQuery
     * @return mixed
     */
    public function scopeSearch($query, $searchQuery)
    {
        return $query->where('name', 'like', "%$searchQuery%")
            ->orWhere('description', 'like', "%$searchQuery%");
    }
}
