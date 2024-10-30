<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;
    protected $table = 'providers';

    protected $fillable = [
        'gl_ID',
        'provider_name',
        'comany_name',
        'Type',
        'address',
        'city',
        'state',
        'zipcode',
        'phone',
        'email',
        'website',
        'area_served',
        'custom_area_served',
        'status',
        'user_id',
        'profile_image'
    ];
    // Optionally, you can specify timestamps if you want to handle created_at and updated_at
    public $timestamps = true;

    // If you need to customize the date formats, you can also define a $dates property
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function softDeleteRelations()
    {
        // Update the status to 0 for each relation
        $this->status = 0;
        $this->save();
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    
}
