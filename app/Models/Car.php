<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $table='Cars';
    public function mf()
    {
        
        return $this->belongsTo(Mf::class,'mf_id','id');
    }
    // protected $fillable = ['description', 'model', 'produced_on', 'image_file', 'mf_id'];
}
