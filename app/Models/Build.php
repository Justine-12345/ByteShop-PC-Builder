<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Build extends Model
{
    use HasFactory;

    protected $primaryKey = 'build_id';
    public $timestamps = false;
    protected $fillable = ['build_name','build_date', 'processor', 'motherboard', 'memory', 'harddrive', 'soliddrive', 'headphones', 'operatingsystem', 'videocard', 'casing', 'powersupply', 'keyboard', 'mouse', 'monitor', 'printer','total_price', 'powerconsumption' , 'user_id'];

    public function item_processor(){
    return $this->belongsTo('App\Models\Item', 'processor');
    }

    public function item_motherboard(){
    return $this->belongsTo('App\Models\Item', 'motherboard');
    }

     public function item_memory(){
    return $this->belongsTo('App\Models\Item', 'memory');
    }

    public function item_harddrive(){
    return $this->belongsTo('App\Models\Item', 'harddrive');
    }

    public function item_soliddrive(){
    return $this->belongsTo('App\Models\Item', 'soliddrive');
    }

    public function item_headphones(){
    return $this->belongsTo('App\Models\Item', 'headphones');
    }


    public function item_operatingsystem(){
    return $this->belongsTo('App\Models\Item', 'operatingsystem');
    }

    public function item_videocard(){
    return $this->belongsTo('App\Models\Item', 'videocard');
    }


    public function item_casing(){
    return $this->belongsTo('App\Models\Item', 'casing');
    }

    public function item_powersupply(){
    return $this->belongsTo('App\Models\Item', 'powersupply');
    }

    public function item_keyboard(){
    return $this->belongsTo('App\Models\Item', 'keyboard');
    }

    public function item_mouse(){
    return $this->belongsTo('App\Models\Item', 'mouse');
    }

    public function item_monitor(){
    return $this->belongsTo('App\Models\Item', 'monitor');
    }

    public function item_printer(){
    return $this->belongsTo('App\Models\Item', 'printer');
    }
//For customer only
    public function user(){
    return $this->belongsTo('App\Models\User', 'user_id');
    }

}
