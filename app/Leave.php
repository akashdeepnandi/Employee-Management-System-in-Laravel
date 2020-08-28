<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $fillable = ['employee_id', 'reason', 'description', 'half_day', 'start_date', 'end_date'];
    protected $dates = ['created_at', 'updated_at', 'start_date', 'end_date'];
    public function employee() {
        return $this->belongsTo('App\Employee');
    }

    // public function getStartAttribute($date) {
    //     return Carbon::parse($date);
    // }
}
