<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model{
    use HasFactory;
    protected $guarded=[];

    public function Teacher(){
        return $this->hasMany(\App\Models\Teacher::class);
    }
    
    public function Material(){
        return $this->hasMany(\App\Models\Material::class);
    }
}
