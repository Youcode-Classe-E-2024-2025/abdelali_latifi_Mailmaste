<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $fillable = [
        'email',
        'name',
    ];


    // Un abonné peut recevoir plusieurs campagnes
    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class)
                    ->withPivot('opened')
                    ->withTimestamps();
    }
}
