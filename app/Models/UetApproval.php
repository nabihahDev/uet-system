<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UetApproval extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'timb_peg_turus_at' => 'datetime',
            'setiausaha_at' => 'datetime',
        ];
    }

    /**
     * Get the UET request associated with this approval.
     */
    public function uetRequest(): BelongsTo
    {
        return $this->belongsTo(UetRequest::class);
    }

    /**
     * Get the officer (Timb Peg Turus) who signed/approved the request.
     */
    public function timbPegTurus(): BelongsTo
    {
        return $this->belongsTo(User::class, 'timb_peg_turus_id');
    }

    /**
     * Get the secretary (Setiausaha) who verified/approved the request.
     */
    public function setiausaha(): BelongsTo
    {
        return $this->belongsTo(User::class, 'setiausaha_id');
    }
}