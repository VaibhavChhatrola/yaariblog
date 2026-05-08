<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'slug',
        'image',
        'short_description',
        'content',
        'category_id',
        'status',
    ];

    // ─── Accessors ─────────────────────────────────────────────────────────────

    /**
     * Returns the full public URL for the blog image.
     * Falls back to a placeholder if no image is stored.
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->image && \Storage::disk('public')->exists($this->image)) {
            return asset('storage/' . $this->image);
        }
        // Inline SVG placeholder URL via UI Avatars (no external image needed)
        $catName = $this->category ? $this->category->name : 'Blog';
        return 'https://placehold.co/800x400/0D1B2A/F59E0B?text=' . urlencode($catName);
    }

    /**
     * Returns a Bootstrap badge CSS class based on the blog category.
     */
    public function getCategoryBadgeClassAttribute(): string
    {
        $catName = $this->category ? $this->category->name : '';
        return match ($catName) {
            'Admit Card' => 'badge-admit',
            'Result'     => 'badge-result',
            'News'       => 'badge-news',
            default      => 'badge-news', // Premium gold color fallback
        };
    }

    /**
     * Define the relationship to Category.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Returns a short excerpt from the short_description (max 120 chars).
     */
    public function getExcerptAttribute(): string
    {
        return Str::limit($this->short_description, 120);
    }

    // ─── Scopes ────────────────────────────────────────────────────────────────

    /**
     * Scope to filter blogs by category slug.
     */
    public function scopeByCategory($query, $categorySlug)
    {
        return $query->whereHas('category', function($q) use ($categorySlug) {
            $q->where('slug', $categorySlug);
        });
    }

    /**
     * Scope to search blogs by title (case-insensitive LIKE).
     */
    public function scopeSearch($query, string $term)
    {
        return $query->where('title', 'LIKE', "%{$term}%");
    }
}
