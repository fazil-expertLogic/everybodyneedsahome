<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientChild extends Model
{
    use HasFactory;
    
    protected $table = 'clients_child';

    protected $fillable = [
        'gl_ID',
        'child_name',
        'child_age',
    ];
    // Optionally, you can specify timestamps if you want to handle created_at and updated_at
    public $timestamps = true;

    // If you need to customize the date formats, you can also define a $dates property
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'gl_ID', 'gl_ID')->where('status', 1);
    }
}
