<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tramite extends Model
{
    use HasFactory;
    protected $fillable = [
        'titulo',
        'area_id',
        'categoria',
        'estado',
    ];

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

}
