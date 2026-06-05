<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //insert into () makanya pakai protected
    protected $fillable = ['name', 'is_active'];


}
