<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Area extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['area_id', 'nombre', 'direccion', 'lat', 'lng', 'email', 'telefono', 'horario', 'status', 'slug'];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($area) {
            if (empty($area->slug)) {
                $area->slug = Str::slug($area->nombre);
            }
        });
    }

    public function children()
    {
        return $this->hasMany(Area::class, 'area_id');
    }

    public function parent()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

}
