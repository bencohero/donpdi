<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Don extends Model
{
    use HasFactory;

    protected $fillable = [
        'montant',
        'numeroTransaction',
        'token',
        'id_donateur'
    ];

    public function donateur(): BelongsTo
    {
        return $this->belongsTo(User::class,'','id');
    }
}
