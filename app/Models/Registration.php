<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class Registration extends Model implements AuthenticatableContract
{
    use HasFactory, Authenticatable;

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

    // Define hidden attributes
    protected $hidden = [
        'password', // Ensure the password is hidden when the model is converted to an array or JSON
    ];
}
