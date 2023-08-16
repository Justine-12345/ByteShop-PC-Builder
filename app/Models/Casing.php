<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Casing extends Model
{
    use HasFactory;

    protected $primaryKey = 'casing_id';
    public $timestamps = false;
    protected $fillable = ['case_type', 'steel_thickness', 'case_motherboards', 'case_width', 'case_height', 'case_depth', 'drivebay_5point25', 'drivebay_3point5', 'drivebay_2point5', 'expansion_slot', 'max_pcislots', 'io_ports', 'height_coolers', 'aircooling_system', 'net_weight', 'casing_description', 'item_id'];

    public function item(){
        return $this->belongsTo('App\Models\Item', 'item_id');
    }
}
