<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;

    protected $casts = [
        'items' => 'array',
    ];
    
    public function webuser(){
        return $this->belongsTo(Webuser::class);
    }
}
