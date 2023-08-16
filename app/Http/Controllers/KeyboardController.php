<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keyboard;
use App\Models\Brand;
use App\Models\Item;
use App\Models\Stock;
use Validator;
use Redirect;
use DB;

class KeyboardController extends Controller
{
    protected function validator(Request $request) {
        $rules = [
            'brand_id' => 'required',
            'title' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'keyboard_width' => 'required',
            'keyboard_length' => 'required',
            'keyboard_depth' => 'required',
            'keyboard_wired' => 'required'
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
                $name = 'keyboard_'.time().'.'.$extension;

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
        $keyboards = DB::table('keyboards AS k')->join('items AS i', 'i.item_id', '=', 'k.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->select('*')->get();
        // dd($keyboards);

        return view('keyboard.index', compact('keyboards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::join('categories AS c', 'c.category_id', '=', 'brands.category_id')->where('category_name', '=', 'Keyboard')->select('*')->get();
        return view('keyboard.add', compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

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


            $keyboard = new Keyboard();
            $keyboard->keyboard_width = $input['keyboard_width'];
            $keyboard->keyboard_length = $input['keyboard_length'];
            $keyboard->keyboard_depth = $input['keyboard_depth'];
            $keyboard->keyboard_weight = $input['keyboard_weight'];
            $keyboard->keyboard_wired = $input['keyboard_wired'];
            $keyboard->style_keys = $input['style_keys'];
            $keyboard->full_keyboard = $input['full_keyboard'];
            $keyboard->color = $input['color'];
            $keyboard->battery = $input['battery'];
            $keyboard->extra_features = $input['extra_features'];
            $keyboard->keyboard_layout = $input['keyboard_layout'];
            $keyboard->keyboard_description = $input['keyboard_description'];
            $keyboard->item_id = $item->item_id;
            $keyboard->save();

            return Redirect::route('keyboard.index')->with('success','New Keyboard added!');
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
        $keyboards = DB::table('keyboards AS k')->join('items AS i', 'i.item_id', '=', 'k.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->where('k.keyboard_id', '=', $id)->select('*')->get();
        // dd($keyboards);


        return view('keyboard.show', compact('keyboards'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $keyboards = DB::table('keyboards AS k')->join('items AS i', 'i.item_id', '=', 'k.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->select('*')->where('k.keyboard_id', '=', $id)->get();

        $motherboard_formfactors = ['Mini-ITX', 'MicroATX', 'ATX', 'EATX'];

        $brands = Brand::join('categories AS c', 'c.category_id', '=', 'brands.category_id')->where('category_name', '=', 'Keyboard')->select('*')->get();

        // dd($keyboards);
        return view('keyboard.edit', compact('keyboards', 'brands'));
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
        // dd($request->all());

        $validator = $this->validator($request);

        //for validating if all fields passes
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

            DB::table('keyboards')->where('item_id', '=', $id)->update(['keyboard_width' => $request->keyboard_width, 'keyboard_length' => $request->keyboard_length, 'keyboard_depth' => $request->keyboard_depth, 'keyboard_weight' => $request->keyboard_weight, 'keyboard_wired' => $request->keyboard_wired, 'style_keys' => $request->style_keys, 'full_keyboard' => $request->full_keyboard, 'color' => $request->color, 'battery' => $request->battery, 'extra_features' => $request->extra_features, 'keyboard_layout' => $request->keyboard_layout, 'keyboard_description' => $request->keyboard_description]);

            return Redirect::route('keyboard.index')->with('success','Keyboard updated!');
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
        
        DB::table('keyboards')->where('item_id', '=', $id)->delete();
        DB::table('stocks')->where('item_id', '=', $id)->delete();
        DB::table('items')->where('item_id', '=', $id)->delete();

        return Redirect::route('keyboard.index')->with('success','Keyboard deleted!');
    }
}
