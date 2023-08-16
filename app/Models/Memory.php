<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memory extends Model
{
    use HasFactory;


    protected $primaryKey = 'memory_id';
    public $timestamps = false;
    protected $fillable = ['memory_size', 'memory_type', 'frequency', 'cas_latency', 'memory_bandwidth', 'overclocking_support', 'heat_spreader', 'rgb_support', 'memory_description', 'item_id'];

    public function item(){
    return $this->belongsTo('App\Models\Item', 'item_id');
    }

}
