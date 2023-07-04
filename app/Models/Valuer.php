<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Valuer extends Model
{
    use HasFactory;

    protected $fillable =['first_name','last_name','middle','phone','physical_address','gender','valuer_number','affiliation'];

    public function user_account() {
        return $this->hasOne(User::class,'id','user_id');
    }
}
