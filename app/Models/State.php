<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];
    
    public function softDeleteRelations(){
        $this->status = 0;
        $this->save();
    }
    
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
