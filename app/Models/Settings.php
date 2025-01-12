<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $fillable = [
        'setting_name',
        'site_name',
        'site_description',
        'dapodik_webservice',
        'dapodik_webservice_key',
        'vervalpd_email',
        'vervalpd_password',
        'active',
        'headmaster_name',
        'headmaster_id',
    ];

    protected $hidden = [
        'dapodik_webservice_key',
        'vervalpd_password',
    ];
}
