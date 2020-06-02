<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /**
     * Get the operator that owns the payment.
     */
    public function operator()
    {
        return $this->belongsTo('App\User', 'operator_id');
    }

    /**
     * Get the student that owns the payment.
     */
    public function student()
    {
        return $this->belongsTo('App\Student', 'student_nisn', 'nisn');
    }

    /**
     * Get the spp that owns the payment.
     */
    public function spp()
    {
        return $this->belongsTo('App\Spp');
    }
}
