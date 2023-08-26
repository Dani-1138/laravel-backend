<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $primaryKey = 'student_id';
    use HasFactory;

    protected $fillable = [
        'student_id',
        'firstName',
        'middleName',
        'lastName',
        'email',
        'password',
        'sex',
        'age',
        'phone',
        'entranceResult',
        'cgpa',
        'cocResult',
        'department',
        'batch',
        'status'
    ];
}
