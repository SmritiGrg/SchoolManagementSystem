<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = [
        'exam_name',
        'class_id',
        'start_date',
        'end_date',
        'academic_year',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    // Exam belongs to a class
    public function schoolClass()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    // Exam has many results
    public function results()
    {
        return $this->hasMany(Result::class, 'exam_id');
    }
}
