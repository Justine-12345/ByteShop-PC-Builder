<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videocard extends Model
{
    use HasFactory;
       protected $primaryKey = 'videocard_id';

    protected $fillable = ['gpu_brand', 'core_count', 'clock_speed', 'memory_type', 'memory_size', 'memory_bandwidth', 'thermal_designpower', 'power_connectors', 'video_outputports', 'api_support', 'computer_performance','gpu_wattage', 'gpu_score', 'gpu_description', 'item_id'];
    public $timestamps = false;
    public function item(){
        return $this->belongsTo('App\Models\Item', 'item_id');
    }
}
