<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Headphone;
use App\Models\Brand;
use App\Models\Item;
use App\Models\Stock;
use Validator;
use Redirect;
use DB;

class HeadphoneController extends Controller
{

    protected function validator(Request $request) {
        $rules = [
            'brand_id' => 'required',
            'title' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'frequency_response' => 'numeric',
            'driver_size' => 'numeric',
           'nominal_impedance' => 'numeric',
            'headphone_sensivity' => 'numeric',
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
                $name = 'headphone_'.time().'.'.$extension;

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


         $headphones = DB::table('headphones AS h')->join('items AS i', 'i.item_id', '=', 'h.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->select('*')->get();

   //     dd($headphones);

        return view('headphone.index', compact('headphones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $brands = Brand::join('categories AS c', 'c.category_id', '=', 'brands.category_id')->where('category_name', '=', 'Headphone')->select('*')->get();

        return view('headphone.add', compact('brands'));
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


            $headphone = new Headphone();
            $headphone->frequency_response = $input['frequency_response'];
            $headphone->transducer_principle = $input['transducer_principle'];
            $headphone->driver_size = $input['driver_size'];
            $headphone->nominal_impedance = $input['nominal_impedance'] ;
            $headphone->headphone_sensivity = $input['headphone_sensivity'];
            $headphone->weight = $input['weight'];
        
            $headphone->headphones_desciption = $input['headphones_desciption'];
            $headphone->item_id = $item->item_id;
            $headphone->save();

            return Redirect::route('headphone.index')->with('success','New headphone added!');
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
        $headphones= DB::table('headphones AS h')->join('items AS i', 'i.item_id', '=', 'h.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->where('h.headphone_id', '=', $id)->select('*')->get();
        // dd($keyboards);


        return view('headphone.show', compact('headphones'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $headphones = DB::table('headphones AS h')->join('items AS i', 'i.item_id', '=', 'h.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->select('*')->where('h.headphone_id', '=', $id)->get();

        // $motherboard_formfactors = ['Mini-ITX', 'MicroATX', 'ATX', 'EATX'];

        $brands = Brand::join('categories AS c', 'c.category_id', '=', 'brands.category_id')->where('category_name', '=', 'Headphone')->select('*')->get();

        // dd($keyboards);
        return view('headphone.edit', compact('headphones', 'brands'));
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

            DB::table('headphones')->where('item_id', '=', $id)->update(['frequency_response' => $request->frequency_response, 'transducer_principle' => $request->transducer_principle, 'driver_size' => $request->driver_size, 'nominal_impedance' => $request->nominal_impedance, 'headphone_sensivity' => $request->headphone_sensivity,'weight' => $request->weight, 'headphones_desciption' => $request->headphones_desciption]);

            return Redirect::route('headphone.index')->with('success','Headphone updated!');
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
        
        DB::table('headphones')->where('item_id', '=', $id)->delete();
        DB::table('stocks')->where('item_id', '=', $id)->delete();
        DB::table('items')->where('item_id', '=', $id)->delete();

        return Redirect::route('headphone.index')->with('success','Headphone deleted!');
    }
}
