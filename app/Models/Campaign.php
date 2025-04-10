<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'newsletter_id',
        'status',
        'scheduled_at',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
    ];

    // Une campagne est liée à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Une campagne utilise une newsletter
    public function newsletter()
    {
        return $this->belongsTo(Newsletter::class);
    }

    // Une campagne est envoyée à plusieurs abonnés
    public function subscribers()
    {
        return $this->belongsToMany(Subscriber::class)
                    ->withPivot('opened')
                    ->withTimestamps();
    }
}
