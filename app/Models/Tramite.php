<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Tramite extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

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

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('documentos')
            ->acceptsFile(function ($file) {
                return in_array($file->mimeType, ['application/pdf', 'image/jpeg', 'image/png']);
            });
    }
}
