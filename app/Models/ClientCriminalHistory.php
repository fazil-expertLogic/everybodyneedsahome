<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientCriminalHistory extends Model
{
    use HasFactory;
    
    protected $table = 'clients_criminal_history';

    protected $fillable = [
        'gl_ID',
        'role',
        'date_of_con',
        'conviction',
        'conq',
        'is_sex_off',
        'is_offend_minor',
    ];
    // Optionally, you can specify timestamps if you want to handle created_at and updated_at
    public $timestamps = true;

    // If you need to customize the date formats, you can also define a $dates property
    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
