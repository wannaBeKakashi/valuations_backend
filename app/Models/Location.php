<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'district',
        'area',
        'google_map_link',
        'latitude',
        'longitude',
        'zone_category',
        'zoning',
    ];

    public function property () {
        return $this->belongsTo(Property::class);
    }
}
