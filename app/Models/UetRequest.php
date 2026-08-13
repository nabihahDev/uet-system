<?php
// app/Models/UetRequest.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UetRequest extends Model
{
    protected $fillable = ['applicant_id', 'reference_no', 'kepada', 'daripada', 'unit', 'jku_bil', 'request_date', 'alasan_keterangan', 'status'];

    public function items(): HasMany
    {
        return $this->hasMany(UetRequestItem::class);
    }

    public function applicant(): BelongsTo
    {
        return $this->belongsTo(User::class, 'applicant_id');
    }
}