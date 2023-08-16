<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Operatingsystem;
use App\Models\Brand;
use App\Models\Item;
use App\Models\Stock;
use Validator;
use Redirect;
use DB;
class OperatingsystemController extends Controller
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
            'processor_speed' => 'required',
            'memory_requirement' => 'required',
            'space_requirement' => 'required',
           
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
                $name = 'operating_system_'.time().'.'.$extension;

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
         {
          $operatingsystems = DB::table('operatingsystems AS o')->join('items AS i', 'i.item_id', '=', 'o.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->select('*')->get();
          // dd($operatingsystems);
        return view('operatingsystem.index', compact('operatingsystems'));
    }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $brands = Brand::join('categories AS c', 'c.category_id', '=', 'brands.category_id')->where('category_name', '=', 'operatingsystem')->select('*')->get();

        return view('operatingsystem.add', compact('brands'));
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


            $operatingsystem = new Operatingsystem();
            $operatingsystem->processor_speed = $input['processor_speed'];
            $operatingsystem->memory_requirement = $input['memory_requirement'];
            $operatingsystem->space_requirement = $input['space_requirement'] ;
            $operatingsystem->graphiccard_requirement = $input['graphiccard_requirement'];
            $operatingsystem->item_id = $item->item_id;
            $operatingsystem->save();

            return Redirect::route('operatingsystem.index')->with('success','New Operating System added!');
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
         $operatingsystems = DB::table('operatingsystems AS o')->join('items AS i', 'i.item_id', '=', 'o.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->where('o.operatingsystem_id', '=', $id)->select('*')->get();
        // dd($keyboards);


        return view('operatingsystem.show', compact('operatingsystems'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $operatingsystems = DB::table('operatingsystems
         AS o')->join('items AS i', 'i.item_id', '=', 'o.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->select('*')->where('o.item_id', '=', $id)->get();
       
          $brands = Brand::join('categories AS c', 'c.category_id', '=', 'brands.category_id')->where('category_name', '=', 'operatingsystem')->select('*')->get();

           return view('operatingsystem.edit', compact('operatingsystems', 'brands'));
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

            DB::table('operatingsystems')->where('item_id', '=', $id)
            ->update(['processor_speed' => $request->processor_speed, 
                'memory_requirement' => $request->memory_requirement , 
                'space_requirement' => $request->space_requirement, 
                'graphiccard_requirement' => $request->graphiccard_requirement]);

            return Redirect::route('operatingsystem.index')->with('success','Operating System updated!');
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

        DB::table('operatingsystems')->where('item_id', '=', $id)->delete();
        DB::table('stocks')->where('item_id', '=', $id)->delete();
        DB::table('items')->where('item_id', '=', $id)->delete();

        return Redirect::route('operatingsystem.index')->with('success','Operating system deleted!');
    }
}
