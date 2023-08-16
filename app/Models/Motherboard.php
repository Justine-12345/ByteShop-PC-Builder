<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motherboard extends Model
{
    use HasFactory;

    protected $primaryKey = 'motherboard_id';
    public $timestamps = false;
    protected $fillable = ['customer_id', 'form_factor', 'cpu_socket', 'usb_ports', 'ram_slot', 'video_connectors', 'pcie_slots' , 'inbuilt_wifi', 'sata', 'nvme_support', 'rgb_header', 'motherboard_description', 'item_id'];

    public function item(){
        return $this->belongsTo('App\Models\Item', 'item_id');
    }
}
