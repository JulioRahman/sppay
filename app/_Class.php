<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class _Class extends Model
{
    protected $appends = ['grade'];

    /**
     * Get the class's grade.
     *
     * @param  int  $value
     * @return int
     */
    public function getGradeAttribute($value)
    {
        $generation = $this->getAttribute('generation');
        return (intval(date('Y')) - (1977 + $generation)) + 13;
    }

    /**
     * Set the user's first name.
     *
     * @param  string  $value
     * @return void
     */
    public function setGradeAttribute($value)
    {
        $this->attributes['generation'] = (intval(date('Y')) - 1977 - $value) + 13;
    }
}
