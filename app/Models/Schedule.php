<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function Teacher(){
        return $this->belongsTo(\App\Models\Teacher::class);
    }
    
    public function Department(){
        return $this->belongsTo(\App\Models\Department::class);
    }

    public function Material(){
        return $this->belongsTo(\App\Models\Material::class);
    }
}
