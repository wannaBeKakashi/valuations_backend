<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Models\User;
use App\Models\FinancialInstitution;


class Post extends Model implements  HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['user_id','title','description'];

    public function user (){
        return $this.hasOne(User::class,'id','user_id');
    }
    public function creator(){
        return FinancialInstitution::where('user_id', $this->user_id)->first();
    }
}
