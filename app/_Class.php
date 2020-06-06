<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class _Class extends Model
{
    protected $appends = ['grade', 'name'];

    /**
     * Get the class's grade.
     *
     * @param  int  $value
     * @return int
     */
    public function getGradeAttribute($value)
    {
        $year = intval(date('Y', strtotime('+6 month', strtotime(date('r')))));
        $generation = $this->getAttribute('generation');
        return ($year - (1977 + $generation)) + 13;
    }

    /**
     * Set the user's first name.
     *
     * @param  string  $value
     * @return void
     */
    public function setGradeAttribute($value)
    {
        $year = intval(date('Y', strtotime('+6 month', strtotime(date('r')))));
        $this->attributes['generation'] = ($year - 1977 - $value) + 13;
    }

    /**
     * Get the class's name.
     *
     * @param  int  $value
     * @return string
     */
    public function getNameAttribute($value)
    {
        return $this->getAttribute('grade') . " "
            . $this->getAttribute('majors') . " "
            . $this->getAttribute('class_name');
    }

    /**
     * Get the students for the class.
     */
    public function students()
    {
        return $this->hasMany('App\Student');
    }
}
