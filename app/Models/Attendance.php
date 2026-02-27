<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'student_id',
        'class_id',
        'date',
        'status',
        'marked_by',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    // Attendance belongs to a student profile
    public function student()
    {
        return $this->belongsTo(StudentProfile::class, 'student_id');
    }

    // Attendance belongs to a class
    public function schoolClass()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    // Who marked attendance (teacher/admin user)
    public function marker()
    {
        return $this->belongsTo(User::class, 'marked_by');
    }
}
