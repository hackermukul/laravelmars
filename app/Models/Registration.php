<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Registration extends Model
{
    use HasFactory;

    // Define the table name if it's not the plural of the model name
    protected $table = 'registrations';

    // Define the fillable fields for mass assignment
    protected $fillable = [
        'name',
        'registrations_type',
        'father_name',
        'mobile_no',
        'email',
        'course',
        'semester',
        'roll_no',
        'academic_session',
        'user_id',
        'password',
        'department',
        'child_name',
        'session',
        'status',
        'added_by',
        'updated_by',
        'is_deleted',
        'is_deleted_by',
        'is_deleted_on',
    ];
    
}
