<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherProfile extends Model
{
    protected $fillable = [
        'user_id',
        'employee_id',
        'qualification',
        'experience_years',
        'joining_date',
        'salary',
        'subject_id'
    ];

    protected $casts = [
        'joining_date' => 'date',
        'salary' => 'decimal:2',
        'experience_years' => 'integer',
    ];

    /**
     * Relationship: TeacherProfile belongs to User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function classSubjects()
    {
        return $this->hasMany(ClassSubject::class, 'teacher_id');
    }

    public function classTeacher()
    {
        return $this->hasOne(Classes::class, 'class_teacher_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
