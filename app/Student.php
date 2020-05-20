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
}
