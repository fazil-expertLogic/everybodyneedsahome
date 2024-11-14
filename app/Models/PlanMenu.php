<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanMenu extends Model
{
    use HasFactory;
    protected $table = 'plan_menus';

    protected $fillable = [
        'name',
    ];
    
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

   

    public function planPermissions()
    {
        return $this->hasMany(PlanPermission::class, 'plan_menu_id');
    }
}
