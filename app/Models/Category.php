<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Facades\Log;

class Category extends Model
{
    use HasFactory;

    protected array $fillable = ['parent_id', 'name'];


    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:i:s',
        'updated_at' => 'datetime:d-m-Y H:i:s'
    ];

    protected $with = ['children'];

    protected $appends = [
        'product_count'
    ];


    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id')->with('parent');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id')->with('children');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function childrenProducts(): HasManyThrough
    {
        return $this->hasManyThrough(Product::class, self::class, 'parent_id', 'category_id');
    }

    public function getProductCountAttribute()
    {
        return $this->products()->count() + $this->childrenProducts()->count();
    }

    public function getChildCategoryIdsAttribute(): array{

        $ids = [$this->id];
        $children = collect($this->children)->toArray();
        array_walk_recursive($children, function($item, $key) use(&$ids){
            if($key == 'id'){
                $ids[] = $item;
            }
        });
        return $ids;
    }
}
