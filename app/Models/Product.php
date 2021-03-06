<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Rinvex\Categories\Traits\Categorizable;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use Categorizable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description'
    ];
    
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
    }
    
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
        ->height(100);
    }
    
    public function prices(){
        return $this->hasMany(Price::class);
    }
}
