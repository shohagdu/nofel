<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkshopRegistration extends Model
{
    use HasFactory;
    protected $table = 'workshop_registration';

    protected $fillable = [
        'title',
        'member_id',
        'name',
        'institute',
        'degree',
        'mobile',
        'email',
        'subs_ctg',
        'package_category',
        'attend_days',
        'amount',
        'payment_id',
        'payment_status_code',
        'updated_at',
        'updated_ip',
        'is_payment_status',
        'bkash_success_response',
        'to_bksah',
        'bkash_mobile',
        'bkash_trans_id',
        // Add other attributes as needed
    ];
}

