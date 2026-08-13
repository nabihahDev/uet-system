<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UetRequestItem extends Model
{
    protected $fillable = [
        'uet_request_id',
        'item_unit',
        'nama_barang',
        'qty_dipohon',
        'qty_diluluskan',
        'muka_surat_jku',
        'status_pindaan',
    ];

    public function uetRequest(): BelongsTo
    {
        return $this->belongsTo(UetRequest::class);
    }
}