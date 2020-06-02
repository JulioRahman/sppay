<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spp extends Model
{
    protected $appends = ['year'];

    public function getYearAttribute($value)
    {
        $school_year = $this->getAttribute('school_year');
        return substr($school_year, 0, 4);
    }

    /**
     * Get the students for the spp.
     */
    public function students()
    {
        return $this->hasMany('App\Student');
    }

    /**
     * Get the payments for the spp.
     */
    public function payments()
    {
        return $this->hasMany('App\Payment');
    }
}
