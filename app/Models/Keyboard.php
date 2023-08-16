<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keyboard extends Model
{
    use HasFactory;

    protected $primaryKey = 'keyboard_id';
    public $timestamps = false;
    protected $fillable = ['keyboard_width', 'keyboard_length', 'keyboard_depth', 'keyboard_weight', 'keyboard_wired', 'style_keys', 'full_keyboard', 'color', 'battery', 'extra_features', 'keyboard_layout', 'keyboard_description', 'item_id' ];

    public function item(){
        return $this->belongsTo('App\Models\Item', 'item_id');
    }
}
