<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Event extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'category_id',
        'title',
        'description',
        'location',
        'date',
        'available_seats',
        'created_by',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function bookings(){
        return $this->hasMany(Booking::class);
    }

    public function creator(){
        return $this->belongsTo(User::class, 'created_by');
    }

    public function registerMediaConversions(?\Spatie\MediaLibrary\MediaCollections\Models\Media $media = null): void
    {
        $this
            ->addMediaConversion('thumb')
            ->width(200)
            ->height(200)
            ->sharpen(10);
    }
}
