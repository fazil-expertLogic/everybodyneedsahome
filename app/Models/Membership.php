<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'features',
        'description',
        'status',
        'plan_type'
    ];

    public function purchasePlans()
    {
        return $this->hasMany(PurchasePlan::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    public function softDeleteRelations()
    {
        $this->status = 0;
        $this->save();
    }

    public function scopeMonthlyPlan($query)
    {
        return $query->where('plan_type', 'Monthly');
    }

    public function scopeYearlyPlan($query)
    {
        return $query->where('plan_type', 'Yearly');
    }
    // In Membership model (app/Models/Membership.php)

    public function scopeNameWithPrice($query)
    {
        return $query->active()->get(['id', 'name', 'price'])->mapWithKeys(function ($membership) {
            return [$membership->id => $membership->name . ' - ' . $membership->price];
        });
    }

}
