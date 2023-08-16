<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Printer;
use App\Models\Brand;
use App\Models\Item;
use App\Models\Stock;
use Validator;
use Redirect;
use DB;
use File;
class PrinterController extends Controller
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
             'printer_type' => 'required',
            'print_speed' => 'required',
            'paper_capacity' => 'required|numeric',
            'dpi' => 'required',
            'copy_speed' => 'required',
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
                $name = 'printer_'.time().'.'.$extension;

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
         $printers = DB::table('printers AS p')->join('items AS i', 'i.item_id', '=', 'p.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->select('*')->get();
   //     dd($printers);

        return view('printer.index', compact('printers'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::join('categories AS c', 'c.category_id', '=', 'brands.category_id')->where('category_name', '=', 'Printer')->select('*')->get();

        return view('printer.add', compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $connections = '';

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


            $printer = new Printer();
            $printer->printer_type = $input['printer_type'];
            $printer->ink_type = $input['int_type'];
            $printer->all_inOne = $input['all_inOne'] ;
            $printer->print_speed = $input['print_speed'];
            $printer->duplex_support = $input['duplex_support'];
            $printer->automatic_feed = $input['automatic_feed'];
            $printer->dpi = $input['dpi'];
            $printer->paper_capacity= $input['paper_capacity'];
            $printer->duty_cycle = $input['duty_cycle']  ;
            $printer->catridge_capacity = $input['catridge_capacity'];

              if ($request->has('connection_interface')) {
                foreach($request->connection_interface as $connection_interface){
                $connections .= $connection_interface. ' | ';
            }
             $printer->connection_interface = $connections;
            }
           
            $printer->scanner_resolution = $input['scanner_resolution'] ;
            $printer->copy_speed = $input['copy_speed'];
            $printer->printer_memory = $input['printer_memory'];
            $printer->encryption_support = $input['encryption_support'];
            $printer->printer_description = $input['printer_description'];
            $printer->item_id = $item->item_id;
            $printer->save();

            return Redirect::route('printer.index')->with('success','New printer added!');
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
        $printers = DB::table('printers AS p')->join('items AS i', 'i.item_id', '=', 'p.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->where('p.printer_id', '=', $id)->select('*')->get();
        // dd($keyboards);

        $connection_interface = explode(' | ', $printers[0]->connection_interface);
        return view('printer.show', compact('printers', 'connection_interface'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $printers = DB::table('printers AS p')->join('items AS i', 'i.item_id', '=', 'p.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->select('*')->where('p.printer_id', '=', $id)->get();

    

        $brands = Brand::join('categories AS c', 'c.category_id', '=', 'brands.category_id')->where('category_name', '=', 'Printer')->select('*')->get();
         $connection_interface_formfactors = ['Standard USB Cable', 'Bluetooth Capability', 'Wi-Fi Capability', 'Cloud Printing Capability' ,'NFC Printing'];

                 $connection_interface = explode(' | ', $printers[0]->connection_interface);
        // dd($keyboards);
        return view('printer.edit', compact('printers', 'brands', 'connection_interface_formfactors', 'connection_interface'));
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
        $connections = '';
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

            if ($request->has('connection_interface')) {
                foreach($request->connection_interface as $connection_interface){
                    $connections .= $connection_interface. ' | ';
                }


                DB::table('printers')->where('item_id', '=', $id)->update(['connection_interface' => $connections,]);
            }
           

            DB::table('items')->where('item_id', '=', $id)->update(['title' => $request->title, 'price' => $request->price, 'brand_id' => $request->brand_id]);

            DB::table('stocks')->where('item_id', '=', $id)->update(['quantity' => $request->quantity]);

            DB::table('printers')->where('item_id', '=', $id)->update(['printer_type' => $request->printer_type, 'ink_type' => $request->int_type, 'all_inOne' => $request->all_inOne, 'print_speed' => $request->print_speed, 'duplex_support' => $request->duplex_support, 'automatic_feed' => $request->automatic_feed, 'dpi' => $request->dpi, 'paper_capacity' => $request->paper_capacity, 'duty_cycle' => $request->duty_cycle, 'catridge_capacity' => $request->catridge_capacity,'scanner_resolution' => $request->scanner_resolution, 'copy_speed' => $request->copy_speed, 'printer_memory' => $request->printer_memory, 'encryption_support' => $request->encryption_support,  'printer_description' => $request->printer_description]);

            return Redirect::route('printer.index')->with('success','Printer updated!');
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

        DB::table('printers')->where('item_id', '=', $id)->delete();
        DB::table('stocks')->where('item_id', '=', $id)->delete();
        DB::table('items')->where('item_id', '=', $id)->delete();

        return Redirect::route('printer.index')->with('success','Printer deleted!');
    }
}
