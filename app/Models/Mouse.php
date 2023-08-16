<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mouse extends Model
{
    use HasFactory;
    protected $table = 'mouses';

    protected $primaryKey = 'mouse_id';
    public $timestamps = false;
    protected $fillable = ['sensor', 'dpi', 'poll_rate', 'tracking_speed', 'build_type', 'mouse_wired', 'programmable_button', 'weight_customization', 'liftoff_distance', 'angle_snapping', 'mouse_description', 'item_id'];

    public function item(){
        return $this->belongsTo('App\Models\Item', 'item_id');
    }
}
