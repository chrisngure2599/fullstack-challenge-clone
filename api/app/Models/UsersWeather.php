<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersWeather extends Model
{
    use HasFactory;
    protected $fillable = ['*'];
    protected $table="user_weather";

    public function user()
    {
        return $this->belongsTo( new User);
    }
}
