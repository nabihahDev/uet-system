<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BafRequest extends Model
{
    use HasFactory;

    protected $table = 'baf_requests';

    protected $casts = [
        'items' => 'array',
        'user_section' => 'array',
        'oc_section' => 'array',
        'co_section' => 'array',
        'qm_section' => 'array',
        'pegawai_section' => 'array',
        'mindef_section' => 'array',
        'required_by' => 'date',
    ];

    protected $fillable = [
        'unit_code',
        'priority',
        'required_by',
        'status',
        'items',
        'user_section',
        'oc_section',
        'co_section',
        'qm_section',
        'pegawai_section',
        'mindef_section',
        'created_by',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
