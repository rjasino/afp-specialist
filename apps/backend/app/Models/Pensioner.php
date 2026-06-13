<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pensioner extends Model
{
    protected $table = 'pensioner';

    protected $fillable = [
        'serial_number',
        'control_number',
        'first_name',
        'last_name',
        'middle_name',
        'pension_account',
        'rank',
        'bank_name',
        'amount_centavos',
        'retirement_date',
    ];
}
