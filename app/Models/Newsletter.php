<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
    ];

     // Une newsletter peut être utilisée dans plusieurs campagnes
     public function campaigns()
     {
         return $this->hasMany(Campaign::class);
     }
}
