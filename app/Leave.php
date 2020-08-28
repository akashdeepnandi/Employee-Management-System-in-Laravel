<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $fillable = ['employee_id', 'reason', 'description', 'half_day', 'start_date', 'end_date'];
    public function employee() {
        return $this->belongsTo('App\Employee');
    }
}
