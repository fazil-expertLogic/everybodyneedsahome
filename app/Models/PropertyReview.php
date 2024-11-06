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
        'status',
        'approved'
    ];

    
    public function property()
    {
        return $this->belongsTo(Property::class)->where('status', 1);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeApproved($query)
    {
        return $query->where('approved', 1);
    }

    public function softDeleteRelations()
    {
        $this->status = 0;
        $this->save();
    }
}
