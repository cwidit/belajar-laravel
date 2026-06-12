<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //insert into () makanya pakai protected
    protected $fillable = ['name', 'is_active'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function users()
        {
            return $this->belongsToMany(User::class, 'user_roles');
        }

}
