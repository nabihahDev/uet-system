<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BafRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'reference_no',
        'requisition_type',
        'unit',
        'required_by_date',
        'priority',
        'part_issue',
        'daripada',
        'employee_code',
        'request_date',
        'status',
        'work_order_no',
        'equipment_no',
        'vote_sub_head',
        'picking_slip',
        'delivery_instructions',
        'attachment_path',
        'signature_path', 
        'signature_hash',
        'vote_title',
        'vote_signature_path',
        'vote_date',
        'auth_title',
        'auth_code',
        'auth_signature_path',
        'auth_date',
        'remarks',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function items()
    {
        return $this->hasMany(BafRequestItem::class, 'baf_request_id');
    }
}