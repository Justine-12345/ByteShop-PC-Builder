<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Motherboard;
use App\Models\Brand;
use App\Models\Item;
use App\Models\Stock;
use Validator;
use Redirect;
use DB;
class MotherboardController extends Controller
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
            'form_factor' => 'required',
            'cpu_socket' => 'required',
            'ram_slot' => 'required',
           
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
                $name = 'motherboard_'.time().'.'.$extension;

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
          $motherboards = DB::table('motherboards AS m')->join('items AS i', 'i.item_id', '=', 'm.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->select('*')->get();
          // dd($motherboards);
        return view('motherboard.index', compact('motherboards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $brands = Brand::join('categories AS c', 'c.category_id', '=', 'brands.category_id')->where('category_name', '=', 'Motherboard')->select('*')->get();

        return view('motherboard.add', compact('brands'));
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

        $video_connectors = '';

        foreach ($request->video_connectors as $vc) {
            // dd($vc);
            $video_connectors .= $vc . ' | ';
        }
        // dd($video_connectors);

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

            // dd($input);

            $motherboard = new Motherboard();
            $motherboard->form_factor = $input['form_factor'];
            $motherboard->cpu_socket = $input['cpu_socket'];
            $motherboard->usb_ports = $input['usb_ports'] ;
            $motherboard->ram_slot = $input['ram_slot'];
            $motherboard->video_connectors = 'video_connectors';
            $motherboard->pcie_slots = $input['pcie_slots'];
            $motherboard->inbuilt_wifi = $input['inbuilt_wifi'];
            $motherboard->sata = $input['sata'];
            $motherboard->nvme_support = $input['nvme_support'];
            $motherboard->rgb_header = $input['rgb_header'];
            $motherboard->motherboard_description = $input['motherboard_description'];
            $motherboard->item_id = $item->item_id;

            $motherboard->save();

            return Redirect::route('motherboard.index')->with('success','New motherboard added!');
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
         $motherboards = DB::table('motherboards AS m')->join('items AS i', 'i.item_id', '=', 'm.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->where('m.motherboard_id', '=', $id)->select('*')->get();
        // dd($keyboards);


        return view('motherboard.show', compact('motherboards'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $motherboards = DB::table('motherboards AS m')->join('items AS i', 'i.item_id', '=', 'm.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->select('*')->where('m.motherboard_id', '=', $id)->get();

        // $motherboard_formfactors = ['Mini-ITX', 'MicroATX', 'ATX', 'EATX'];

        $brands = Brand::join('categories AS c', 'c.category_id', '=', 'brands.category_id')->where('category_name', '=', 'Motherboard')->select('*')->get();
        $video_connectors_formfactors = ['VGA', 'DVI', 'HDMI', 'Display Port'];

                 $video_connectors = explode(' | ', $motherboards[0]->video_connectors);
        // dd($keyboards);
        return view('motherboard.edit', compact('motherboards', 'brands', 'video_connectors_formfactors', 'video_connectors'));
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

             // dd($input);
            $video_connectors = "";
            foreach ($request->video_connectors as $vc) {
              $video_connectors .= $vc. ' | ';
            }


            DB::table('items')->where('item_id', '=', $id)->update(['title' => $request->title, 'price' => $request->price, 'brand_id' => $request->brand_id]);

            DB::table('stocks')->where('item_id', '=', $id)->update(['quantity' => $request->quantity]);

            DB::table('motherboards')->where('item_id', '=', $id)->update(['form_factor' => $request->form_factor, 'cpu_socket' => $request->cpu_socket , 'usb_ports' => $request->usb_ports, 'ram_slot' => $request->ram_slot, 'video_connectors' => $video_connectors,'pcie_slots' => $request->pcie_slots, 'inbuilt_wifi' => $request->inbuilt_wifi, 'sata' => $request->sata, 'nvme_support' => $request->nvme_support, 'rgb_header' => $request->rgb_header,  'motherboard_description' => $request->motherboard_description]);

            return Redirect::route('motherboard.index')->with('success','Motherboard updated!');
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

        DB::table('motherboards')->where('item_id', '=', $id)->delete();
        DB::table('stocks')->where('item_id', '=', $id)->delete();
        DB::table('items')->where('item_id', '=', $id)->delete();

        return Redirect::route('motherboard.index')->with('success','Motherboard deleted!');
    }
}
