<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'subject_name',
        'subject_code',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    // A subject can belong to many classes (via class_subjects)
    public function classSubjects()
    {
        return $this->hasMany(ClassSubject::class, 'subject_id');
    }

    // If you want direct access to classes (Many-to-Many)
    public function classes()
    {
        return $this->belongsToMany(
            Classes::class,
            'class_subjects',
            'subject_id',
            'class_id'
        );
    }

    public function results()
    {
        return $this->hasMany(Result::class, 'subject_id');
    }
}
