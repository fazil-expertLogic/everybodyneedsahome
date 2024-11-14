<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'menus';
    protected $fillable = [
        'name',
        'icon',
        'route',
        'order_by'
    ];

    public function softDeleteRelations()
    {
        $this->status = 0;
        $this->save();
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1)->orderBy('order_by','asc');
    }
    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
}
