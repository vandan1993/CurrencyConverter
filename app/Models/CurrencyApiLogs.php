<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyApiLogs extends Model
{
    use HasFactory;

    protected $table = "currencyapi_logs";

    protected $fillable = [
        'api_name',
        'end_point',
        'api_url',
        'method',
        'request',
        'response',
        'response_status',
        'exception',
        'user_id',
        'status',
        'created_at',
        'updated_at',
    ];

    // If you're using timestamps
    public $timestamps = true;


}
