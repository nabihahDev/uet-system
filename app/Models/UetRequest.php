<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\UetRequestItem;
use App\Models\UetApproval;

class UetRequest extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function applicant()
    {
        return $this->belongsTo(User::class, 'applicant_id');
    }

    public function items()
    {
        return $this->hasMany(UetRequestItem::class);
    }

    public function approval()
    {
        return $this->hasOne(UetApproval::class);
    }
}