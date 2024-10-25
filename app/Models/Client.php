<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';

    protected $fillable = [
        'cus_name',
        'cus_dob',
        'cus_ss',
        'martial_status',
        'is_child',
        'address',
        'city',
        'state',
        'zipcode',
        'phone',
        'email',
    ];
    // Optionally, you can specify timestamps if you want to handle created_at and updated_at
    public $timestamps = true;

    // If you need to customize the date formats, you can also define a $dates property
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function ClientChild()
    {
        return $this->hasMany(ClientChild::class,'gl_ID','id');
    }

    public function criminalHistories()
    {
        return $this->hasOne(ClientCriminalHistory::class, 'gl_ID', 'id');
    }

    public function info()
    {
        return $this->hasOne(ClientInfo::class, 'gl_ID', 'id');
    }

    public function healthIns()
    {
        return $this->hasOne(ClientsHealthIns::class, 'gl_ID', 'id');
    }

    public function surveys()
    {
        return $this->hasOne(ClientSurvey::class, 'gl_ID', 'id');
    }

    public function scopeWithAllRelations($query)
    {
        return $query->with(['ClientChild', 'criminalHistories', 'info', 'healthIns', 'surveys']);
    }
}
