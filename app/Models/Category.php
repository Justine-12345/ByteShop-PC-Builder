<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
  
      protected $primaryKey = "category_id";

      public $timestamps = false;
      protected $fillable = ['category_name'];

      public function brands(){
        return $this->hasMany('App\Models\Brand', 'category_id');
      }

}
