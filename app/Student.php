<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'nisn';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Get the class that owns the student.
     */
    public function class()
    {
        return $this->belongsTo('App\_Class', '__class_id');
    }

    /**
     * Get the spp that owns the student.
     */
    public function spp()
    {
        return $this->belongsTo('App\Spp');
    }

    /**
     * Get the payments for the student.
     */
    public function payments()
    {
        return $this->hasMany('App\Payment', 'student_nisn', 'nisn');
    }
}
