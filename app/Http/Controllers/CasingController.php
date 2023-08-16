<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Motherboard;
use App\Models\Casing;
use App\Models\Brand;
use App\Models\Item;
use App\Models\Stock;
use Validator;
use Redirect;
use DB;

class CasingController extends Controller
{
    protected function validator(Request $request) {
        $rules = [
            'brand_id' => 'required',
            'title' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'case_type' => 'required',
            'case_motherboards' => 'required',
            'case_width' => 'required',
            'case_height' => 'required',
            'case_depth' => 'required',
            'drivebay_5point25' => 'required',
            'drivebay_3point5' => 'required',
            'drivebay_2point5' => 'required'
        ];
        
        //error messages of all fields
        $messages = [
            'required' => 'Required',
            'image' => 'Image file only',
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
                $name = 'casing_'.time().'.'.$extension;

                //for uploading the file
                $file->move(public_path().'/src/images/products/', $name);

                //for concatinating all the file path
                $filename = $name;
            }
        }
        //for returning all the file path
        return $filename;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $case_motherboards = [];
        $casings = DB::table('casings AS c')->join('items AS i', 'i.item_id', '=', 'c.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->select('*')->get();
        // dd($casings);

        foreach($casings as $casing){
            $case_motherboards[$casing->casing_id] = explode(' | ', $casing->case_motherboards);
        }
        // dd($case_motherboards);

        return view('casing.index', compact('casings', 'case_motherboards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::join('categories AS c', 'c.category_id', '=', 'brands.category_id')->where('category_name', '=', 'Casing')->select('*')->get();
        $motherboards = DB::table('motherboards AS m')->join('items AS i', 'i.item_id', '=', 'm.item_id')->select('title')->get();
        // dd($motherboards[0]->title);

        return view('casing.add', compact('brands', 'motherboards'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $motherboards = '';

        $validator = $this->validator($request);

        //for validating if all fields passes
        if ($validator->passes()) {
            foreach($request->case_motherboards as $motherboard){
                $motherboards .= $motherboard . ' | ';
            }
            // dd($motherboards);
            // dd($request->all());

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


            $casing = new Casing();
            $casing->case_type = $input['case_type'];
            $casing->steel_thickness = $input['steel_thickness'];
            $casing->case_motherboards = $motherboards;
            $casing->case_width = $input['case_width'];
            $casing->case_height = $input['case_height'];
            $casing->case_depth = $input['case_depth'];
            $casing->drivebay_5point25 = $input['drivebay_5point25'];
            $casing->drivebay_3point5 = $input['drivebay_3point5'];
            $casing->drivebay_2point5 = $input['drivebay_2point5'];
            $casing->expansion_slot = $input['expansion_slot'];
            $casing->max_pcislots = $input['max_pcislots'];
            $casing->io_ports = $input['io_ports'];
            $casing->height_coolers = $input['height_coolers'];
            $casing->aircooling_system = $input['aircooling_system'];
            $casing->net_weight = $input['net_weight'];
            $casing->casing_description = $input['casing_description'];
            $casing->item_id = $item->item_id;
            $casing->save();

            return Redirect::route('casing.index')->with('success','New Casing added!');
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
        $casings = DB::table('casings AS c')->join('items AS i', 'i.item_id', '=', 'c.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->select('*')->where('c.casing_id', '=', $id)->get();

        $case_motherboards = explode(' | ', $casings[0]->case_motherboards);
        
        // dd($motherboards);
        // dd($casings);


        return view('casing.show', compact('casings', 'case_motherboards'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $casings = DB::table('casings AS c')->join('items AS i', 'i.item_id', '=', 'c.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->select('*')->where('c.casing_id', '=', $id)->get();

        $motherboard_formfactors = ['Mini-ITX', 'MicroATX', 'ATX', 'EATX'];

        $brands = Brand::join('categories AS c', 'c.category_id', '=', 'brands.category_id')->where('category_name', '=', 'Casing')->select('*')->get();

        $case_motherboards = explode(' | ', $casings[0]->case_motherboards);
        // dd($motherboard_formfactor);

        // dd($casings);
        return view('casing.edit', compact('casings', 'motherboard_formfactors', 'brands', 'case_motherboards'));
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
        
        // dd($request->hasfile('image'));

        $motherboards = '';

        $validator = $this->validator($request);

        //for validating if all fields passes
        if ($validator->passes()) {
            foreach($request->case_motherboards as $motherboard){
                $motherboards .= $motherboard . ' | ';
            }

            if($request->hasfile('image')) {
                $file = Item::where('item_id', '=', $id)->select('image')->get();

                if(file_exists(public_path().'/src/images/products/'.$file[0]->image)) {
                    unlink(public_path().'/src/images/products/'.$file[0]->image);
                }

                $filename = $this->imageUpload($request);
                // dd($filename);

                DB::table('items')->where('item_id', '=', $id)->update(['image' => $filename]);
            }

            DB::table('items')->where('item_id', '=', $id)->update(['title' => $request->title, 'price' => $request->price, 'brand_id' => $request->brand_id]);

            DB::table('stocks')->where('item_id', '=', $id)->update(['quantity' => $request->quantity]);

            DB::table('casings')->where('item_id', '=', $id)->update(['case_type' => $request->case_type, 'steel_thickness' => $request->steel_thickness, 'case_motherboards' => $motherboards, 'case_width' => $request->case_width, 'case_height' => $request->case_height, 'case_depth' => $request->case_depth, 'drivebay_5point25' => $request->drivebay_5point25, 'drivebay_3point5' => $request->drivebay_3point5, 'drivebay_2point5' => $request->drivebay_2point5, 'expansion_slot' => $request->expansion_slot, 'max_pcislots' => $request->max_pcislots, 'io_ports' => $request->io_ports, 'height_coolers' => $request->height_coolers, 'aircooling_system' => $request->aircooling_system, 'net_weight' => $request->net_weight, 'casing_description' => $request->casing_description]);

            return Redirect::route('casing.index')->with('success','Casing updated!');
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
        
        // dd($id);
        DB::table('casings')->where('item_id', '=', $id)->delete();
        DB::table('stocks')->where('item_id', '=', $id)->delete();
        DB::table('items')->where('item_id', '=', $id)->delete();

        return Redirect::route('casing.index')->with('success','Casing deleted!');
    }
}
