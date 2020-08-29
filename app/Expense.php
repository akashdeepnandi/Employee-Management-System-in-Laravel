<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['employee_id', 'reason', 'description', 'amount', 'receipt'];

    public function employee() {
        return $this->belongsTo('App\Employee');
    }
}
