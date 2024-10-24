<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersReportRequest extends Model
{
    use HasFactory;

    protected $table = "users_report_request";

    protected $fillable = [
        'currency',
        'source',
        'user_id',
        'report_name',
        'report_interval',
        'report_request_time',
        'report_status',
        'report_processing_time',
        'quote_data',
        'reason'
    ];

    protected $casts = [
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
        'report_request_time' => 'datetime',
        'report_processing_time' => 'datetime',
    ];

        // If you're using timestamps
    public $timestamps = true;

}
