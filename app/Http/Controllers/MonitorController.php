<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Monitor;
use App\Models\Item;
use App\Models\Brand;
use App\Models\Stock;
use Redirect;
use Validator;
use DB;
use File;
class MonitorController extends Controller
{
    protected function validator(Request $request)
    {
        $rules = [
            'brand_id' => 'required',
            'title' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'monitor_resolution' => 'required',
            'monitor_size' => 'required',
            'monitor_aspect' => 'required',
            'panel_type' => 'required',
            'refresh_rate' => 'required',
            'response_time' => 'required',
            'synchronisation_technology' => 'required',
            'viewing_angle' => 'required',
            'input_connectors' => 'required',
            'monitor_curvature' => 'required',
            'monitor_brightness' => 'required',
            'monitor_hdr' => 'required',
            'monitor_contrast' => 'required',
            'monitor_colorspace' => 'required',
            'monitor_description' => 'required',
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
                $name = 'monitor_'.time().'.'.$extension;

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
        $monitors = Item::join('brands','items.brand_id','brands.brand_id')->join('monitors','items.item_id','monitors.item_id')->get();
        return view('monitor.index',compact('monitors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
              $brands = Brand::join('categories AS c', 'c.category_id', '=', 'brands.category_id')->where('category_name', '=', 'monitor')->select('*')->get()->pluck('brand_name', 'brand_id');
        return view('monitor.add',compact('brands'));
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

            $monitor = new Monitor();
            $monitor->monitor_resolution = $request->monitor_resolution;
            $monitor->minitor_size = $request->monitor_size;
            $monitor->monitor_aspect = $request->monitor_aspect;
            $monitor->panel_type = $request->panel_type;
            $monitor->refresh_rate = $request->refresh_rate;
            $monitor->response_time = $request->response_time;
            $monitor->synchronisation_technology = $request->synchronisation_technology;
            $monitor->viewing_angle = $request->viewing_angle;
            $monitor->input_connectors = $request->input_connectors;
            $monitor->monitor_curvature = $request->monitor_curvature;
            $monitor->monitor_brightness = $request->monitor_brightness;
            $monitor->monitor_hdr = $request->monitor_hdr;
            $monitor->monitor_contrast = $request->monitor_contrast;
            $monitor->monitor_colorspace = $request->monitor_colorspace;
            $monitor->monitor_description = $request->monitor_description;

            $stock = new Stock();
            $stock->quantity = $request->quantity;

            $item->monitor()->save($monitor);
            $item->stock()->save($stock);

            return redirect()->route('monitor.index')->with('success','New Monitor added!');
        }
        else
        {
            return Redirect()->back()->withInput()->withErrors($validator);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Monitor $monitor)
    {
        $monitors = Item::join('brands','items.brand_id','brands.brand_id')->join('monitors','items.item_id','monitors.item_id')->join('stocks','items.item_id','stocks.item_id')->where('items.item_id',$monitor->item_id)->first();

        return view('monitor.show',compact('monitors'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Monitor $monitor)
    {
        $brands = Brand::all()->pluck('brand_name','brand_id');
        $item = Monitor::with('item')->join('items','items.item_id','monitors.item_id')->join('stocks','stocks.item_id','monitors.item_id')->where('items.item_id',$monitor->item_id)->first();

        return view('monitor.edit',compact('item','brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Monitor $monitor)
    {
        $validator = $this->validator($request);

        if($validator->passes())
        {
            if($request->hasfile('image')) {
                $file = Item::where('item_id', '=', $monitor->item_id)->select('image')->get();

                if(file_exists(public_path().'/src/images/products/'.$file[0]->image)) {
                   File::delete(public_path().'/src/images/products/'.$file[0]->image);
                }

                $filename = $this->imageUpload($request);

                DB::table('items')->where('item_id', '=', $monitor->item_id)->update(['image' => $filename]);
            }

            $item = Item::find($monitor->item_id);

            $item->title = $request->title;
            $item->price = $request->price;
            $item->brand_id = $request->brand_id;
            $item->save();

            $monitor = Monitor::find($monitor->monitor_id);
            $monitor->monitor_resolution = $request->monitor_resolution;
            $monitor->minitor_size = $request->monitor_size;
            $monitor->monitor_aspect = $request->monitor_aspect;
            $monitor->panel_type = $request->panel_type;
            $monitor->refresh_rate = $request->refresh_rate ;
            $monitor->response_time = $request->response_time;
            $monitor->synchronisation_technology = $request->synchronisation_technology;
            $monitor->viewing_angle = $request->viewing_angle ;
            $monitor->input_connectors = $request->input_connectors;
            $monitor->monitor_curvature = $request->monitor_curvature;
            $monitor->monitor_brightness = $request->monitor_brightness;
            $monitor->monitor_hdr = $request->monitor_hdr;
            $monitor->monitor_contrast = $request->monitor_contrast;
            $monitor->monitor_colorspace = $request->monitor_colorspace;
            $monitor->monitor_description = $request->monitor_description;

            $stock = Stock::find($monitor->item_id);
            $stock->quantity = $request->quantity;

            $item->monitor()->save($monitor);
            $item->stock()->save($stock);

            return Redirect()->Route('monitor.index')->with('success','Monitor updated!');
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
    public function destroy(Monitor $monitor)
    {
        $filename = Item::where('item_id', '=', $monitor->item_id)->select('image')->get();

        if(file_exists(public_path().'/src/images/products/'.$filename[0]->image)) {
           File::delete(public_path().'/src/images/products/'.$filename[0]->image);
        }

        $monitor->delete();
        $stock = Stock::find($monitor->item_id);
        $item = Item::find($monitor->item_id);
        $stock->delete();
        $item->delete();
        return Redirect()->route('monitor.index')->with('success','Monitor deleted!');
    }
}
