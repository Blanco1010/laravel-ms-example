<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model {
    use HasFactory, HasUuids;

    protected $fillable = ['name', 'parent_id'];

    protected $hidden = ['pivot', 'created_at', 'updated_at'];

    public function parent(): BelongsTo {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany {
        return $this->hasMany(Category::class, 'parent_id')->with('children');
    }

    public function products(): BelongsToMany {
        return $this->belongsToMany(Product::class, 'category_product');
    }

}
