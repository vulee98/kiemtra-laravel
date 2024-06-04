<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mf extends Model
{
    use HasFactory;
    protected $table ='mfs';
    public function cars()
    {
        return $this->hasMany(Car::class,'mf_id','id');
    }
}