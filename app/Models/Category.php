<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status', 'parent_id'];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function getFullPathAttribute()
    {
        $path = [];
        $category = $this;
        
        while ($category) {
            array_unshift($path, $category->name);
            $category = $category->parent;
        }
        
        return implode(' > ', $path);
    }

    public static function getParentOptions($excludeId = null)
    {
        $categories = self::with('parent')->get();
        
        return $categories->map(function ($category) use ($excludeId) {
            if ($category->id !== $excludeId) {
                return [
                    'id' => $category->id,
                    'full_path' => $category->fullPath,
                ];
            }
            return null;
        })->filter()->values();
    }

    protected static function booted()
    {
        static::deleting(function ($category) {
            // Move children to parent's parent when deleting
            $newParentId = $category->parent_id;
            $category->children()->update(['parent_id' => $newParentId]);
        });
    }
}
