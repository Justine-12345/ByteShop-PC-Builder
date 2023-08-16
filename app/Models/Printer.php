<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Printer extends Model
{
    use HasFactory;

    protected $primaryKey = 'printer_id';
    public $timestamps = false;
    protected $fillable = ['printer_type', 'ink_type', 'all_inOne', 'print_speed', 'duplex_support', 'automatic_feed', 'dpi', 'paper_capacity', 'duty_cycle', 'catridge_capacity', 'connection_interface', 'scanner_resolution', 'copy_speed', 'printer_memory', 'encryption_support', 'printer_description', 'item_id'];

    public function item(){
    return $this->belongsTo('App\Models\Item', 'item_id');
    }
}
