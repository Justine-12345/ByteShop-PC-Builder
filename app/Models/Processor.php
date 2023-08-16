<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;
class Processor extends Model
{
    use HasFactory;

   protected $primaryKey = "processor_id";
   public $timestamps = false;
    protected $fillable = ['base_speed', 'max_speed','overclocking','core_count', 'multi_threading', 'cache', 'memory_type', 'socket_type', 'tdp_rating', 'fabrication', 'ingrated_graphics', 'processor_wattage','processor_score', 'processor_description','item_id'];

    public function item(){
        return $this->belongsTo(Item::class, 'item_id');
    }

    
} 
