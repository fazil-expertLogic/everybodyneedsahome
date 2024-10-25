<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientSurvey extends Model
{
    use HasFactory;
    
    protected $table = 'clients_survey';

    protected $fillable = [
        'gl_ID',
        'is_food',
        'is_cloth',
        'is_shelter',
        'is_transport',
        'is_emp',
        'extra_incom',
        'church',
        'custom_church',
        'is_bcert',
        'is_DL',
        'DlicenseNo',
        'is_ss_card',
        'state_name',
        'is_state_id',
        'stateIDno',
        'ss_number',
    ];
    // Optionally, you can specify timestamps if you want to handle created_at and updated_at
    public $timestamps = true;

    // If you need to customize the date formats, you can also define a $dates property
    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
