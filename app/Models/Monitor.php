<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitor extends Model
{
    use HasFactory;
    protected $primaryKey = 'monitor_id';
    public $timestamps = false;
    protected $fillable = ['minitor_size','monitor_resolution', 'monitor_aspect', 'panel_type', 'refresh_rate', 'response_time', 'synchronisation_technology', 'viewing_angle', 'input_connectors', 'monitor_curvature', 'monitor_brightness', 'monitor_hdr', 'monitor_contrast', 'monitor_colorspace', 'monitor_description', 'item_id'];

    public function item(){
    return $this->belongsTo('App\Models\Item', 'item_id');
    }
    
}
