<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $dates = ['created_at', 'updated_at', 'start_date', 'end_date'];
    protected $fillable = ['name', 'start_date', 'end_date'];
}
