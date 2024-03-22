<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tramite extends Model
{
    use HasFactory;
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

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function category()
    {
        return $this->belongsTo(Categorie::class, 'category_id');
    }

}
