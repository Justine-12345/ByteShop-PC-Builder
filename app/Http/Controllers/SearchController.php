<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Searchable\Search;
use App\Models\Item;
use App\Models\Brand;

class SearchController extends Controller
{
     public function search(Request $request){
        // dd($request->search);
        $searchResults = (new Search())
           ->registerModel(Item::class, 'title')
           ->search($request->search);
           // dd($searchResults);
       // return view('item.search',compact('searchResults'));
           $brands = Brand::with('category')->get();
          return view('search',compact('searchResults','brands'));
    }
}
