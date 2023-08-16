<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memory;
use App\Models\Item;
use App\Models\Brand;
use App\Models\Stock;
use Redirect;
use Validator;
use File;
use DB;
class MemoryController extends Controller
{

    protected function validator(Request $request)
    {
        $rules = [
            'brand_id' => 'required',
            'title' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'memory_size' => 'required',
            'memory_type' => 'required',
            'frequency' => 'required',
            'cas_latency' => 'required',
            'memory_bandwidth' => 'required',
            'overclocking_support' => 'required',
            'heat_spreader' => 'required',
            'rgb_support' => 'required',
            'memory_description' => 'required',
        ];

        $messages = [
            'required' => 'Required',
        ];

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
                $name = 'memory_'.time().'.'.$extension;

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
        $memories = Item::join('brands','items.brand_id','brands.brand_id')->join('memories','items.item_id','memories.item_id')->get();
        return view('memory.index',compact('memories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::join('categories AS c', 'c.category_id', '=', 'brands.category_id')->where('category_name', '=', 'memory')->select('*')->get()->pluck('brand_name', 'brand_id');
        return view('memory.add',compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validator($request);

        if($validator->passes())
        {
            $filename = $this->imageUpload($request);

            $item = new Item();

            $item->title = $request->title;
            $item->price = $request->price;
            $item->brand_id = $request->brand_id;
            $item->image = $filename;
            $item->save();

            $memory = new Memory();
            $memory->memory_size = $request->memory_size;
            $memory->memory_type = $request->memory_type;
            $memory->frequency = $request->frequency;
            $memory->cas_latency = $request->cas_latency;
            $memory->memory_bandwidth = $request->memory_bandwidth;
            $memory->overclocking_support = $request->overclocking_support;
            $memory->heat_spreader = $request->heat_spreader;
            $memory->rgb_support = $request->rgb_support;
            $memory->memory_description = $request->memory_description;

            $stock = new Stock();
            $stock->quantity = $request->quantity;

            $item->memory()->save($memory);
            $item->stock()->save($stock);

            return redirect()->route('memory.index')->with('success','New Memory added!');
        }
        else
        {
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Memory $memory)
    {
        $memories = Item::join('brands','items.brand_id','brands.brand_id')->join('memories','items.item_id','memories.item_id')->join('stocks','items.item_id','stocks.item_id')->where('items.item_id',$memory->item_id)->first();
        return view('memory.show',compact('memories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Memory $memory)
    {
        $brands = Brand::all()->pluck('brand_name','brand_id');
        $item = Memory::with('item')->join('items','items.item_id','memories.item_id')->join('stocks','stocks.item_id','memories.item_id')->where('memory_id',$memory->memory_id)->first();
        // dd($item);
        return view('memory.edit',compact('item','brands'));
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
        $validator = $this->validator($request);

        if($validator->passes())
        {
            if($request->hasfile('image')) {
                $file = Item::where('item_id', '=', $id)->select('image')->get();

                if(file_exists(public_path().'/src/images/products/'.$file[0]->image)) {
                     File::delete(public_path().'/src/images/products/'.$file[0]->image);
                }

                $filename = $this->imageUpload($request);

                DB::table('items')->where('item_id', '=', $id)->update(['image' => $filename]);
            }

            $item = Item::find($id);

            $item->title = $request->title;
            $item->price = $request->price;
            $item->brand_id = $request->brand_id;
            $item->save();

            $memory = Memory::find($id);
            $memory->memory_size = $request->memory_size;
            $memory->memory_type = $request->memory_type;
            $memory->frequency = $request->frequency;
            $memory->cas_latency = $request->cas_latency;
            $memory->memory_bandwidth = $request->memory_bandwidth;
            $memory->overclocking_support = $request->overclocking_support;
            $memory->heat_spreader = $request->heat_spreader;
            $memory->rgb_support = $request->rgb_support;
            $memory->memory_description = $request->memory_description;
            $stock = Stock::find($memory->item_id);
            $stock->quantity = $request->quantity;

            $item->memory()->save($memory);
            $item->stock()->save($stock);

            return Redirect()->Route('memory.index')->with('success','Memory updated!');
        }
        else
        {
            return Redirect()->back()->withInput()->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Memory $memory)
    {
        $filename = Item::where('item_id', '=', $memory->item_id)->select('image')->get();

        if(file_exists(public_path().'/src/images/products/'.$filename[0]->image)) {
            unlink(public_path().'/src/images/products/'.$filename[0]->image);
        }
        
        $memory->delete();
        $stock = Stock::find($memory->item_id);
        $item = Item::find($memory->item_id);
        $stock->delete();
        $item->delete();
        return Redirect()->route('memory.index')->with('success','Memory deleted!');
    }
}
