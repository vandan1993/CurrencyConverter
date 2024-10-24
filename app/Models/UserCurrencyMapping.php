<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCurrencyMapping extends Model
{
    use HasFactory;

    protected $table = "user_currency_mapping";

    protected $fillable = [
        'currency_id',
        'user_id',
    ];

    protected $casts = [
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
    ];

        // If you're using timestamps
    public $timestamps = true;

    public function currency()
    {
        return $this->belongsTo(Currency::class , 'currency_id' , 'id');
    }

}
