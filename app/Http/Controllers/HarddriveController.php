<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Harddrive;
use App\Models\Brand;
use App\Models\Item;
use App\Models\Stock;
use Validator;
use Redirect;
use DB;
class HarddriveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected function validator(request $request) {
        $rules = [
            'brand_id' => 'required',
            'title' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            
        ];
        
        //error messages of all fields
        $messages = [
            'required' => 'Required',
          
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
                $name = 'hard_drive_'.time().'.'.$extension;

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
        $harddrives = DB::table('harddrives AS h')->join('items AS i', 'i.item_id', '=', 'h.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->select('*')->get();
          // dd($harddrives);
        return view('harddrive.index', compact('harddrives'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $brands = Brand::join('categories AS c', 'c.category_id', '=', 'brands.category_id')->where('category_name', '=', 'harddrive')->select('*')->get();

        return view('harddrive.add', compact('brands'));
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


            $harddrive = new Harddrive();
            $harddrive->storage_type = $input['storage_type'];
            $harddrive->capacity = $input['capacity'];
            $harddrive->rotational_speed = $input['rotational_speed'] ;
            $harddrive->connectivity_type = $input['connectivity_type'];
            $harddrive->transfer_rate = $input['transfer_rate'];
            $harddrive->cache_size = $input['cache_size'];
            $harddrive->power = $input['power'];
            $harddrive->height = $input['height'];
            $harddrive->dept = $input['depth'];
            $harddrive->width = $input['width'];
            $harddrive->weight = $input['weight'];
            $harddrive->harddrive_description = $input['harddrive_description'];
            $harddrive->item_id = $item->item_id;
            $harddrive->save();

            return Redirect::route('harddrive.index')->with('success','New harddrive added!');
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
         $harddrives = DB::table('harddrives AS m')->join('items AS i', 'i.item_id', '=', 'm.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->where('m.harddrive_id', '=', $id)->select('*')->get();
        // dd($keyboards);


        return view('harddrive.show', compact('harddrives'));
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
        $harddrives = DB::table('harddrives AS m')->join('items AS i', 'i.item_id', '=', 'm.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->select('*')->where('m.harddrive_id', '=', $id)->get();

        // $motherboard_formfactors = ['Mini-ITX', 'MicroATX', 'ATX', 'EATX'];

        $brands = Brand::join('categories AS c', 'c.category_id', '=', 'brands.category_id')->where('category_name', '=', 'harddrive')->select('*')->get();
        // $video_connectors_formfactors = ['VGA', 'DVI', 'HDMI', 'Display Port'];
       
                 // $video_connectors = explode(' | ', $harddrives[0]->video_connectors);
        // dd($keyboards);
        return view('harddrive.edit', compact('harddrives', 'brands'));
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

            DB::table('harddrives')->where('item_id', '=', $id)->update([
                'storage_type' => $request->storage_type,
                'capacity' => $request->capacity , 
                'rotational_speed' => $request->rotational_speed, 
                'connectivity_type' => $request->connectivity_type, 
                'transfer_rate' => $request->transfer_rate,
                'cache_size' => $request->cache_size, 
                'power' => $request->power, 
                'height' => $request->height, 
                'dept' => $request->depth, 
                'width' => $request->width,  
                'weight' => $request->weight,   
                'harddrive_description' => $request->harddrive_description]);

            return Redirect::route('harddrive.index')->with('success','Harddrive updated!');
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

        DB::table('harddrives')->where('item_id', '=', $id)->delete();
        DB::table('stocks')->where('item_id', '=', $id)->delete();
        DB::table('items')->where('item_id', '=', $id)->delete();

        return Redirect::route('harddrive.index')->with('success','Harddrive deleted!');
    }
}
