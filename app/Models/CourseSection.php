<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseSection extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get all of the lectures for the CourseSection
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lectures(): HasMany
    {
        return $this->hasMany(CourseLecture::class, 'section_id');
    }
}
