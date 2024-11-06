<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyReview extends Model
{
    use HasFactory;
    protected $fillable = [
        'property_id',
        'reviewer_name',
        'reviewer_email',
        'comment',
        'rating',
        'status'
    ];

    /**
     * Relationship to the Property model
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
