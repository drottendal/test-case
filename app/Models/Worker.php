<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference_id',
        'email',
        'ssn',
        'phone',
        'first_name',
        'last_name',
        'dob',
        'salary',
        'employment_from',
        'employment_to',
        'currently_working'
    ];
}
