<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Videocard;
use App\Models\Item;
use App\Models\Brand;
use App\Models\Stock;
use Redirect;
use Validator;
use DB;

class VideocardController extends Controller
{
    protected function validator(Request $request)
    {
        $rules = [
            'brand_id' => 'required',
            'title' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'gpu_brand' => 'required',
            'core_count' => 'required',
            'clock_speed' => 'required',
            'memory_type' => 'required',
            'memory_size' => 'required',
            'memory_bandwidth' => 'required',
            'thermal_designpower' => 'required',
            'power_connectors' => 'required',
            'video_outputports' => 'required',
            'api_support' => 'required',
            'computer_performance' => 'required',
            'gpu_wattage' => 'required',
            'gpu_score' => 'required',
            'gpu_description' => 'required',
        ];

        $messages = ['required' => 'Required'];

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
                $name = 'video_card_'.time().'.'.$extension;

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
        $videocards = Item::join('brands','items.brand_id','brands.brand_id')->join('videocards','items.item_id','videocards.item_id')->get();
        return view('videocard.index',compact('videocards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $brands = Brand::join('categories AS c', 'c.category_id', '=', 'brands.category_id')->where('category_name', '=', 'videocard')->select('*')->get()->pluck('brand_name', 'brand_id');

        // $brands = Brand::all()->pluck('brand_name','brand_id');

        return view('videocard.add',compact('brands'));
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

            $videocard = new Videocard();
            $videocard->gpu_brand = $request->gpu_brand;
            $videocard->core_count = $request->core_count;
            $videocard->clock_speed = $request->clock_speed;
            $videocard->memory_type = $request->memory_type;
            $videocard->memory_size = $request->memory_size;
            $videocard->memory_bandwidth = $request->memory_bandwidth;
            $videocard->thermal_designpower = $request->thermal_designpower;
            $videocard->power_connectors = $request->power_connectors;
            $videocard->video_outputports = $request->video_outputports;
            $videocard->api_support = $request->api_support;
            $videocard->computer_performance = $request->computer_performance;
            $videocard->gpu_wattage = $request->gpu_wattage;
            $videocard->gpu_score = $request->gpu_score;
            $videocard->gpu_description = $request->gpu_description;

            $stock = new Stock();
            $stock->quantity = $request->quantity;

            $item->videocard()->save($videocard);
            $item->stock()->save($stock);

            return redirect()->route('videocard.index')->with('success','New Video Card added!');
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
    public function show(Videocard $videocard)
    {
        $videocards = Item::join('brands','items.brand_id','brands.brand_id')->join('videocards','items.item_id','videocards.item_id')->join('stocks','items.item_id','stocks.item_id')->where('items.item_id',$videocard->item_id)->first();
        return view('videocard.show',compact('videocards'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Videocard $videocard)
    {
        $brands = Brand::join('categories AS c', 'c.category_id', '=', 'brands.category_id')->where('category_name', '=', 'videocard')->select('*')->get()->pluck('brand_name', 'brand_id');


        $item = Videocard::with('item')->join('items','items.item_id','videocards.item_id')->join('stocks','stocks.item_id','videocards.item_id')->where('videocard_id',$videocard->videocard_id)->first();

        return view('videocard.edit',compact('item','brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Videocard $videocard)
    {
        $validator = $this->validator($request);

        if($validator->passes())
        {
            if($request->hasfile('image')) {
                $file = Item::where('item_id', '=', $videocard->item_id)->select('image')->get();

                if(file_exists(public_path().'/src/images/products/'.$file[0]->image)) {
                    unlink(public_path().'/src/images/products/'.$file[0]->image);
                }

                $filename = $this->imageUpload($request);

                DB::table('items')->where('item_id', '=', $videocard->item_id)->update(['image' => $filename]);
            }

            $item = Item::find($videocard->item_id);

            $item->title = $request->title;
            $item->price = $request->price;
            $item->brand_id = $request->brand_id;
            $item->save();

            $videocard = Videocard::find($videocard->videocard_id);
            $videocard->gpu_brand = $request->gpu_brand;
            $videocard->core_count = $request->core_count;
            $videocard->clock_speed = $request->clock_speed;
            $videocard->memory_type = $request->memory_type;
            $videocard->memory_size = $request->memory_size;
            $videocard->memory_bandwidth = $request->memory_bandwidth;
            $videocard->thermal_designpower = $request->thermal_designpower;
            $videocard->power_connectors = $request->power_connectors;
            $videocard->video_outputports = $request->video_outputports;
            $videocard->api_support = $request->api_support;
            $videocard->computer_performance = $request->computer_performance;
            $videocard->gpu_wattage = $request->gpu_wattage;
            $videocard->gpu_score = $request->gpu_score;
            $videocard->gpu_description = $request->gpu_description;

            $stock = Stock::find($videocard->item_id);
            $stock->quantity = $request->quantity;

            $item->videocard()->save($videocard);
            $item->stock()->save($stock);

            return Redirect()->Route('videocard.index')->with('success','Video Card updated!');
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
    public function destroy(Videocard $videocard)
    {
        $filename = Item::where('item_id', '=', $videocard->item_id)->select('image')->get();

        if(file_exists(public_path().'/src/images/products/'.$filename[0]->image)) {
            unlink(public_path().'/src/images/products/'.$filename[0]->image);
        }

        $videocard->delete();
        $stock = Stock::find($videocard->item_id);
        $item = Item::find($videocard->item_id);
        $stock->delete();
        $item->delete();
        return redirect()->route('videocard.index')->with('success','Video Card deleted!');
    }
}
