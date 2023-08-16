<?php
namespace App\Http\Controllers;
use App\Models\Item;
use Illuminate\Http\Request;
use Session;
use App\Models\Processor;
use App\Models\Motherboard;
use App\Models\Memory;
use App\Models\Harddrive;
use App\Models\Soliddrive;
use App\Models\Headphone;
use App\Models\Operatingsystem;
use App\Models\Videocard;
use App\Models\Casing;
use App\Models\Powersupply;
use App\Models\Mouse;
use App\Models\Monitor;
use App\Models\Printer;
use App\Models\Keyboard;
use App\Models\Build;
use App\Models\Cart;
use App\Models\Review;
use Redirect;
use Auth;
class BuilderController extends Controller
{
    //

public static function getBuilderOption(){
    $builds = Build::with('user')->where('user_id', auth()->user()->user_id)->get();
     $isPrebuilt = 0;
    return view('shop.buildOption', compact('builds','isPrebuilt')); 
}

public static function getPrebuilt(){
    $builds = Build::join('users','users.user_id', 'builds.user_id')
              ->where('is_admin', "1")->get();
    $isPrebuilt = 1;
    return view('shop.builderPrebuilt', compact('builds', 'isPrebuilt'));
}

public static function getNew(){
    return view('shop.buildName');
}


public static function getDelete($id){
    $build = Build::where('build_id', $id)->delete();
    return redirect()->back()->with('success', 'Build deleted successfully');
}

public static function postNew(Request $request){
    session()->forget('builder_cart');
    session()->forget('builder_cart_info');
    if (!session()->has('builder_cart')){
        session()->put('builder_cart',[
            'processor'=>null, 
            'motherboard'=>null,
            'memory'=>null,
            'harddrive' => null,
            'soliddrive' => null,
            'videocard'=>null,
            'casing'=>null,
            'powersupply'=>null,
            'keyboard'=>null,
            'mouse'=>null,
            'monitor'=>null,
            'headphone' => null,
            'printer'=>null,
            'operatingsystem'=>null,
            ]);

        session()->put('builder_cart_info',[
            'processor'=>'', 
            'motherboard'=>'',
            'memory'=>'',
            'harddrive' => '',
            'soliddrive' => '',
            'headphone' => '',
            'operatingsystem'=>'',
            'videocard'=>'',
            'casing'=>'',
            'powersupply'=>'',
            'keyboard'=>'',
            'mouse'=>'',
            'monitor'=>'',
            'printer'=>'',
            'processor_price'=>'', 
            'motherboard_price'=>'',
            'memory_price'=>'',
            'harddrive_price' => '',
            'soliddrive_price' => '',
            'headphone_price' => '',
            'operatingsystem_price'=>'',
            'videocard_price'=>'',
            'casing_price'=>'',
            'powersupply_price'=>'',
            'keyboard_price'=>'',
            'mouse_price'=>'',
            'monitor_price'=>'',
            'printer_price'=>'',
            'total_price' => 0,
            'powerconsumption'=> 0,
            'build_name'=> "",
            'user_id' =>"",
            'build_id' => 0,

        ]);
    }
   
    $builder_cart_info = session()->get('builder_cart_info');
    $builder_cart_info['build_name'] = $request->build_name;
    $builder_cart_info['user_id'] = auth()->user()->user_id;
    session()->put('builder_cart_info',$builder_cart_info);
    // dd(session()->forget('builder_cart_info'));
    return redirect()->route('pc.builder'); 
}



public static function getSave(){
    $builder_cart = session()->get('builder_cart');
    $builder_cart_info = session()->get('builder_cart_info');
    $indicator = "";
    $findBuild = Build::where('build_id', $builder_cart_info['build_id'])->first();

    // dd($builder_cart_info);
    // update build
    if($findBuild != null){
        date_default_timezone_set('Asia/Manila');
        $findBuild->build_name = $builder_cart_info['build_name'];
        $findBuild->build_date = date("Y-m-d H:i:s",time());
        $findBuild->processor = $builder_cart['processor'];
        $findBuild->motherboard = $builder_cart['motherboard'];
        $findBuild->memory = $builder_cart['memory'];
        $findBuild->harddrive = $builder_cart['harddrive'];
        $findBuild->soliddrive = $builder_cart['soliddrive'];
        $findBuild->headphone = $builder_cart['headphone'];
        $findBuild->operatingsystem = $builder_cart['operatingsystem'];
        $findBuild->videocard = $builder_cart['videocard'];
        $findBuild->casing = $builder_cart['casing'];
        $findBuild->powersupply = $builder_cart['powersupply'];
        $findBuild->keyboard = $builder_cart['keyboard'];
        $findBuild->mouse = $builder_cart['mouse'];
        $findBuild->monitor = $builder_cart['monitor'];
        $findBuild->printer = $builder_cart['printer'];
        $findBuild->total_price = $builder_cart_info['total_price'];
        $findBuild->powerconsumption = $builder_cart_info['powerconsumption'];
        $findBuild->user_id = $builder_cart_info['user_id'];
        $findBuild->save();
        $indicator = "Update";
    }else{
        $build = new Build;
        date_default_timezone_set('Asia/Manila');
        $build->build_name = $builder_cart_info['build_name'];
        $build->build_date = date("Y-m-d H:i:s",time());
        $build->processor = $builder_cart['processor'];
        $build->motherboard = $builder_cart['motherboard'];
        $build->memory = $builder_cart['memory'];
        $build->harddrive = $builder_cart['harddrive'];
        $build->soliddrive = $builder_cart['soliddrive'];
        $build->headphone = $builder_cart['headphone'];
        $build->operatingsystem = $builder_cart['operatingsystem'];
        $build->videocard = $builder_cart['videocard'];
        $build->casing = $builder_cart['casing'];
        $build->powersupply = $builder_cart['powersupply'];
        $build->keyboard = $builder_cart['keyboard'];
        $build->mouse = $builder_cart['mouse'];
        $build->monitor = $builder_cart['monitor'];
        $build->printer = $builder_cart['printer'];
        $build->total_price = $builder_cart_info['total_price'];
        $build->powerconsumption = $builder_cart_info['powerconsumption'];
        $build->user_id = $builder_cart_info['user_id'];
        $build->save();
        $indicator = "Added";
    }
    
        return redirect()->route('pc.builderOption')->with('success', 'Build '.$indicator.' Sucessfully!!!');// code...
    
   
    
    // dump($builder_cart);
    // dump($builder_cart_info);
}


public static function getShow($id){
  
    $build = Build::where('build_id', $id)->first();

    if (!session()->has('builder_cart')){
        session()->put('builder_cart',[
            'processor'=>null, 
            'motherboard'=>null,
            'memory'=>null,
            'harddrive' => null,
            'soliddrive' => null,
            'videocard'=>null,
            'casing'=>null,
            'powersupply'=>null,
            'keyboard'=>null,
            'mouse'=>null,
            'monitor'=>null,
            'headphone' => null,
            'printer'=>null,
            'operatingsystem'=>null,
            ]);

        session()->put('builder_cart_info',[
            'processor'=>'', 
            'motherboard'=>'',
            'memory'=>'',
            'harddrive' => '',
            'soliddrive' => '',
            'headphone' => '',
            'operatingsystem'=>'',
            'videocard'=>'',
            'casing'=>'',
            'powersupply'=>'',
            'keyboard'=>'',
            'mouse'=>'',
            'monitor'=>'',
            'printer'=>'',
            'processor_price'=>'', 
            'motherboard_price'=>'',
            'memory_price'=>'',
            'harddrive_price' => '',
            'soliddrive_price' => '',
            'headphone_price' => '',
            'operatingsystem_price'=>'',
            'videocard_price'=>'',
            'casing_price'=>'',
            'powersupply_price'=>'',
            'keyboard_price'=>'',
            'mouse_price'=>'',
            'monitor_price'=>'',
            'printer_price'=>'',
            'total_price' => 0,
            'powerconsumption'=> 0,
            'build_name'=> "",
            'user_id' =>"",
            'build_id' => 0,

        ]);
    }
   




    $builder_cart = session()->get('builder_cart');
    $builder_cart['processor'] = $build->processor;
    $builder_cart['motherboard'] = $build->motherboard;
    $builder_cart['memory'] = $build->memory;
    $builder_cart['harddrive'] = $build->harddrive;
    $builder_cart['soliddrive'] = $build->soliddrive;
    $builder_cart['videocard'] = $build->videocard;
    $builder_cart['casing'] = $build->casing;
    $builder_cart['powersupply'] = $build->powersupply;
    $builder_cart['keyboard'] = $build->keyboard;
    $builder_cart['mouse'] = $build->mouse;
    $builder_cart['monitor'] = $build->monitor;
    $builder_cart['headphone'] = $build->headphone;
    $builder_cart['printer'] = $build->printer;
    $builder_cart['operatingsystem'] = $build->operatingsystem;

    $builder_cart_info = session()->get('builder_cart_info');

    $processor = Item::where('item_id', $build->processor)->first();
    $motherboard = Item::where('item_id', $build->motherboard)->first();
    $memory = Item::where('item_id', $build->memory)->first();
    $harddrive = Item::where('item_id', $build->harddrive)->first();
    $soliddrive = Item::where('item_id', $build->soliddrive)->first();
    $videocard = Item::where('item_id', $build->videocard)->first();
    $casing = Item::where('item_id', $build->casing)->first();
    $powersupply = Item::where('item_id', $build->powersupply)->first();
    $keyboard = Item::where('item_id', $build->keyboard)->first();
    $mouse = Item::where('item_id', $build->mouse)->first();
    $monitor = Item::where('item_id', $build->monitor)->first();
    $headphone = Item::where('item_id', $build->headphone)->first();
    $printer = Item::where('item_id', $build->printer)->first();
    $operatingsystem = Item::where('item_id', $build->operatingsystem)->first();



    if($processor != null){    
        $builder_cart_info['processor'] = $processor->title;
        $builder_cart_info['processor_price'] = '₱ '.$processor->price;
    }
    else{
        $builder_cart_info['processor'] = "";
        $builder_cart_info['processor_price'] = "0";
    }

    if($motherboard != null){
        $builder_cart_info['motherboard'] = $motherboard->title;
        $builder_cart_info['motherboard_price'] = '₱ '.$motherboard->price;
       
    }
    else{
        $builder_cart_info['motherboard'] = "";
        $builder_cart_info['motherboard_price'] = "0";
    }
    if($memory != null){
        $builder_cart_info['memory'] = $memory->title;
        $builder_cart_info['memory_price'] = '₱ '.$memory->price;
       
    }
    else{
        $builder_cart_info['memory'] = "";
        $builder_cart_info['memory_price'] = "0";
    }
    if($harddrive != null){
        $builder_cart_info['harddrive'] = $harddrive->title;
        $builder_cart_info['harddrive_price'] = '₱ '.$harddrive->price;
        
    }
    else{
        $builder_cart_info['harddrive'] = "";
        $builder_cart_info['harddrive_price'] = "0";
    }
    if($soliddrive != null){
        $builder_cart_info['soliddrive'] = $soliddrive->title;
        $builder_cart_info['soliddrive_price'] = '₱ '.$soliddrive->price;
       
    }
    else{
        $builder_cart_info['soliddrive'] = "";
        $builder_cart_info['soliddrive_price'] = "0";
    }
    if($videocard != null){
        $builder_cart_info['videocard'] = $videocard->title;
        $builder_cart_info['videocard_price'] = '₱ '.$videocard->price;
       
    }
    else{
        $builder_cart_info['videocard'] = "";
        $builder_cart_info['videocard_price'] = "0";
    }
    if($casing != null){
        $builder_cart_info['casing'] = $casing->title;
        $builder_cart_info['casing_price'] = '₱ '.$casing->price;
        
    }
    else{
        $builder_cart_info['casing'] = "";
        $builder_cart_info['casing_price'] = "0";
    }
    if($powersupply != null){
        $builder_cart_info['powersupply'] = $powersupply->title;
        $builder_cart_info['powersupply_price'] = '₱ '.$powersupply->price;
       
    }
    else{
        $builder_cart_info['powersupply'] = "";
        $builder_cart_info['powersupply_price'] = "0";
    }
    if($keyboard != null){
        $builder_cart_info['keyboard'] = $keyboard->title;
        $builder_cart_info['keyboard_price'] = '₱ '.$keyboard->price;
     
    }
    else{
        $builder_cart_info['keyboard'] = "";
        $builder_cart_info['keyboard_price'] = "0";
    }
    if($mouse != null){
        $builder_cart_info['mouse'] = $mouse->title;
        $builder_cart_info['mouse_price'] = '₱ '.$mouse->price;
   
    }
    else{
        $builder_cart_info['mouse'] = "";
        $builder_cart_info['mouse_price'] = "0";
    }
    if($monitor != null){
        $builder_cart_info['monitor'] = $monitor->title;
        $builder_cart_info['monitor_price'] = '₱ '.$monitor->price;
        
    }
    else{
        $builder_cart_info['monitor'] = "";
        $builder_cart_info['monitor_price'] = "0";
    }
    if($headphone != null){
        $builder_cart_info['headphone'] = $headphone->title;
        $builder_cart_info['headphone_price'] = '₱ '.$headphone->price;
       
    }
    else{
        $builder_cart_info['headphone'] = "";
        $builder_cart_info['headphone_price'] = "0";
    }
    if($printer != null){
        $builder_cart_info['printer'] = $printer->title;
        $builder_cart_info['printer_price'] = '₱ '.$printer->price;
       
    }
    else{
        $builder_cart_info['printer'] = "";
        $builder_cart_info['printer_price'] = "0";
    }
    if($operatingsystem != null){    
        $builder_cart_info['operatingsystem'] = $operatingsystem->title;
        $builder_cart_info['operatingsystem_price'] = '₱ '.$operatingsystem->price;
        
    }
    else{
        $builder_cart_info['operatingsystem'] = "";
        $builder_cart_info['operatingsystem_price'] = "0";
    }

    $builder_cart_info['total_price'] = $build->total_price;
    $builder_cart_info['powerconsumption'] = $build->powerconsumption;
    $builder_cart_info['build_name'] = $build->build_name;
    $builder_cart_info['build_id'] = $build->build_id;
    $builder_cart_info['user_id'] =  auth()->user()->user_id;
    // dd($builder_cart_info);
    $prevCategory = "operatingsystem";
    session()->put('builder_cart',$builder_cart);
    session()->put('builder_cart_info',$builder_cart_info);

    return redirect()->route('pc.finish',compact('prevCategory') ); 
}



public static function getAddToCart(){
    $builder_cart = session()->get('builder_cart');
    $builder_cart_info = session()->get('builder_cart_info');
    $indicator = "";
    $findBuild = Build::where('build_id', $builder_cart_info['build_id'])->first();

    // dd($builder_cart_info);
    // update build
    if($findBuild != null){
        date_default_timezone_set('Asia/Manila');
        $findBuild->build_name = $builder_cart_info['build_name'];
        $findBuild->build_date = date("Y-m-d H:i:s",time());
        $findBuild->processor = $builder_cart['processor'];
        $findBuild->motherboard = $builder_cart['motherboard'];
        $findBuild->memory = $builder_cart['memory'];
        $findBuild->harddrive = $builder_cart['harddrive'];
        $findBuild->soliddrive = $builder_cart['soliddrive'];
        $findBuild->headphone = $builder_cart['headphone'];
        $findBuild->operatingsystem = $builder_cart['operatingsystem'];
        $findBuild->videocard = $builder_cart['videocard'];
        $findBuild->casing = $builder_cart['casing'];
        $findBuild->powersupply = $builder_cart['powersupply'];
        $findBuild->keyboard = $builder_cart['keyboard'];
        $findBuild->mouse = $builder_cart['mouse'];
        $findBuild->monitor = $builder_cart['monitor'];
        $findBuild->printer = $builder_cart['printer'];
        $findBuild->total_price = $builder_cart_info['total_price'];
        $findBuild->powerconsumption = $builder_cart_info['powerconsumption'];
        $findBuild->user_id = $builder_cart_info['user_id'];
        $findBuild->save();
        $indicator = "Update";
    }else{
        $build = new Build;
        date_default_timezone_set('Asia/Manila');
        $build->build_name = $builder_cart_info['build_name'];
        $build->build_date = date("Y-m-d H:i:s",time());
        $build->processor = $builder_cart['processor'];
        $build->motherboard = $builder_cart['motherboard'];
        $build->memory = $builder_cart['memory'];
        $build->harddrive = $builder_cart['harddrive'];
        $build->soliddrive = $builder_cart['soliddrive'];
        $build->headphone = $builder_cart['headphone'];
        $build->operatingsystem = $builder_cart['operatingsystem'];
        $build->videocard = $builder_cart['videocard'];
        $build->casing = $builder_cart['casing'];
        $build->powersupply = $builder_cart['powersupply'];
        $build->keyboard = $builder_cart['keyboard'];
        $build->mouse = $builder_cart['mouse'];
        $build->monitor = $builder_cart['monitor'];
        $build->printer = $builder_cart['printer'];
        $build->total_price = $builder_cart_info['total_price'];
        $build->powerconsumption = $builder_cart_info['powerconsumption'];
        $build->user_id = $builder_cart_info['user_id'];
        $build->save();
        $indicator = "Added";
    }



        
        $current_builder_cart = session()->get('builder_cart');
        // $current_builder_cart['customer_id'] = auth()->user()->user_id;    
        // dd($current_builder_cart);

       
      
        foreach($current_builder_cart as $category => $id){ 
            if($id != null && $id != "0"){
          $item = Item::with('stock')->find($id);
          $oldCart = Session::has('cart') ? Session::get('cart') : null;
          $cart = new Cart($oldCart);
          $cart->add($item, $item->item_id, 1);
          session()->put('cart',$cart);
        }
        }
         Session::forget('builder_cart');
         Session::forget('builder_cart_info');
          
         return redirect()->route('product.shoppingCart');
    }

public function getBuilder(Request $request){
   if (Auth::check() == false) {
        return redirect()->route('user.signin');
    }
    if (auth()->user()->is_admin == 2) {
        return redirect()->back();
    }
       //  dd(Session::get('builder_cart_info'));
     // dd($request->all());
    if (!session()->has('builder_cart')){
        session()->put('builder_cart',[
            'processor'=>null, 
            'motherboard'=>null,
            'memory'=>null,
            'harddrive' => null,
            'soliddrive' => null,
            'videocard'=>null,
            'casing'=>null,
            'powersupply'=>null,
            'keyboard'=>null,
            'mouse'=>null,
            'monitor'=>null,
            'headphone' => null,
            'printer'=>null,
            'operatingsystem'=>null,
            ]);

        session()->put('builder_cart_info',[
            'processor'=>'', 
            'motherboard'=>'',
            'memory'=>'',
            'harddrive' => '',
            'soliddrive' => '',
            'headphone' => '',
            'operatingsystem'=>'',
            'videocard'=>'',
            'casing'=>'',
            'powersupply'=>'',
            'keyboard'=>'',
            'mouse'=>'',
            'monitor'=>'',
            'printer'=>'',
            'processor_price'=>'', 
            'motherboard_price'=>'',
            'memory_price'=>'',
            'harddrive_price' => '',
            'soliddrive_price' => '',
            'headphone_price' => '',
            'operatingsystem_price'=>'',
            'videocard_price'=>'',
            'casing_price'=>'',
            'powersupply_price'=>'',
            'keyboard_price'=>'',
            'mouse_price'=>'',
            'monitor_price'=>'',
            'printer_price'=>'',
            'total_price' => 0,
            'powerconsumption'=> 0,
            'build_name'=> "",
            'user_id' => auth()->user()->user_id,
            'build_id' => 0,

        ]);
    }
   
    if(Session::get('builder_cart')['processor'] != null){

    $processorWatts = Processor::where('item_id',Session::get('builder_cart')['processor'])->select('processor_wattage')->first()->processor_wattage;

       $bufferForOC = $processorWatts * 1.5;

       $totalWatts  = $processorWatts + $bufferForOC;

       if (Session::get('builder_cart')['videocard'] != null && Session::get('builder_cart')['videocard'] != "0") {

           $videocardWatts = Videocard::where('item_id',Session::get('builder_cart')['videocard'])->select('gpu_wattage')->first()->gpu_wattage;
            
           $totalWatts  = $totalWatts + $videocardWatts;
       }else{
         $totalWatts  = $totalWatts + 0;
       }

       $finalTotalWatts = $totalWatts * 1.5;

      // dd(round($finalTotalWatts));
      $current_builder_cart_info = session()->get('builder_cart_info');
   
      $current_builder_cart_info['powerconsumption'] = $finalTotalWatts;
      Session::put('builder_cart_info', $current_builder_cart_info);
    
    }
   
    else {
    $current_builder_cart_info = session()->get('builder_cart_info');
   
      $current_builder_cart_info['powerconsumption'] = 0;
      Session::put('builder_cart_info', $current_builder_cart_info);
    }
  

    // dd(Session::get('builder_cart'));

$currentPart = "";
      //Checking Parts to be pick
        foreach(Session::get('builder_cart') as $part=>$val){
            if($val === null){
                $currentPart = $part;
                break;        
            }
        }

 $reviews = Review::selectRaw('AVG(review_rating) review_rating, item_id')->groupBy('item_id')->get();


    //Redirect to parts

        if($currentPart == 'processor'){
            if($request->all()==null){
                  $processors = Processor::with('item')
                  ->join("stocks","processors.item_id", 'stocks.item_id')
                  ->where("stocks.quantity" ,">", 0)
                  ->distinct()->get();
              }
            else{
                 $processors = Processor::join('items', 'processors.item_id', 'items.item_id')->where('items.title', 'like', '%'.$request->all()['searchQuery'].'%')
                  ->join("stocks","processors.item_id", 'stocks.item_id')
                  ->where("stocks.quantity" ,">", 0)->distinct()->get();
            }

             // dd($processors);
              $category = 'processor';
              $nextCategory = 'motherboard';
                            return view('shop.builder', compact('processors', 'category', 'nextCategory', 'reviews'))->with('success', 'nice');
        }


     //   
        if($currentPart == 'motherboard'){
        $currentProcessor = session()->get('builder_cart')['processor'];
        $processor = Processor::with('item')->where('item_id',$currentProcessor)->first(); 


        if($request->all()==null){
        $motherboards = Motherboard::with('item')->where('cpu_socket',$processor->socket_type)
                  ->join("stocks","motherboards.item_id", 'stocks.item_id')
                  ->where("stocks.quantity" ,">", 0)->get();
        }
        else{
            $motherboards = Motherboard::join('items', 'motherboards.item_id', 'items.item_id')
            ->where('cpu_socket',$processor->socket_type)
            ->where('items.title', 'like', '%'.$request->all()['searchQuery'].'%')
                  ->join("stocks","motherboards.item_id", 'stocks.item_id')
                  ->where("stocks.quantity" ,">", 0)->get();
        }
        $prevCategory = 'processor';
        $category = 'motherboard';
        $nextCategory = 'memory';
        return view('shop.builder', compact('motherboards', 'category', 'prevCategory','nextCategory', 'reviews'));
        }

    //
        if($currentPart == 'memory'){
        $currentMotherboard = session()->get('builder_cart')['motherboard'];
       
        if(Session::get('builder_cart')['motherboard'] != "0"){
        $motherboard = Motherboard::with('item')->where('item_id',$currentMotherboard)->first();
               if($request->all()==null){
                $memories = Memory::with('item')->where('memory_type',$motherboard->ram_slot)->join("stocks","memories.item_id", 'stocks.item_id')
                  ->where("stocks.quantity" ,">", 0)->get();
               }
               else{
                $memories = Memory::join('items', 'memories.item_id', 'items.item_id')
                ->where('memory_type',$motherboard->ram_slot)
                ->where('items.title', 'like', '%'.$request->all()['searchQuery'].'%')->join("stocks","memories.item_id", 'stocks.item_id')
                  ->where("stocks.quantity" ,">", 0)->get();
               }
        }
        else{
            if($request->all()==null){
            $memories = Memory::with('item')->join("stocks","memories.item_id", 'stocks.item_id')
                  ->where("stocks.quantity" ,">", 0)->get();

            }
            else{
                $memories = Memory::join('items', 'memories.item_id', 'items.item_id')
                ->where('items.title', 'like', '%'.$request->all()['searchQuery'].'%')->join("stocks","memories.item_id", 'stocks.item_id')
                  ->where("stocks.quantity" ,">", 0)->get();
            }
        }

        $prevCategory = 'motherboard';
        $category = 'memory';
        $nextCategory = 'harddrive';
        return view('shop.builder', compact('memories', 'category','prevCategory', 'nextCategory', 'reviews'));
        }

    //
        if($currentPart == 'harddrive'){

        if($request->all()==null){
        $harddrives = Harddrive::with('item')->join("stocks","harddrives.item_id", 'stocks.item_id')
                  ->where("stocks.quantity" ,">", 0)->get();
        }
        else{
             $harddrives = Harddrive::join('items', 'harddrives.item_id', 'items.item_id')
             ->where('items.title', 'like', '%'.$request->all()['searchQuery'].'%')->join("stocks","harddrives.item_id", 'stocks.item_id')
                  ->where("stocks.quantity" ,">", 0)->get();
        }

        $prevCategory = 'memory';
        $category = 'harddrive';
        $nextCategory = 'soliddrive';
        return view('shop.builder', compact('harddrives', 'category', 'prevCategory', 'nextCategory', 'reviews'));
        }

    //
        if($currentPart == 'soliddrive'){
        if($request->all()==null){
        $soliddrives = Soliddrive::with('item')->join("stocks","soliddrives.item_id", 'stocks.item_id')
                  ->where("stocks.quantity" ,">", 0)->get();
        }
        else{
             $soliddrives = Soliddrive::join('items', 'soliddrives.item_id', 'items.item_id')
             ->where('items.title', 'like', '%'.$request->all()['searchQuery'].'%')->join("stocks","soliddrives.item_id", 'stocks.item_id')
                  ->where("stocks.quantity" ,">", 0)->get();
        }
        $prevCategory = 'harddrive';
        $category = 'soliddrive';
        $nextCategory = 'videocard';
        return view('shop.builder', compact('soliddrives', 'category','prevCategory', 'nextCategory', 'reviews'));
        }

    //
        if($currentPart == 'videocard'){
        if($request->all()==null){
        $videocards = VideoCard::with('item')->join("stocks","videocards.item_id", 'stocks.item_id')
                  ->where("stocks.quantity" ,">", 0)->get();
        }
        else{
             $videocards = VideoCard::join('items', 'videocards.item_id', 'items.item_id')
             ->where('items.title', 'like', '%'.$request->all()['searchQuery'].'%')->join("stocks","videocards.item_id", 'stocks.item_id')
                  ->where("stocks.quantity" ,">", 0)->get();
        }
        $prevCategory = 'soliddrive';
        $category = 'videocard';
        $nextCategory = 'casing';
        return view('shop.builder', compact('videocards', 'category','prevCategory', 'nextCategory', 'reviews'));
        }

    //
        if($currentPart == 'casing'){

        if(Session::get('builder_cart')['motherboard'] != "0"){
                $currentMotherboard = session()->get('builder_cart')['motherboard'];
                $motherboard = Motherboard::with('item')->where('item_id',$currentMotherboard)->first();

                if($request->all()==null){
                  $parCasings = Casing::with('item')->join("stocks","casings.item_id", 'stocks.item_id')
                  ->where("stocks.quantity" ,">", 0)->get();

                }
                else{
                     $parCasings = Casing::join('items', 'casings.item_id', 'items.item_id')
                     ->where('items.title', 'like', '%'.$request->all()['searchQuery'].'%')->join("stocks","casings.item_id", 'stocks.item_id')
                  ->where("stocks.quantity" ,">", 0)->get();
                }


                $casings = array();
           
                foreach($parCasings as $parCasing){
                    $case_mobo = explode(" | ",$parCasing->case_motherboards);

                    if (in_array($motherboard->form_factor,$case_mobo)) {
                    
                    $casings[$parCasing->casing_id] = $parCasing;

                    }
                }
        }
        else{
                 if($request->all()==null){
                    $casings = Casing::with('item')->get();
                    }
                    else{
                    $casings = Casing::join('items', 'casings.item_id', 'items.item_id')
                    ->where('items.title', 'like', '%'.$request->all()['searchQuery'].'%')->get();
                    }
        }


        $prevCategory = 'videocard';
        $category = 'casing';
        $nextCategory = 'powersupply';
        return view('shop.builder', compact('casings','category','prevCategory', 'nextCategory', 'reviews'));
        }


    //
        if($currentPart == 'powersupply'){
            
        $currentWattage = session()->get('builder_cart_info')['powerconsumption'];

    
            if($request->all()==null){
            $powersupplies = Powersupply::with('item')->where('wattage','>=', $currentWattage )->join("stocks","powersupplies.item_id", 'stocks.item_id')
                  ->where("stocks.quantity" ,">", 0)->get();
            }
            else{

                 $powersupplies = Powersupply::join('items', 'powersupplies.item_id', 'items.item_id')
                 ->where('items.title', 'like', '%'.$request->all()['searchQuery'].'%')->join("stocks","powersupplies.item_id", 'stocks.item_id')
                  ->where("stocks.quantity" ,">", 0)->get();
            }


        $prevCategory = 'casing';
        $category = 'powersupply';
        $nextCategory = 'keyboard';
        return view('shop.builder', compact('powersupplies', 'category','prevCategory', 'nextCategory', 'reviews'));
        }

    //
        if($currentPart == 'keyboard'){
         if($request->all()==null){
        $keyboards = Keyboard::with('item')->join("stocks","keyboards.item_id", 'stocks.item_id')
                  ->where("stocks.quantity" ,">", 0)->get();
        }
        else{
        $keyboards = Keyboard::join('items', 'keyboards.item_id', 'items.item_id')
        ->where('items.title', 'like', '%'.$request->all()['searchQuery'].'%')->join("stocks","keyboards.item_id", 'stocks.item_id')
                  ->where("stocks.quantity" ,">", 0)->get();
        }

        $prevCategory = 'powersupply';
        $category = 'keyboard';
        $nextCategory = 'monitor';
        return view('shop.builder', compact('keyboards', 'category','prevCategory', 'nextCategory', 'reviews'));
        }
    //
        if($currentPart == 'mouse'){
            if($request->all()==null){
            $mouses = Mouse::with('item')->join("stocks","mouses.item_id", 'stocks.item_id')
                  ->where("stocks.quantity" ,">", 0)->get();
            }
            else{
            $mouses = Mouse::join('items', 'mouses.item_id', 'items.item_id')
            ->where('items.title', 'like', '%'.$request->all()['searchQuery'].'%')->join("stocks","mouses.item_id", 'stocks.item_id')
                  ->where("stocks.quantity" ,">", 0)->get();
            }

        $prevCategory = 'keyboard';
        $category = 'mouse';
        $nextCategory = 'monitor';
        return view('shop.builder', compact('mouses', 'category','prevCategory', 'nextCategory', 'reviews'));
        }
    //
        if($currentPart == 'monitor'){
            if($request->all()==null){
            $monitors = Monitor::with('item')->join("stocks","monitors.item_id", 'stocks.item_id')
                  ->where("stocks.quantity" ,">", 0)->get();
            }
            else{
            $monitors = Monitor::join('items', 'monitors.item_id', 'items.item_id')
            ->where('items.title', 'like', '%'.$request->all()['searchQuery'].'%')->join("stocks","monitors.item_id", 'stocks.item_id')
                  ->where("stocks.quantity" ,">", 0)->get();
            }
        $prevCategory = 'mouse';
        $category = 'monitor';
        $nextCategory = 'headphone';
        return view('shop.builder', compact('monitors', 'category','prevCategory', 'nextCategory', 'reviews'));
        }

     //
        if($currentPart == 'headphone'){
           if($request->all()==null){
            $headphones = Headphone::with('item')->join("stocks","headphones.item_id", 'stocks.item_id')
                  ->where("stocks.quantity" ,">", 0)->get();
            }
            else{
            $headphones = Headphone::join('items', 'headphones.item_id', 'items.item_id')
            ->where('items.title', 'like', '%'.$request->all()['searchQuery'].'%')->join("stocks","headphones.item_id", 'stocks.item_id')
                  ->where("stocks.quantity" ,">", 0)->get();
            }
        $prevCategory = 'monitor';
        $category = 'headphone';
        $nextCategory = 'printer';
        return view('shop.builder', compact('headphones', 'category','prevCategory', 'nextCategory', 'reviews'));
        }

    //
        if($currentPart == 'printer'){
           if($request->all()==null){
            $printers = Printer::with('item')->join("stocks","printers.item_id", 'stocks.item_id')
                  ->where("stocks.quantity" ,">", 0)->get();
            }
            else{
            $printers = Printer::join('items', 'printers.item_id', 'items.item_id')
            ->where('items.title', 'like', '%'.$request->all()['searchQuery'].'%')->join("stocks","printers.item_id", 'stocks.item_id')
                  ->where("stocks.quantity" ,">", 0)->get();
            }
        $prevCategory = 'headphone';
        $category = 'printer';
        $nextCategory = 'operatingsystem';
        return view('shop.builder', compact('printers', 'category','prevCategory', 'nextCategory', 'reviews'));
        }


    //
        if($currentPart == 'operatingsystem'){
        $problems = array();
        $problemCounter = 0;
        $totalSpace = 0;
        $space_problem_counter = 0;
            if(Session::get('builder_cart')['processor'] != "0"){
            $currentProcessor = session()->get('builder_cart')['processor'];
            $processor = Processor::with('item')->where('item_id',$currentProcessor)->first();
            }
            else
            {
                $problems[1] = "Your Processor is to low";
                $problemCounter++;
            }

            if(Session::get('builder_cart')['memory'] != "0"){
            $currentMemory = session()->get('builder_cart')['memory'];
            $memory = Memory::with('item')->where('item_id',$currentMemory)->first();
            }
            else
            {
                $problems[2]= "Your Memory is to low or not set";
                $problemCounter++;
            }

            if(Session::get('builder_cart')['harddrive'] != "0"){
            $currentHarddrive = session()->get('builder_cart')['harddrive'];
            $harddrive = Harddrive::with('item')->where('item_id',$currentHarddrive)->first();
            $totalSpace += (int)$harddrive->capacity;
            }
            else
            {
                $space_problem_counter ++;
            }
           


            if(Session::get('builder_cart')['soliddrive'] != "0"){
            $currentSoliddrive = session()->get('builder_cart')['soliddrive'];
            $soliddrive = Soliddrive::with('item')->where('item_id',$currentSoliddrive)->first();
            $totalSpace += (int)$soliddrive->capacity;
            }
            else
            {
                $space_problem_counter ++;
            }
            
            if($space_problem_counter > 1)
            {
                $problems[3] = "Your Storage is to low or not set";
                $problemCounter++;
            }

         //dd($problemCounter);

        if ($problemCounter <= 0) {

            if($request->all()==null){
               $operatingsystems = Operatingsystem::with('item')
               ->where('processor_speed','<=', (int)$processor->base_speed)
               ->where('memory_requirement','<=', (int)$memory->memory_size)
               ->where('space_requirement','<=',(int)$totalSpace)->join("stocks","operatingsystems.item_id", 'stocks.item_id')
                  ->where("stocks.quantity" ,">", 0)
               ->get();
           }
            else{
                $operatingsystems = Operatingsystem::join('items', 'operatingsystems.item_id', 'items.item_id')
                ->where('processor_speed','<=', (int)$processor->base_speed)
                ->where('memory_requirement','<=', (int)$memory->memory_size)
                ->where('space_requirement','<=', (int)$harddrive->capacity)
                ->where('items.title', 'like', '%'.$request->all()['searchQuery'].'%')->join("stocks","operatingsystems.item_id", 'stocks.item_id')
                  ->where("stocks.quantity" ,">", 0)->get();
            }

        }else{
       $operatingsystems = null;
       }


        $prevCategory = 'printer';
        $category = 'operatingsystem';

        return view('shop.builder', compact('operatingsystems', 'category','prevCategory', 'problems', 'problemCounter', 'reviews'));


        }


         if($currentPart == ""){

         return Redirect::route('pc.finish');
     }
    }



public function getProcessor($item_id){

    //Transfer Session into variable
    $current_builder_cart = session()->get('builder_cart');
    $current_builder_cart_info = session()->get('builder_cart_info');

    //Put Item ID
    foreach ($current_builder_cart as $category => $id) {
       if ($category = 'processor') {
          $current_builder_cart['processor'] = $item_id;
       }
    }


    $processor = Item::with('processor')->where('item_id', $item_id)->first();

    //Adding Other Info
    foreach ($current_builder_cart_info as $category => $name) {
       if ($category = 'processor') {
          $current_builder_cart_info['processor'] = $processor->title;
          $current_builder_cart_info['total_price'] =+ $processor->price; 
       }
    }

    //Price
    $current_builder_cart_info['processor_price'] = "₱ ".$processor->price;

    //Transfer Variable into session
    session()->put('builder_cart',$current_builder_cart);
    session()->put('builder_cart_info',$current_builder_cart_info);

    return Redirect::route('pc.builder');



}


public function getMotherboard($item_id){

    //Transfer Session into variable
    $current_builder_cart = session()->get('builder_cart');
    $current_builder_cart_info = session()->get('builder_cart_info');

    //Put Item ID
    $current_builder_cart['motherboard'] = $item_id;
    $motherboard = Item::with('motherboard')->where('item_id', $item_id)->first();
    
    //Adding Other Info

    $current_builder_cart_info['motherboard'] = $motherboard->title;
         
   //Total Price update
   $total = $current_builder_cart_info['total_price'];
   $newTotal = $total+$motherboard->price;
   $current_builder_cart_info['total_price'] = $newTotal;

   //Price
   $current_builder_cart_info['motherboard_price'] = "₱ ".$motherboard->price;


       // dd($current_builder_cart_partsName);
      session()->put('builder_cart',$current_builder_cart);
      session()->put('builder_cart_info',$current_builder_cart_info);

    return Redirect::route('pc.builder');



}



public function getMemory($item_id){
       //Transfer Session into variable
        $current_builder_cart = session()->get('builder_cart');
        $current_builder_cart_info = session()->get('builder_cart_info');
        //Put Item ID
        $current_builder_cart['memory'] = $item_id;
        $memory = Item::with('memory')->where('item_id', $item_id)->first();
       //Adding Other Info
        $current_builder_cart_info['memory'] = $memory->title;
       //Total Price update
       $total = $current_builder_cart_info['total_price'];
       $newTotal = $total+$memory->price;
       $current_builder_cart_info['total_price'] = $newTotal;

       //Price
       $current_builder_cart_info['memory_price'] = "₱ ".$memory->price;


           // dd($current_builder_cart_partsName);
          session()->put('builder_cart',$current_builder_cart);
          session()->put('builder_cart_info',$current_builder_cart_info);

        return Redirect::route('pc.builder');
}




public function getHarddrive($item_id){
       //Transfer Session into variable
        $current_builder_cart = session()->get('builder_cart');
        $current_builder_cart_info = session()->get('builder_cart_info');


        //Put Item ID
      
        $current_builder_cart['harddrive'] = $item_id;
       
        $harddrive = Item::with('harddrive')->where('item_id', $item_id)->first();
        
        //Adding Other Info
        $current_builder_cart_info['harddrive'] = $harddrive->title;
             
       //Total Price update
       $total = $current_builder_cart_info['total_price'];
       $newTotal = $total+$harddrive->price;
       $current_builder_cart_info['total_price'] = $newTotal;

       //Price
       $current_builder_cart_info['harddrive_price'] = "₱ ".$harddrive->price;


           // dd($current_builder_cart_partsName);
          session()->put('builder_cart',$current_builder_cart);
          session()->put('builder_cart_info',$current_builder_cart_info);

        return Redirect::route('pc.builder');
}


public function getSoliddrive($item_id){
       //Transfer Session into variable
        $current_builder_cart = session()->get('builder_cart');
        $current_builder_cart_info = session()->get('builder_cart_info');


        //Put Item ID
      
        $current_builder_cart['soliddrive'] = $item_id;
       
        $soliddrive = Item::with('soliddrive')->where('item_id', $item_id)->first();
        
        //Adding Other Info
        $current_builder_cart_info['soliddrive'] = $soliddrive->title;
             
       //Total Price update
       $total = $current_builder_cart_info['total_price'];
       $newTotal = $total+$soliddrive->price;
       $current_builder_cart_info['total_price'] = $newTotal;

       //Price
       $current_builder_cart_info['soliddrive_price'] = "₱ ".$soliddrive->price;


           // dd($current_builder_cart_partsName);
          session()->put('builder_cart',$current_builder_cart);
          session()->put('builder_cart_info',$current_builder_cart_info);

        return Redirect::route('pc.builder');
}



public function getVideocard($item_id){
       //Transfer Session into variable
        $current_builder_cart = session()->get('builder_cart');
        $current_builder_cart_info = session()->get('builder_cart_info');


        //Put Item ID
      
        $current_builder_cart['videocard'] = $item_id;
       
        $videocard = Item::with('videocard')->where('item_id', $item_id)->first();
        
        //Adding Other Info
        $current_builder_cart_info['videocard'] = $videocard->title;
             
       //Total Price update
       $total = $current_builder_cart_info['total_price'];
       $newTotal = $total+$videocard->price;
       $current_builder_cart_info['total_price'] = $newTotal;

       //Price
       $current_builder_cart_info['videocard_price'] = "₱ ".$videocard->price;


           // dd($current_builder_cart_partsName);
          session()->put('builder_cart',$current_builder_cart);
          session()->put('builder_cart_info',$current_builder_cart_info);

        return Redirect::route('pc.builder');
}


public function getCasing($item_id){
       //Transfer Session into variable
        $current_builder_cart = session()->get('builder_cart');
        $current_builder_cart_info = session()->get('builder_cart_info');


        //Put Item ID
      
        $current_builder_cart['casing'] = $item_id;
       
        $casing = Item::with('casing')->where('item_id', $item_id)->first();
        
        //Adding Other Info
        $current_builder_cart_info['casing'] = $casing->title;
             
       //Total Price update
       $total = $current_builder_cart_info['total_price'];
       $newTotal = $total+$casing->price;
       $current_builder_cart_info['total_price'] = $newTotal;

       //Price
       $current_builder_cart_info['casing_price'] = "₱ ".$casing->price;


           // dd($current_builder_cart_partsName);
          session()->put('builder_cart',$current_builder_cart);
          session()->put('builder_cart_info',$current_builder_cart_info);

        return Redirect::route('pc.builder');
}

public function getPowersupply($item_id){
       //Transfer Session into variable
        $current_builder_cart = session()->get('builder_cart');
        $current_builder_cart_info = session()->get('builder_cart_info');


        //Put Item ID
      
        $current_builder_cart['powersupply'] = $item_id;
       
        $powersupply = Item::with('powersupply')->where('item_id', $item_id)->first();
        
        //Adding Other Info
        $current_builder_cart_info['powersupply'] = $powersupply->title;
             
       //Total Price update
       $total = $current_builder_cart_info['total_price'];
       $newTotal = $total+$powersupply->price;
       $current_builder_cart_info['total_price'] = $newTotal;

       //Price
       $current_builder_cart_info['powersupply_price'] = "₱ ".$powersupply->price;


           // dd($current_builder_cart_partsName);
          session()->put('builder_cart',$current_builder_cart);
          session()->put('builder_cart_info',$current_builder_cart_info);

        return Redirect::route('pc.builder');
}



public function getKeyboard($item_id){
       //Transfer Session into variable
        $current_builder_cart = session()->get('builder_cart');
        $current_builder_cart_info = session()->get('builder_cart_info');

        //Put Item ID
      
        $current_builder_cart['keyboard'] = $item_id;
       
        $keyboard = Item::with('keyboard')->where('item_id', $item_id)->first();
        
        //Adding Other Info
        $current_builder_cart_info['keyboard'] = $keyboard->title;
             
       //Total Price update
       $total = $current_builder_cart_info['total_price'];
       $newTotal = $total+$keyboard->price;
       $current_builder_cart_info['total_price'] = $newTotal;

       //Price
       $current_builder_cart_info['keyboard_price'] = "₱ ".$keyboard->price;


           // dd($current_builder_cart_partsName);
          session()->put('builder_cart',$current_builder_cart);
          session()->put('builder_cart_info',$current_builder_cart_info);

        return Redirect::route('pc.builder');
}


public function getMouse($item_id){
       //Transfer Session into variable
        $current_builder_cart = session()->get('builder_cart');
        $current_builder_cart_info = session()->get('builder_cart_info');

        //Put Item ID
      
        $current_builder_cart['mouse'] = $item_id;
       
        $mouse = Item::with('mouse')->where('item_id', $item_id)->first();
        
        //Adding Other Info
        $current_builder_cart_info['mouse'] = $mouse->title;
             
       //Total Price update
       $total = $current_builder_cart_info['total_price'];
       $newTotal = $total+$mouse->price;
       $current_builder_cart_info['total_price'] = $newTotal;

       //Price
       $current_builder_cart_info['mouse_price'] = "₱ ".$mouse->price;


           // dd($current_builder_cart_partsName);
          session()->put('builder_cart',$current_builder_cart);
          session()->put('builder_cart_info',$current_builder_cart_info);

        return Redirect::route('pc.builder');
}


public function getMonitor($item_id){
       //Transfer Session into variable
        $current_builder_cart = session()->get('builder_cart');
        $current_builder_cart_info = session()->get('builder_cart_info');

        //Put Item ID
      
        $current_builder_cart['monitor'] = $item_id;
       
        $monitor = Item::with('monitor')->where('item_id', $item_id)->first();
        
        //Adding Other Info
        $current_builder_cart_info['monitor'] = $monitor->title;
             
       //Total Price update
       $total = $current_builder_cart_info['total_price'];
       $newTotal = $total+$monitor->price;
       $current_builder_cart_info['total_price'] = $newTotal;

       //Price
       $current_builder_cart_info['monitor_price'] = "₱ ".$monitor->price;


           // dd($current_builder_cart_partsName);
          session()->put('builder_cart',$current_builder_cart);
          session()->put('builder_cart_info',$current_builder_cart_info);

        return Redirect::route('pc.builder');
}



public function getHeadphone($item_id){
       //Transfer Session into variable
        $current_builder_cart = session()->get('builder_cart');
        $current_builder_cart_info = session()->get('builder_cart_info');

        //Put Item ID
      
        $current_builder_cart['headphone'] = $item_id;
       
        $headphone = Item::with('headphone')->where('item_id', $item_id)->first();
        
        //Adding Other Info
        $current_builder_cart_info['headphone'] = $headphone->title;
             
       //Total Price update
       $total = $current_builder_cart_info['total_price'];
       $newTotal = $total+$headphone->price;
       $current_builder_cart_info['total_price'] = $newTotal;

       //Price
       $current_builder_cart_info['headphone_price'] = "₱ ".$headphone->price;


           // dd($current_builder_cart_partsName);
          session()->put('builder_cart',$current_builder_cart);
          session()->put('builder_cart_info',$current_builder_cart_info);

        return Redirect::route('pc.builder');
}

public function getPrinter($item_id){
       //Transfer Session into variable
        $current_builder_cart = session()->get('builder_cart');
        $current_builder_cart_info = session()->get('builder_cart_info');

        //Put Item ID
      
        $current_builder_cart['printer'] = $item_id;
       
        $printer = Item::with('printer')->where('item_id', $item_id)->first();
        
        //Adding Other Info
        $current_builder_cart_info['printer'] = $printer->title;
             
       //Total Price update
       $total = $current_builder_cart_info['total_price'];
       $newTotal = $total+$printer->price;
       $current_builder_cart_info['total_price'] = $newTotal;

       //Price
       $current_builder_cart_info['printer_price'] = "₱ ".$printer->price;


           // dd($current_builder_cart_partsName);
          session()->put('builder_cart',$current_builder_cart);
          session()->put('builder_cart_info',$current_builder_cart_info);

        return Redirect::route('pc.builder');
}


public function getOperatingsystem($item_id){
       //Transfer Session into variable
        $current_builder_cart = session()->get('builder_cart');
        $current_builder_cart_info = session()->get('builder_cart_info');

        //Put Item ID
      
        $current_builder_cart['operatingsystem'] = $item_id;
       
        $operatingsystem = Item::with('operatingsystem')->where('item_id', $item_id)->first();
        
        //Adding Other Info
        $current_builder_cart_info['operatingsystem'] = $operatingsystem->title;
             
       //Total Price update
       $total = $current_builder_cart_info['total_price'];
       $newTotal = $total+$operatingsystem->price;
       $current_builder_cart_info['total_price'] = $newTotal;

       //Price
       $current_builder_cart_info['operatingsystem_price'] = "₱ ".$operatingsystem->price;


           // dd($current_builder_cart_partsName);
          session()->put('builder_cart',$current_builder_cart);
          session()->put('builder_cart_info',$current_builder_cart_info);

        return Redirect::route('pc.finish');
}


public function getBack($prevCategory){
    //Transfer Session into variable
        $current_builder_cart = session()->get('builder_cart');
        $current_builder_cart_info = session()->get('builder_cart_info');
         //  dump($current_builder_cart);
         // dump($current_builder_cart_info);
        // dd($current_builder_cart_info);

         if( $current_builder_cart[$prevCategory] != "0" || $current_builder_cart[$prevCategory] != 0){
        $prev_category_price = explode(" ",$current_builder_cart_info[$prevCategory."_price"])[1] ;
         $current_builder_cart_info[$prevCategory."_price"] = "";
        $current_builder_cart_info['total_price'] -= $prev_category_price;
        }

        $current_builder_cart[$prevCategory] = null;
        $current_builder_cart_info[$prevCategory] = "";

       



         session()->put('builder_cart',$current_builder_cart);
          session()->put('builder_cart_info',$current_builder_cart_info);
        return Redirect::route('pc.builder');
         
      
}


public function getSkip($category){
    //Transfer Session into variable
        $current_builder_cart = session()->get('builder_cart');
        $current_builder_cart_info = session()->get('builder_cart_info');

        $current_builder_cart[$category] = "0";
        $current_builder_cart_info[$category] = "";
        $current_builder_cart_info[$category."_price"] = "0";

        session()->put('builder_cart',$current_builder_cart);
        session()->put('builder_cart_info',$current_builder_cart_info);
        return Redirect::route('pc.builder');
}

public function getFinish(){
    // dd(Session::all());
    $current_builder_cart = session()->get('builder_cart');

    $processor = Processor::with('item')->where('item_id', $current_builder_cart['processor'])->first();

    $motherboard = Motherboard::with('item')->where('item_id', $current_builder_cart['motherboard'])->first();

    $memory = Memory::with('item')->where('item_id', $current_builder_cart['memory'])->first();


    $harddrive = Harddrive::with('item')->where('item_id', $current_builder_cart['harddrive'])->first();

    $soliddrive = Soliddrive::with('item')->where('item_id', $current_builder_cart['soliddrive'])->first();
   

    $videocard = Videocard::with('item')->where('item_id', $current_builder_cart['videocard'])->first();
   

    $casing = Casing::with('item')->where('item_id', $current_builder_cart['casing'])->first();
   

    $powersupply = Powersupply::with('item')->where('item_id', $current_builder_cart['powersupply'])->first();
   

    $keyboard = Keyboard::with('item')->where('item_id', $current_builder_cart['keyboard'])->first();
   

    $mouse = Mouse::with('item')->where('item_id', $current_builder_cart['mouse'])->first();
   

    $monitor = Monitor::with('item')->where('item_id', $current_builder_cart['monitor'])->first();

    $headphone = Headphone::with('item')->where('item_id', $current_builder_cart['headphone'])->first();
    $printer = Printer::with('item')->where('item_id', $current_builder_cart['printer'])->first();
    $operatingsystem = Operatingsystem::with('item')->where('item_id', $current_builder_cart['operatingsystem'])->first();
    //dd($current_builder_cart);


// To determine computer build type

    //For Deskstop
     if($processor->max_speed > 1 && $processor->max_speed <= 2)
     {
            //Check if for Workstation
           $processor_ws = 0;
           $notes = array();
           $processor_name = explode(" ",$processor->item->title);
           // dd($processor_name);

            foreach($processor_name as $pn){
                    if (strcasecmp($pn, "Threadripper") == 0 || strcasecmp($pn, "Xeon") == 0) {
                       $processor_ws = 1;
                       break;
                    }
            }


            if ($processor_ws == 1) {
               $build_category = "Work Station";
               $processor_speed_summary = "A special processor designed for technical or scientific application. It Used to solve high-end technical matters such as mechanical designing, animation, engineering, simulation, etc";
                 //Recommendation for Memory size
                 if($memory !=null){
                      if ($memory->memory_size < 16) {
                      $notes[1] = "Try to use 16GB RAM or Higher to for better experience";
                       }
                  }
                  else{
                        $notes[1] = "Try to use 16GB RAM or Higher to for better experience";
                  }
                //Recommendation for Video Card
                if($videocard ==null){
                        $notes[2] = "Try to use Videocard for better experience";
                }

            
            }
            else
            {
                $build_category = "Deskstop";
                $processor_speed_summary = "A regular computer design. Used to perform regular tasks suck as web browsing, word processing, gaming,etc ";

            }

       }

    //For Low-Mid Gaming 
    if($processor->max_speed > 2 && $processor->max_speed < 3.4)
   {
           //Check if for workstation
           $processor_ws = 0;
           $notes = array();
           $processor_name = explode(" ",$processor->item->title);
           // dd($processor_name);

            foreach($processor_name as $pn){
                    if (strcasecmp($pn, "Threadripper") == 0 || strcasecmp($pn, "Xeon") == 0) {
                       $processor_ws = 1;
                       break;
                    }
            }


            if ($processor_ws == 1) {
               $build_category = "Work Station";
               $processor_speed_summary = "A special processor designed for technical or scientific application. It Used to solve high-end technical matters such as mechanical designing, animation, engineering, simulation, etc";
            
                 //Recommendation for Memory size
            if($memory !=null){
                if ($memory->memory_size < 16) {
                    $notes[1] = "Try to use 16GB RAM or Higher to for better experience";
                }
            }
            else{
                $notes[1] = "Try to use 16GB RAM or Higher to for better experience";
            }

            // dd($processor_speed_summary);
            //Recommendation for Video Card
            if($videocard ==null){
                    $notes[2] = "Try to use Videocard for better experience";
            }

            }
            else
            {

            $build_category = "Low to Mid Gaming";
            $processor_speed_summary = "a gaming PC is very much like some other PC. The thing that matters is a gaming PC normally has more powerful CPU";
            
            //Recommendation for Memory size
            if($memory !=null){
                if ($memory->memory_size < 8) {
                    $notes[1] = "Use 8GB RAM or Higher to meet the Description";
                }
            }
            else{
                $notes[1] = " Use 8GB RAM or Higher to meet the Description";
            }

            // dd($processor_speed_summary);
            //Recommendation for Video Card
            if($videocard ==null){
                    $notes[2] = "Use Videocard to meet the Description";
            }

            }

            
   }



 //For High Gaming 
    if($processor->max_speed >= 3.5)
   {
           //Check if for workstation
           $processor_ws = 0;
           $notes = array();
           $processor_name = explode(" ",$processor->item->title);
           // dd($processor_name);

            foreach($processor_name as $pn){
                    if (strcasecmp($pn, "Threadripper") == 0 || strcasecmp($pn, "Xeon") == 0) {
                       $processor_ws = 1;
                       break;
                    }
            }


            if ($processor_ws == 1) {
               $build_category = "Work Station";
               $processor_speed_summary = "A special processor designed for technical or scientific application. It Used to solve high-end technical matters such as mechanical designing, animation, engineering, simulation, etc.";
            
                 //Recommendation for Memory size
            if($memory !=null){
                if ($memory->memory_size < 16) {
                    $notes[1] = "Use 16GB RAM or Higher to meet the Description";
                }
            }
            else{
                $notes[1] = "Use 16GB RAM or Higher to meet the Description";
            }

            // dd($processor_speed_summary);
            //Recommendation for Video Card
            if($videocard ==null){
                    $notes[2] = "Use Videocard to meet the Description";
            }

            }
            else
            {

            $build_category = "High End Gaming";
            $processor_speed_summary = "a gaming PC is very much like some other PC. The thing that matters is a gaming PC normally has more powerful CPU";
            
            //Recommendation for Memory size
            if($memory !=null){
                if ($memory->memory_size < 8) {
                    $notes[1] = "Use 8GB RAM or Higher to meet the Description";
                }
            }
            else{
                $notes[1] = "Use 8GB RAM or Higher to meet the Description";
            }

            // dd($processor_speed_summary);
            //Recommendation for Video Card
            if($videocard ==null){
                    $notes[2] = "Use Videocard to meet the Description";
            }

            }
   }
    if((int)$processor->core_count<=4){
        $processor_core_summary = "General use, light browsing, and very light gaming";
    }
    if((int)$processor->core_count > 4 &&  (int)$processor->core_count <= 8){
        $processor_core_summary = "Decent for gaming, moderate multi-tasking, and all general-use purposes";
    }
    if((int)$processor->core_count > 8 &&  (int)$processor->core_count <= 16){
        $processor_core_summary = "Entry-level workstation CPU. Can handle moderately demanding tasks.";
    }
    if((int)$processor->core_count > 16 &&  (int)$processor->core_count <= 32){
        $processor_core_summary = "Mid-range workstation CPU. Handles fairly demanding tasks including rendering, CAD, and all kinds of streaming.";
    }
    if((int)$processor->core_count > 32 &&  (int)$processor->core_count <= 64){
        $processor_core_summary = "High-end workstation CPU. Handles the most demanding workstation tasks.";
    }
        $noEdit = false;
         $prevCategory = 'operatingsystem';

   return view('shop.builderFinish', compact('processor', 'motherboard', 'memory', 'harddrive','soliddrive', 'videocard', 'casing', 'powersupply', 'keyboard', 'mouse', 'monitor', 'headphone', 'printer', 'operatingsystem', 'build_category', 'processor_speed_summary', 'notes', 'processor_core_summary', 'prevCategory', 'noEdit'));
}

}