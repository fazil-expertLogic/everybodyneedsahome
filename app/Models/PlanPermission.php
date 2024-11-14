<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanPermission extends Model
{
    use HasFactory;
    protected $table = 'plan_permissions';

    protected $fillable = [
        'plan_id',
        'plan_menu_id',
        'is_view',
    ];
    
    public function membership()
    {
        return $this->belongsTo(Membership::class, 'plan_id');
    }

    /**
     * Get the plan menu associated with this plan permission.
     */
    public function planMenu()
    {
        return $this->belongsTo(PlanMenu::class, 'plan_menu_id');
    }
}
