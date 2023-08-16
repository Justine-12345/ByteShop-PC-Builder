<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\Brands;
use DB;
use Redirect;
class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $item = Item::with('brands')->where('item_id',$id)->first();
        $id = $item->item_id;
        $category = Category::where('category_id', $item->brands->category_id)->first();
        $cat = $category->category_name;

        

        if($cat == "casing"){
              $casings = DB::table('casings AS c')->join('items AS i', 'i.item_id', '=', 'c.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->select('*')->where('i.item_id', '=', $id)->get();

              $case_motherboards = explode(' | ', $casings[0]->case_motherboards);

              return view('casing.show', compact('casings', 'case_motherboards'));
        }

         if($cat == "harddrive"){
                    $harddrives = DB::table('harddrives AS m')->join('items AS i', 'i.item_id', '=', 'm.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->where('i.item_id', '=', $id)->select('*')->get();

                return view('harddrive.show', compact('harddrives'));
        }
        if($cat == "headphone"){
                      $headphones= DB::table('headphones AS h')->join('items AS i', 'i.item_id', '=', 'h.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->where('i.item_id', '=', $id)->select('*')->get();

                return view('headphone.show', compact('headphones'));
        }

        if($cat == "keyboard"){
                $keyboards = DB::table('keyboards AS k')->join('items AS i', 'i.item_id', '=', 'k.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->where('i.item_id', '=', $id)->select('*')->get();          

                return view('keyboard.show', compact('keyboards'));
        }

        if($cat == "memory"){
                $memories = Item::join('brands','items.brand_id','brands.brand_id')->join('memories','items.item_id','memories.item_id')->join('stocks','items.item_id','stocks.item_id')->where('items.item_id',$id)->first();          

                return view('memory.show', compact('memories'));
        }
        if($cat == "monitor"){
                $monitors = Item::join('brands','items.brand_id','brands.brand_id')->join('monitors','items.item_id','monitors.item_id')->join('stocks','items.item_id','stocks.item_id')->where('items.item_id',$id)->first();          

                return view('monitor.show', compact('monitors'));
        }
        if($cat == "motherboard"){
                 $motherboards = DB::table('motherboards AS m')->join('items AS i', 'i.item_id', '=', 'm.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->where('i.item_id', '=', $id)->select('*')->get();      
                return view('motherboard.show', compact('motherboards'));
        }
        if($cat == "mouse"){
                 $mouses = DB::table('mouses AS m')->join('items AS i', 'i.item_id', '=', 'm.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->where('m.item_id', '=', $id)->select('*')->get();      
                return view('mouse.show', compact('mouses'));
        }
        if($cat == "operatingsystem"){
                 $operatingsystems = DB::table('operatingsystems AS o')->join('items AS i', 'i.item_id', '=', 'o.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->where('i.item_id', '=', $id)->select('*')->get();       
                return view('operatingsystem.show', compact('operatingsystems'));
        }
        if($cat == "powersupply"){
                 $powersupply = DB::table('powersupplies AS c')->join('items AS i', 'i.item_id', '=', 'c.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->select('*')->where('i.item_id', '=', $id)->first();   
                $protection = explode(' | ', $powersupply->protection);
                return view('powersupply.show', compact('powersupply', 'protection'));
        }
        if($cat == "printer"){
                 $printers = DB::table('printers AS p')->join('items AS i', 'i.item_id', '=', 'p.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->where('i.item_id', '=', $id)->select('*')->get();
                $connection_interface = explode(' | ', $printers[0]->connection_interface);
                return view('printer.show', compact('printers', 'connection_interface'));
        }
        if($cat == "processor"){
                $processor = DB::table('processors AS k')->join('items AS i', 'i.item_id', '=', 'k.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->where('i.item_id', '=', $id)->select('*')->first();
                return view('processor.show', compact('processor'));
        }
        if($cat == "soliddrive"){
               $soliddrive = DB::table('soliddrives AS k')->join('items AS i', 'i.item_id', '=', 'k.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->where('i.item_id', '=', $id)->select('*')->first();
                return view('soliddrive.show', compact('soliddrive'));
        }
        if($cat == "videocard"){
               $videocards = Item::join('brands','items.brand_id','brands.brand_id')->join('videocards','items.item_id','videocards.item_id')->join('stocks','items.item_id','stocks.item_id')->where('items.item_id',$id)->first();
               return view('videocard.show',compact('videocards'));
        }








    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
