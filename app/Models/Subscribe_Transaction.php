<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscribe_Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'total_amount',
        'is_paid',
        'proof',
        'subscription_start_date',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    
}
