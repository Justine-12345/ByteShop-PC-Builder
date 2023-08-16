<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operatingsystem extends Model
{
    use HasFactory;

    protected $primaryKey = 'operatingsystem_id';
    public $timestamps = false;
    protected $fillable = ['processor_speed','memory_requirement', 'space_requirement', 'graphiccard_requirement', 'item_id'];

    public function item(){
        return $this->belongsTo('App\Models\Item', 'item_id');
    }
}
