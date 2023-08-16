<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Item extends Model implements Searchable
{
    use HasFactory;
    protected $primaryKey = "item_id";
    public $timestamps = false;
    protected $fillable = ['title', 'price', 'image', 'brand_id'];

     public function orders(){
        return $this->belongsToMany('App\Models\Order', 'orderline', 'orderinfo_id', 'item_id')->withPivot('quantity')->withPivot('is_reviewed');
    }


       public function brands(){
        return $this->belongsTo('App\Models\Brand','brand_id' );
      }

      public function stock(){
        return $this->hasOne('App\Models\Stock', 'item_id');
    }

    public function processor(){
      return $this->hasOne('App\Models\Processor', 'item_id');
    }

    public function motherboard(){
      return $this->hasOne('App\Models\Motherboard', 'item_id');
    }

    public function memory(){
      return $this->hasOne('App\Models\Memory', 'item_id');
    }

    public function harddrive(){
      return $this->hasOne('App\Models\Harddrive', 'item_id');
    }

    public function soliddrive(){
      return $this->hasOne('App\Models\Soliddrive', 'item_id');
    }

    public function headphone(){
      return $this->hasOne('App\Models\Headphone', 'item_id');
    }

    public function operatingsystem(){
      return $this->hasOne('App\Models\Operatingsystem', 'item_id');
    }

    public function videocard(){
      return $this->hasOne('App\Models\Videocard', 'item_id');
    }

    public function casing(){
      return $this->hasOne('App\Models\Casing', 'item_id');
    }

    public function powersupply(){
      return $this->hasOne('App\Models\Powersupply', 'item_id');
    }

     public function keyboard(){
      return $this->hasOne('App\Models\Keyboard', 'item_id');
    }

    public function mouse(){
      return $this->hasOne('App\Models\Mouse', 'item_id');
    }

    public function monitor(){
      return $this->hasOne('App\Models\Monitor', 'item_id');
    }

    public function printer(){
      return $this->hasOne('App\Models\Printer', 'item_id');
    }


    //For Build Table Only

    public function build_processor(){
      return $this->hasMany('App\Models\Build', 'processor', 'item_id');
    }

    public function build_motherboard(){
      return $this->hasMany('App\Models\Build', 'motherboard', 'item_id');
    }

     public function build_memory(){
      return $this->hasMany('App\Models\Build', 'memory', 'item_id');
    }

     public function build_harddrive(){
      return $this->hasMany('App\Models\Build', 'harddrive', 'item_id');
    }

     public function build_soliddrive(){
      return $this->hasMany('App\Models\Build', 'soliddrive', 'item_id');
    }

    public function build_headphones(){
      return $this->hasMany('App\Models\Build', 'headphones', 'item_id');
    }

    public function build_operatingsystem(){
      return $this->hasMany('App\Models\Build', 'operatingsystem', 'item_id');
    }

    public function build_videocard(){
      return $this->hasMany('App\Models\Build', 'videocard', 'item_id');
    }


    public function build_casing(){
      return $this->hasMany('App\Models\Build', 'casing', 'item_id');
    }

    public function build_powersupply(){
      return $this->hasMany('App\Models\Build', 'powersupply', 'item_id');
    }


    public function build_keyboard(){
      return $this->hasMany('App\Models\Build', 'keyboard', 'item_id');
    }

    public function build_mouse(){
      return $this->hasMany('App\Models\Build', 'mouse', 'item_id');
    }

    public function build_monitor(){
      return $this->hasMany('App\Models\Build', 'monitor', 'item_id');
    }

    public function build_printer(){
      return $this->hasMany('App\Models\Build', 'printer', 'item_id');
    }


    public function reviews(){
      return $this->hasMany(Review::class, 'item_id');
    }

     public function messages(){
        return $this->hasMany(Message::class, 'item_id');
    }



public $searchableType = 'List Of Item';


    public function getSearchResult(): SearchResult
     {
        $url = route('item.show', $this->item_id);
     
         return new \Spatie\Searchable\SearchResult(
            $this,
            $this->title,
            $url,
           
            // $this->award_country,
         );
     }

}
