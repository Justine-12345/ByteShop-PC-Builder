<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Processor;
use App\Models\Item;
use App\Models\Stock;
use DB;
use Validator;
use Redirect;
class ProcessorController extends Controller
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
            'quantity' => 'required',
            'price' => 'required',
            'max_speed' => 'required',
            'base_speed' => 'required',
            'core_count' => 'required',
            'cache' => 'required',
            'memory_type' => 'required',
            'socket_type' => 'required',
            'processor_wattage' => 'required'
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
                $name = 'processor_'.time().'.'.$extension;

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
        $processors = DB::table('processors AS k')->join('items AS i', 'i.item_id', '=', 'k.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->select('*')->distinct()->get();
        // dd($keyboards);
        return view('processor.index', compact('processors'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $brands = Brand::join('categories AS c', 'c.category_id', '=', 'brands.category_id')->where('category_name', '=', 'processor')->select('*')->get();
        return view('processor.add', compact('brands'));
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

            $processor = new Processor();
            $processor->base_speed = $input['base_speed'];
            $processor->max_speed = $input['max_speed'];
            $processor->overclocking = $input['overclocking'];
            $processor->core_count = $input['core_count'];
            $processor->multi_threading = $input['multi_threading'];
            $processor->cache = $input['cache'];
            $processor->memory_type = $input['memory_type'];
            $processor->socket_type = $input['socket_type'];
            $processor->tdp_rating = $input['tdp_rating'];
            $processor->fabrication = $input['fabrication'];
            $processor->ingrated_graphics = $input['ingrated_graphics'];
            $processor->processor_wattage = $input['processor_wattage'];
            $processor->processor_score = $input['processor_score'];
            

            $processor->processor_description = $input['processor_description'];
            $processor->item_id = $item->item_id;
            $processor->save();

            return Redirect::route('processor.index')->with('success','New Processor added!');
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
         $processor = DB::table('processors AS k')->join('items AS i', 'i.item_id', '=', 'k.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->where('k.processor_id', '=', $id)->select('*')->first();
        // dd($processor);
        return view('processor.show', compact('processor'));
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
        $processor = DB::table('processors AS k')->join('items AS i', 'i.item_id', '=', 'k.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->select('*')->where('k.processor_id', '=', $id)->first();

        $brands = Brand::join('categories AS c', 'c.category_id', '=', 'brands.category_id')->where('category_name', '=', 'Processor')->select('*')->get();

        // dd($keyboards);
        return view('processor.edit', compact('processor', 'brands'));
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

            DB::table('processors')->where('item_id', '=', $id)->update([
                'base_speed' => $request->base_speed, 
                'max_speed' => $request->max_speed, 
                'overclocking' => $request->overclocking, 
                'core_count' => $request->core_count, 
                'multi_threading' => $request->multi_threading, 
                'cache' => $request->cache, 
                'memory_type' => $request->memory_type, 
                'socket_type' => $request->socket_type, 
                'tdp_rating' => $request->tdp_rating, 
                'fabrication' => $request->fabrication, 
                'ingrated_graphics' => $request->ingrated_graphics, 
                'processor_wattage' => $request->processor_wattage, 
                'processor_score' => $request->processor_score, 
                'processor_description' => $request->processor_description]);

            return Redirect::route('processor.index')->with('success','Processor updated!');
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
        
        DB::table('processors')->where('item_id', '=', $id)->delete();
        DB::table('stocks')->where('item_id', '=', $id)->delete();
        DB::table('items')->where('item_id', '=', $id)->delete();

        return Redirect::route('processor.index')->with('success','Processor deleted!');
    }
}
