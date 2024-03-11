<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BlogPost extends Model
{
    use HasFactory, Sluggable;
    protected $guarded = [];

    /**
     * Get the blogcat that owns the BlogPost
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function blogcat(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'blogcat_id');
    }

    public function sluggable(): array
    {
        return [
            'post_slug' => [
                'source' => 'post_title'
            ]
        ];
    }
}
