<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['area_id', 'nombre', 'direccion', 'lat', 'lng', 'email', 'telefono', 'horario'];

    public function children()
    {
        return $this->hasMany(Area::class, 'area_id');
    }

    public function parent()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }
    
}
