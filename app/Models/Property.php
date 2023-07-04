<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Property extends Model implements  HasMedia
{
    use HasFactory,  InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'property_number',
        'owner_name',
        'property_type',
        'property_design',
        'construction_stage',
        'year_built',
        'age',
        'eul',
        'rel',
        'measurements',
        'no_rooms',
        'no_of_bathrooms',
        'occupancy',
        'attributes',
        'title_deeds_available',
        'certificate_of_search_available',
        'encumbrances_available',
        'defects',
    ];

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function location() {
        return $this->hasOne(Location::class);
    }

    public function site() {
        return $this->hasOne(Site::class);
    }

    public function valuation() {
        return $this->hasOne(Valuation::class);
    }
}
