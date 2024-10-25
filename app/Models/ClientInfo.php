<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientInfo extends Model
{
    use HasFactory;
    protected $table = 'clients_info';
    protected $fillable = [
        'gl_ID',
        'more_friends',
        'counselor',
        'is_inv_rom',
        'is_mental_ill',
        'phy_dis',
        'comments',
    ];
    public $timestamps = true;

    // If you need to customize the date formats, you can also define a $dates property
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    
    public function client()
    {
        return $this->belongsTo(Client::class, 'gl_ID', 'gl_ID');
    }
}
