<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasePlan extends Model
{
    use HasFactory;

    // Define the table associated with the model (optional if the table name is the plural form of the model name)
    protected $table = 'purchase_plan';

    // The primary key for the table (optional, since Laravel assumes 'id' as the primary key)
    protected $primaryKey = 'id';

    // The attributes that are mass assignable
    protected $fillable = [
        'user_id',
        'membership_id',
        'purchase_date',
        'stripeToken',
        'last4',
        'exp_month',
        'exp_year',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with the Membership model
    public function membership()
    {
        return $this->belongsTo(Membership::class);
    }
}
