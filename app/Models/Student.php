<?php

namespace App\Models;
use App\Models\Major;
use Illuminate\Database\Eloquent\Model;


class Student extends Model
{
    protected $fillable=[
        'major_id',
        'name',
        'phone'
    ];

    //belongsTo
    //leftJoin
   public function major()
{
    return $this->belongsTo(Major::class, 'major_id', 'id');
}
}
