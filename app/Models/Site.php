<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'land_size',
        'land_height',
        'land_width',
        'land_shape',
        'topography',
        'access',
        'view',
        'security',
        'utilities',
        'onsite_improvements',
        'offsite_improvements',
    ];

    public function property () {
        return $this->belongsTo(Property::class);
    }
}
