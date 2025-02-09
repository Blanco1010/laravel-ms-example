<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['id', 'name', 'price'];
    protected $hidden = ['created_at', 'updated_at'];

    public function categories(): BelongsToMany {
        return $this->belongsToMany(Category::class, 'category_product');
    }
}
