<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    //
    protected $fillable = ['employee_id', 'entry_ip', 'entry_time', 'entry_location'];
    public function employee() {
        return $this->belongsTo('App\Employee');
    }
}
