<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function department(){
        return $this->belongsTo(\App\Models\Department::class,'department_id');
    }

  
    public function user() {
        return $this->belongsTo(\App\Models\User::class);
    }

}
