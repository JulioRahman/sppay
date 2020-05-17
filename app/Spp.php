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
}
