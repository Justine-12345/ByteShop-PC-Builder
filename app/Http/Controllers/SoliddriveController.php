<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Soliddrive;
use App\Models\Item;
use App\Models\Stock;
use DB;
use Validator;
use Redirect;

class SoliddriveController extends Controller
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
            'capacity' => 'required|numeric',
            'cell_type' => 'required'
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
                $name = 'soliddrive_'.time().'.'.$extension;

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
        $soliddrives = DB::table('soliddrives AS k')
        ->join('items AS i', 'i.item_id', '=', 'k.item_id')
        ->join('stocks AS s', 's.item_id', '=', 'i.item_id')
        ->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')
        ->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')
        ->select('*')->get();
        return view('soliddrive.index', compact('soliddrives'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $brands = Brand::join('categories AS c', 'c.category_id', '=', 'brands.category_id')->where('category_name', '=', 'soliddrive')->select('*')->get();
        return view('soliddrive.add', compact('brands'));
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


            $soliddrive = new Soliddrive();
            $soliddrive->form_factor = $input['form_factor'];
            $soliddrive->interface = $input['interface'];
            $soliddrive->read_speed = $input['read_speed'] ;
            $soliddrive->write_speed = $input['write_speed'];
            $soliddrive->endurance_rating = $input['endurance_rating'];
            $soliddrive->iops = $input['iops'];
            $soliddrive->capacity = $input['capacity'];
            $soliddrive->cell_type = $input['cell_type'];
            $soliddrive->soliddrive_description = $input['soliddrive_description'];
            $soliddrive->item_id = $item->item_id;
            $soliddrive->save();

            return Redirect::route('soliddrive.index')->with('success','New Soliddrive added!');
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
         $soliddrive = DB::table('soliddrives AS k')->join('items AS i', 'i.item_id', '=', 'k.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->where('k.soliddrive_id', '=', $id)->select('*')->first();
        // dd($processor);
        return view('soliddrive.show', compact('soliddrive'));
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
         $soliddrive = DB::table('soliddrives AS m')->join('items AS i', 'i.item_id', '=', 'm.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->select('*')->where('m.soliddrive_id', '=', $id)->first();

        $brands = Brand::join('categories AS c', 'c.category_id', '=', 'brands.category_id')->where('category_name', '=', 'soliddrive')->select('*')->get();
        
        return view('soliddrive.edit', compact('soliddrive', 'brands'));
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

            DB::table('soliddrives')->where('item_id', '=', $id)->update([
                'form_factor' => $request->form_factor,
                'interface' => $request->interface , 
                'read_speed' => $request->read_speed, 
                'write_speed' => $request->write_speed, 
                'endurance_rating' => $request->endurance_rating,
                'iops' => $request->iops, 
                'capacity' => $request->capacity, 
                'cell_type' => $request->cell_type, 
                'soliddrive_description' => $request->soliddrive_description]);

            return Redirect::route('soliddrive.index')->with('success','Soliddrive updated!');
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

        DB::table('soliddrives')->where('item_id', '=', $id)->delete();
        DB::table('stocks')->where('item_id', '=', $id)->delete();
        DB::table('items')->where('item_id', '=', $id)->delete();

        return Redirect::route('soliddrive.index')->with('success','Soliddrive deleted!');
    }
}
