<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BafRequestItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'baf_request_id', 
        'item_description', 
        'unit_of_measure', 
        'quantity_demanded', 
        'quantity_issued', 
        'req_type_sp',
        'stock_code',
        'suggested_mfr',
        'part_no',
        'est_cost',
        'ipc_ref',
        'equip_used_on',
        'remarks'
    ];

    public function bafRequest()
    {
        return $this->belongsTo(BafRequest::class, 'baf_request_id');
    }
}