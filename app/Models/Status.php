<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Status extends Model
{
    use HasFactory;

    protected $fillable = [
        'ormas_id',
        'status',
        'changed_by',
    ];

    /**
     * Relasi dengan model Ormas
     */
    public function ormas(): BelongsTo
    {
        return $this->belongsTo(Ormas::class);
    }

    /**
     * Relasi dengan model User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}
