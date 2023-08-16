<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Powersupply;
use App\Models\Item;
use App\Models\Stock;
use DB;
use Validator;
use Redirect;
class PowersupplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

      protected function validator(Request $request) {
        $rules = [
            'brand_id' => 'required',
            'title' => 'required',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'wattage' => 'required|numeric'
        ];
        
        //error messages of all fields
        $messages = [
            'required' => 'Required',
            'numeric' => 'Must be numeric'
        ];

        //for validating all of the fields
        $validator = Validator::make($request->all(), $rules, $messages);

        return $validator;
    }

    function imageUpload(Request $request)
    { 
        $filename = '';

        if ($request->hasfile('image')) {
            foreach ($request->file('image') as $file) {

                //for collecting the extension of the file
                $extension = $file->getClientOriginalExtension();

                //for assigning new name of the file
                $name = 'power_supply_'.time().'.'.$extension;

                //for uploading the file
                $file->move(public_path().'/src/images/products/', $name);

                //for concatinating all the file path
                $filename = $name;
            }
        }
        //for returning all the file path
        return $filename;
    }

    public function index()
    {
        //
        $powersupplies = DB::table('powersupplies AS k')
        ->join('items AS i', 'i.item_id', '=', 'k.item_id')
        ->join('stocks AS s', 's.item_id', '=', 'i.item_id')
        ->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')
        ->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')
        ->select('*')->get();
        return view('powersupply.index', compact('powersupplies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $brands = Brand::join('categories AS c', 'c.category_id', '=', 'brands.category_id')->where('category_name', '=', 'powersupply')->select('*')->get();
        return view('powersupply.add', compact('brands'));

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

        $validator = $this->validator($request);

        //for validating if all fields passes
        if ($validator->passes()) {
            $filename = $this->imageUpload($request);
           
            $input = $request->all();

            $item = new Item();
            $item->title = $input['title'];
            $item->price = $input['price'];
            $item->image = $filename;
            $item->brand_id = $input['brand_id'];
            $item->save();

            $stock = new Stock();
            $stock->item_id = $item->item_id;
            $stock->quantity = $input['quantity'];
            $stock->save();
            $powersupply = new Powersupply();
            $powersupply->form_factor = $input['form_factor'];
            $powersupply->wattage = $input['wattage'];
            $powersupply->efficiency_rating = $input['efficiency_rating'];
            $powersupply->rails = $input['rails'];
            if ($request->has('protection')) {
                $protection = "";
                    foreach($request->protection as $p){
                        $protection .= $p . ' | ';
                    }
              $powersupply->protection = $protection;
            }
            $powersupply->modularity = $input['modularity'];
            $powersupply->variable_rpmfan = $input['variable_rpmfan'];
            $powersupply->fan_size = $input['fan_size'];
            $powersupply->powersupplies_description = $input['powersupplies_description'];
            $powersupply->item_id = $item->item_id;
            $powersupply->save();

            return Redirect::route('powersupply.index')->with('success','New Power Supply added!');
        }
        else {
            return redirect()->back()->withInput()->withErrors($validator);
        }
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
        $powersupply = DB::table('powersupplies AS c')->join('items AS i', 'i.item_id', '=', 'c.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->select('*')->where('c.powersupply_id', '=', $id)->first();

        $protection = explode(' | ', $powersupply->protection);
        
        // dd($motherboards);
        // dd($casings);


        return view('powersupply.show', compact('powersupply', 'protection'));
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
        $powersupply = DB::table('powersupplies AS c')->join('items AS i', 'i.item_id', '=', 'c.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->select('*')->where('c.powersupply_id', '=', $id)->first();

        $brands = Brand::join('categories AS c', 'c.category_id', '=', 'brands.category_id')->where('category_name', '=', 'powersupply')->select('*')->get();

        $protection = explode(' | ', $powersupply->protection);

        // dd($casings);
        return view('powersupply.edit', compact('powersupply', 'brands', 'protection'));
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
        $validator = $this->validator($request);
        
         if ($validator->passes()) {
            if($request->hasfile('image')) {
                $file = Item::where('item_id', '=', $id)->select('image')->get();

                if(file_exists(public_path().'/src/images/products/'.$file[0]->image)) {
                    unlink(public_path().'/src/images/products/'.$file[0]->image);
                }

                $filename = $this->imageUpload($request);

                DB::table('items')->where('item_id', '=', $id)->update(['image' => $filename]);
            }
           
            DB::table('items')->where('item_id', '=', $id)->update(['title' => $request->title, 'price' => $request->price, 'brand_id' => $request->brand_id]);

            DB::table('stocks')->where('item_id', '=', $id)->update(['quantity' => $request->quantity]);

            DB::table('powersupplies')->where('item_id', '=', $id)->update([
                'form_factor' => $request->form_factor, 
                'wattage' => $request->wattage, 
                'efficiency_rating' => $request->efficiency_rating, 
                'rails' => $request->rails, 
                'protection' => $request->protection, 
                'modularity' => $request->modularity, 
                'variable_rpmfan' => $request->variable_rpmfan, 
                'fan_size' => $request->fan_size, 
                'powersupplies_description' => $request->powersupplies_description, 
                ]);

             if ($request->has('protection')) {
                $protection = "";
                    foreach($request->protection as $p){
                        $protection .= $p . ' | ';
                    }
              DB::table('powersupplies')->where('item_id', '=', $id)->update(['protection' => $protection]);
            }

            return Redirect::route('powersupply.index')->with('success','Powersupply updated!');
        }
        else {
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $filename = Item::where('item_id', '=', $id)->select('image')->get();

        if(file_exists(public_path().'/src/images/products/'.$filename[0]->image)) {
            unlink(public_path().'/src/images/products/'.$filename[0]->image);
        }

        DB::table('powersupplies')->where('item_id', '=', $id)->delete();
        DB::table('stocks')->where('item_id', '=', $id)->delete();
        DB::table('items')->where('item_id', '=', $id)->delete();

        return Redirect::route('powersupply.index')->with('success','Powersupply deleted!');
    }
}
