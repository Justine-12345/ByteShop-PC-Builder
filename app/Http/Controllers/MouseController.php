<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Mouse;
use App\Models\Brand;
use App\Models\Item;
use App\Models\Stock;
use Validator;
use Redirect;
use DB;
use File;
class MouseController extends Controller
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
            'dpi' => 'numeric',
           
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
                $name = 'mouse_'.time().'.'.$extension;

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
    // $mouses = Mouse::paginate(10);

        $mouses = DB::table('mouses AS m')->join('items AS i', 'i.item_id', '=', 'm.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->select('*')->get();
   //     dd($mouses);

        return view('mouse.index', compact('mouses'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::join('categories AS c', 'c.category_id', '=', 'brands.category_id')->where('category_name', '=', 'Mouse')->select('*')->get();

        return view('mouse.add', compact('brands'));
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


            $mouse = new Mouse();
            $mouse->sensor = $input['sensor'];
            $mouse->dpi = $input['dpi'];
            $mouse->poll_rate = $input['poll_rate'] ;
            $mouse->tracking_speed = $input['tracking_speed'];
            $mouse->build_type = $input['build_type'];
            $mouse->mouse_wired = $input['mouse_wired'];
            $mouse->programmable_button = $input['programmable_button'];
            $mouse->weight_customization = $input['weight_customization'];
            $mouse->liftoff_distance = $input['liftoff_distance'];
            $mouse->angle_snapping = $input['angle_snapping'];
            $mouse->mouse_description = $input['mouse_description'];
            $mouse->item_id = $item->item_id;
            $mouse->save();

            return Redirect::route('mouse.index')->with('success','New mouse added!');
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
          $mouses = DB::table('mouses AS m')->join('items AS i', 'i.item_id', '=', 'm.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->where('m.mouse_id', '=', $id)->select('*')->get();
        // dd($keyboards);


        return view('mouse.show', compact('mouses'));
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mouses = DB::table('mouses AS m')->join('items AS i', 'i.item_id', '=', 'm.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->select('*')->where('m.mouse_id', '=', $id)->get();

        // $motherboard_formfactors = ['Mini-ITX', 'MicroATX', 'ATX', 'EATX'];

        $brands = Brand::join('categories AS c', 'c.category_id', '=', 'brands.category_id')->where('category_name', '=', 'Mouse')->select('*')->get();

        // dd($keyboards);
        return view('mouse.edit', compact('mouses', 'brands'));
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
                    File::delete(public_path().'/src/images/products/'.$file[0]->image);
                }

                $filename = $this->imageUpload($request);

                DB::table('items')->where('item_id', '=', $id)->update(['image' => $filename]);
            }

            DB::table('items')->where('item_id', '=', $id)->update(['title' => $request->title, 'price' => $request->price, 'brand_id' => $request->brand_id]);

            DB::table('stocks')->where('item_id', '=', $id)->update(['quantity' => $request->quantity]);

            DB::table('mouses')->where('item_id', '=', $id)->update(['sensor' => $request->sensor, 'dpi' => $request->dpi , 'poll_rate' => $request->poll_rate, 'tracking_speed' => $request->tracking_speed, 'build_type' => $request->build_type,'mouse_wired' => $request->mouse_wired, 'programmable_button' => $request->programmable_button, 'weight_customization' => $request->weight_customization, 'liftoff_distance' => $request->liftoff_distance, 'angle_snapping' => $request->angle_snapping,  'mouse_description' => $request->mouse_description]);

            return Redirect::route('mouse.index')->with('success','Mouse updated!');
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
           File::delete(public_path().'/src/images/products/'.$filename[0]->image);
        }

        DB::table('mouses')->where('item_id', '=', $id)->delete();
        DB::table('stocks')->where('item_id', '=', $id)->delete();
        DB::table('items')->where('item_id', '=', $id)->delete();

        return Redirect::route('mouse.index')->with('success','Mouse deleted!');
    }
}
