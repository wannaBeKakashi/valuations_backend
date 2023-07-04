<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class FinancialInstitution extends Model implements  HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable =['name','phone','physical_address','institution_type'];

    
}
