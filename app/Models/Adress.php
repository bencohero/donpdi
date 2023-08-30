<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Adress extends Model
{
    use HasFactory;

    protected $fillable = [
        'pays',
        'ville',
        'postal',
    ];

    public function residents(): HasMany
    {
        return $this->hasMany(User::class, 'adresse_id');
    }
}
