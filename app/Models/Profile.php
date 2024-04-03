<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'date_of_birth', 
        'bio',
        'profile_pic',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
