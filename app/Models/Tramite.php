<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;


class Tramite extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'area_id',
        'category_id',
        'status',
        'title',
        'slug',
        'summary',
        'procedure',
        'requirements',
        'who',
        'when',
        'previous',
        'cost',
        'online',
        'url',
        'time',
        'more',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($tramite) {
            // Generar y asignar el slug antes de guardar
            if (empty($tramite->slug)) {
                $tramite->slug = Str::slug($tramite->title);
            }
        });
    }


    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function category()
    {
        return $this->belongsTo(Categorie::class, 'category_id');
    }

}
