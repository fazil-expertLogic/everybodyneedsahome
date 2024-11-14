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
}
