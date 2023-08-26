<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    use HasFactory;
    protected $primaryKey = 'student_id';
    protected $fillable = [
        'student_id',
        'student_first_name',
        'student_middle_name',
        'student_last_name',
        'complain_type',
        'complain',
        'response'];
}
