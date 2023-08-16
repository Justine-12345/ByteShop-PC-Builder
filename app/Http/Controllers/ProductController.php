<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Item;
use App\Models\Cart;
use App\Models\Stock;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Review;
use App\Models\Message;
use Validator;
use Session;
use Redirect;
use DB;
use Auth;
use File;
use Illuminate\Support\Collection;
class ProductController extends Controller
{

       protected function validator(Request $request) {
        $rules = [
            'rating' => 'required',
        ];
        
        //error messages of all fields
        $messages = [
            'required' => 'Required',
        ];
        //for validating all of the fields
        $validator = Validator::make($request->all(), $rules, $messages);
        return $validator;
    }

     public function getIndex(Request $request)
    {   
         
        // dd($request->has('search'));
        $sort = "";
        $i = 0;
        $s = "";
        $searchCount = "";
        if ($request->has('search')&&$request->has('category')) {
             $productsA = Stock::join('items','items.item_id', 'stocks.item_id')
             ->join("brands",'brands.brand_id','items.brand_id')
             ->join("categories",'categories.category_id','brands.category_id')
             ->where('quantity','>','0')
             ->where('title', 'LIKE', "%" . $request->search . "%")
             ->distinct()->get();


             $productsB = Stock::join('items','items.item_id', 'stocks.item_id')
             ->join("brands",'brands.brand_id','items.brand_id')
             ->join("categories",'categories.category_id','brands.category_id')
             ->where('quantity','>','0')
             ->where('brand_name', 'LIKE', "%" . $request->search . "%")
             ->distinct()->get();

             $productsC = Stock::join('items','items.item_id', 'stocks.item_id')
             ->join("brands",'brands.brand_id','items.brand_id')
             ->join("categories",'categories.category_id','brands.category_id')
             ->where('quantity','>','0')
             ->where('category_name', 'LIKE', "%" . $request->search . "%")
             ->distinct()->get();
             // dd($productsB);
               $parProducts = new Collection; 
               foreach($productsA as $pa){
                 $parProducts->add($pa);
               }
               
                foreach($productsB as $pb){
                 $parProducts->add($pb);
               }
                foreach($productsC as $pc){
                 $parProducts->add($pc);
               }

               $products = $parProducts->unique();

               foreach($products as $product){
                  $i++;
                  
               }
               if ($i > 1) {
                   $s = "results";
               }
               else{
                $s = "result";
               }
               $searchCount = $i ." ".$s." found for '". $request->search."' "; 


        }
        else{
            $products = Stock::with('item')->where('quantity','>','0')->distinct()->get();
        }
        




        //eslses
        $reviews = Review::selectRaw('AVG(review_rating) rating, item_id')->groupBy('item_id')->get();
        $brands = Brand::with('category')->with('items')->get();
        $solds = DB::table('orderline')
                ->selectRaw('SUM(quantity) quantity, item_id')
                ->groupBy('item_id')->get();
       //endelses

         $orderby = "ASC";       


        if (Auth::check() && auth()->user()->is_admin == 1) {
            return redirect()->route('admin.dashboard');
        }

        if (Auth::check() && auth()->user()->is_admin == 2) {
            return redirect()->back();
        }

        if ($request->sort == "Rate") {
            if ($request->order == "ASC" || $request->order == null) {
               $reviews = Review::selectRaw('AVG(review_rating) rating, item_id')->groupBy('item_id')->orderBy('rating', 'ASC')->get();
                $orderby = "DESC";
            }
            
            if ($request->order == "DESC") {
                $reviews = Review::selectRaw('AVG(review_rating) rating, item_id')->groupBy('item_id')->orderBy('rating', 'DESC')->get();
                $orderby = "ASC";
            }
                $partialProducts = new Collection;       
                $noReview = new Collection;

                foreach($reviews as $review){

                    foreach($products as $key => $product){
                        if($review->item_id == $product->item_id){
                            $partialProducts->add( $product);
                            $products->forget($key);
                        }
                    }

                }

                foreach($products as $product){
                    if($request->sort == "ASC"){
                    $partialProducts->prepend( $product);
                    }else{
                    $partialProducts->add( $product);
                    }
                }
               $products = $partialProducts;
        }



        if ($request->sort == "Price") {
             if ($request->order == "ASC" || $request->order == null) {
               $prices = Item::orderBy('price', 'ASC')->get();
                $orderby = "DESC";
            }
            if ($request->order == "DESC") {
               $prices = Item::orderBy('price', 'DESC')->get();
                $orderby = "ASC";
            }


            $partialProducts = new Collection;       

                foreach($prices as $price){

                    foreach($products as $key => $product){
                        if($price->item_id == $product->item_id){
                            $partialProducts->add( $product);
                            $products->forget($key);
                        }
                    }
                }
               $products = $partialProducts;

        }
        // dd($products);
         if ($request->sort == "Solds") {
             if ($request->order == "ASC" || $request->order == null) {
                $solds = DB::table('orderline')
                ->selectRaw('SUM(quantity) quantity, item_id')
                ->groupBy('item_id')
                ->orderBy('quantity','ASC')->get();
                  $orderby = "DESC";
            }
            if ($request->order == "DESC") {
                $solds = DB::table('orderline')
                ->selectRaw('SUM(quantity) quantity, item_id')
                ->groupBy('item_id')
                ->orderBy('quantity','DESC')->get();
                $orderby = "ASC";
            }

            $partialProducts = new Collection;       
                $noSolds = new Collection;

                foreach($solds as $sold){

                    foreach($products as $key => $product){
                        if($sold->item_id == $product->item_id){
                            $partialProducts->add( $product);
                            $products->forget($key);
                        }
                    }

                }

                foreach($products as $product){
                    if($request->sort == "ASC"){
                    $partialProducts->prepend( $product);
                    }else{
                    $partialProducts->add( $product);
                    }
                }
               $products = $partialProducts;
         }




        $sort = $request->sort;

        $categories = Category::all()->pluck('category_name', 'category_id');
        $catSearch = $request->category;
        $search = $request->search;

        return view('shop.index',compact('products', 'brands', 'reviews', 'solds', 'categories',  'orderby', 'sort', 'searchCount', 'catSearch', 'search'));
    }



        public function showTobuy(...$info){
             if (Auth::check() && auth()->user()->is_admin == 1) {
            return redirect()->route('admin.dashboard');
        }
         if (Auth::check() && auth()->user()->is_admin == 2) {
            return redirect()->back();
        }


            
            $id = $info[0];
          
            if(isset($info[2])){
            $fromBuilder = $info[2];
            }
            else{
             $fromBuilder = null;   
            }


            $review = Review::selectRaw('AVG(review_rating) review_rating, item_id')->where('item_id',$id)->first();
            $reviews = Review::with('user')->where('item_id', $id)->get();
              $sold = DB::table('orderline')
                ->selectRaw('SUM(quantity) quantity, item_id')
                ->groupBy('item_id')->where('item_id',$id)->first();
            
           


           if($info[1] == 'processor'){  

            $processor = DB::table('processors AS k')->join('items AS i', 'i.item_id', '=', 'k.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->where('k.item_id', '=', $id)->select('*')->first();
                return view('processor.buy', compact('processor', 'review','reviews', 'sold','fromBuilder'));

           }

           if($info[1] == 'motherboard'){  

            $motherboards = DB::table('motherboards AS m')->join('items AS i', 'i.item_id', '=', 'm.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->where('m.item_id', '=', $id)->select('*')->get();
            
              // $result = file_exists( public_path() . '/src/images/products/'.$motherboards->first()->image);
              //   dd($result);
                return view('motherboard.buy', compact('motherboards', 'review','reviews', 'sold','fromBuilder'));

           }

           if($info[1] == 'memory'){  
            $memories = Item::join('brands','items.brand_id','brands.brand_id')->join('memories','items.item_id','memories.item_id')->join('stocks','items.item_id','stocks.item_id')->where('items.item_id',$id)->first();

                return view('memory.buy', compact('memories', 'review','reviews', 'sold','fromBuilder'));
           }
           if($info[1] == 'harddrive'){  
               $harddrives = DB::table('harddrives AS m')->join('items AS i', 'i.item_id', '=', 'm.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->where('m.item_id', '=', $id)->select('*')->get();
               // dd($id);
                return view('harddrive.buy', compact('harddrives', 'review','reviews', 'sold', 'fromBuilder'));
           }

           if($info[1] == 'soliddrive'){ 
           $soliddrive = DB::table('soliddrives AS k')->join('items AS i', 'i.item_id', '=', 'k.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->where('k.item_id', '=', $id)->select('*')->first();
           return view('soliddrive.buy', compact('soliddrive', 'review','reviews', 'sold', 'fromBuilder'));
            }

            if($info[1] == 'videocard'){ 
            $videocards = Item::join('brands','items.brand_id','brands.brand_id')->join('videocards','items.item_id','videocards.item_id')->join('stocks','items.item_id','stocks.item_id')->where('items.item_id',$id)->first();
            return view('videocard.buy', compact('videocards', 'review','reviews', 'sold', 'fromBuilder'));
            }

            if($info[1] == 'casing'){ 
            $casings = DB::table('casings AS c')->join('items AS i', 'i.item_id', '=', 'c.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->select('*')->where('c.item_id', '=', $id)->get();

            $case_motherboards = explode(' | ', $casings[0]->case_motherboards);
            return view('casing.buy', compact('casings', 'review', 'case_motherboards','reviews', 'sold', 'fromBuilder')); 
            }

            if($info[1] == 'powersupply'){ 
            $powersupply = DB::table('powersupplies AS c')->join('items AS i', 'i.item_id', '=', 'c.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->select('*')->where('c.item_id', '=', $id)->first();

            $protection = explode(' | ', $powersupply->protection);
             return view('powersupply.buy', compact('powersupply', 'review', 'protection','reviews', 'sold', 'fromBuilder')); 
            }
            if($info[1] == 'keyboard'){ 
               $keyboards = DB::table('keyboards AS k')->join('items AS i', 'i.item_id', '=', 'k.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->where('k.item_id', '=', $id)->select('*')->get();

               return view('keyboard.buy', compact('keyboards', 'review','reviews', 'sold','fromBuilder')); 
            }

            if($info[1] == 'mouse'){ 
             $mouses = DB::table('mouses AS m')->join('items AS i', 'i.item_id', '=', 'm.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->where('m.item_id', '=', $id)->select('*')->get();
               return view('mouse.buy', compact('mouses', 'review','reviews', 'sold','fromBuilder'));
            }

            if ($info[1] == 'monitor') {
                $monitors = Item::join('brands','items.brand_id','brands.brand_id')->join('monitors','items.item_id','monitors.item_id')->join('stocks','items.item_id','stocks.item_id')->where('items.item_id',$id)->first();
                return view('monitor.buy', compact('monitors', 'review','reviews', 'sold','fromBuilder'));
            }

            if ($info[1] == 'headphone') {
                $headphones= DB::table('headphones AS h')->join('items AS i', 'i.item_id', '=', 'h.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->where('h.item_id', '=', $id)->select('*')->get();
                 return view('headphone.buy', compact('headphones', 'review','reviews', 'sold','fromBuilder'));
            }

            if ($info[1] == 'printer') {
                $printers = DB::table('printers AS p')->join('items AS i', 'i.item_id', '=', 'p.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->where('p.item_id', '=', $id)->select('*')->get();
                $connection_interface = explode(' | ', $printers[0]->connection_interface);
                 return view('printer.buy', compact('printers', 'review', 'connection_interface','reviews', 'sold','fromBuilder'));
            }
            if ($info[1] == 'operatingsystem') {
                $operatingsystems = DB::table('operatingsystems AS o')->join('items AS i', 'i.item_id', '=', 'o.item_id')->join('stocks AS s', 's.item_id', '=', 'i.item_id')->join('brands AS b', 'b.brand_id', '=', 'i.brand_id')->join('categories AS c2', 'c2.category_id', '=', 'b.category_id')->where('o.item_id', '=', $id)->select('*')->get();
                return view('operatingsystem.buy', compact('operatingsystems', 'review','reviews', 'sold','fromBuilder'));
            }

        }
    public static function getAddToCart(Request $request, $id){
     if (Auth::check() == false) {
        return redirect()->route('user.signin');
    }

    if (auth()->user()->is_admin == 1 || auth()->user()->is_admin == 2) {
        return redirect()->back();
    }

     $item = Item::with('stock')->find($id);

     
    
     if(!is_numeric($request->quantity)){
        return redirect()->back()->with('success', 'Invalid quantity Input');
     }
     elseif($request->quantity > $item->stock->quantity ){
        return redirect()->back()->with('success', 'Insufficient stock');
     }


        // dd($request->quantity);       
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($item, $item->item_id, $request->quantity);

        $request->session()->put('cart',$cart);
        return redirect()->route('product.shoppingCart');
    }

        public function getCart() { 
        if (!Session::has('cart')) {
        return view('shop.shopping-cart');
        }
        $oldCart = Session::get('cart'); 
        $cart = new Cart($oldCart);
        $brands = Brand::with('category')->with('items')->get();

        return view('shop.shopping-cart', ['brands'=>$brands, 'products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
       }

       public function getReduceByOne($id) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null; 
        $cart = new Cart($oldCart); 
        $cart->reduceByOne($id);
        
        if (count($cart->items) > 0) {
            Session::put('cart', $cart); 
        } else {
            Session::forget('cart'); 
        }
        return redirect('user/shopping-cart');
    }


      public function getAddByOne($id) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null; 
        $cart = new Cart($oldCart); 
        $cart->addByOne($id);
        
        if (count($cart->items) > 0) {
            Session::put('cart', $cart); 
        } else {
            Session::forget('cart'); 
        }
        return redirect('user/shopping-cart');
    }



    public function getRemoveItem($id) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null; 
        $cart = new Cart($oldCart); 
        $cart->removeItem($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart); 
        } else {
            Session::forget('cart');
        }    
        
        return redirect('user/shopping-cart');
}


 public function postCheckout(Request $request){

        if (!Session::has('cart')) {
            return redirect()->route('product.shoppingCart');
        }
        $oldCart = Session::get('cart');
        // dd(Session::get('cart'));
        $cart = new Cart($oldCart);
       // dd($cart);
          // try {
          //   DB::beginTransaction();
             //dd($order);
        date_default_timezone_set('Asia/Manila');
            $order = new Order;
            $order->date_placed = date("Y-m-d H:i:s",time());
            $order->code = uniqid();
            //dd($order);
            $order->status = "New Order";
            $customer =  Customer::where('user_id',Auth::id())->first();
            

         // dd($customer->orders);
            // dd($cart->items);
            // dd($customer);

        $customer->orders()->save($order);

        
            // dd($customer);
        foreach($cart->items as $items){
          // dump($items);
          $id = $items['item']['item_id'];
          //dd($items['qty']);

          $order->items()->attach($id,['quantity'=>$items['qty'], 'is_reviewed' => '0']);
           
           //dd($items['qty']);
          // dd($id);
          $stock = Stock::find($id);
         

          $stock->quantity = $stock->quantity - $items['qty'];


          //dd($stock->quantity);
          $stock->save();
          }
        // }
        // catch (\Exception $e) {
        //   // dd($e);
        //    DB::rollback();
        //     return redirect()->route('checkout')->with('error', $e->getMessage());
        // }
        // DB::commit();
        Session::forget('cart');
        //session_destroy();
        //return redirect()->back();
        return redirect()->route('user.profile')->with('success','Successfully Purchased Your Products!!!');
    }

     public function getCancel($order_id){
        $order = Order::with('items')->where('orderinfo_id',$order_id)->first();
        return view('shop.cancel', compact('order'));
     }

      public function postCancel(Request $request){
        
           $order = DB::table('orderinfo')
           ->where('orderinfo_id', $request->orderinfo_id) 
           ->update([
            'status' => 'Dispute'
           ]);

           $message = new Message;    
           $message->message_content = $request->message_content;
           date_default_timezone_set('Asia/Manila');
           $message->message_title = "Request for cancellation of order: ".$request->code;
           $message->message_date = date("Y-m-d H:i:s",time());
           $message->message_label = "Cancel";
           $message->user_id = auth()->user()->user_id;
           $message->orderinfo_id = $request->orderinfo_id;
           $message->save();
           return Redirect::route('user.profile')->with('success', 'Request for cancellation submitted successfully');
       
     }


    public function getContact($order_id){
        $order = Order::with('items')->where('orderinfo_id',$order_id)->first();
        return view('shop.contact', compact('order'));
     }

      public function postContact(Request $request){
        
           $order = DB::table('orderinfo')
           ->where('orderinfo_id', $request->orderinfo_id) 
           ->first();
          

           $message = new Message;    
           $message->message_content = $request->message_content;
           date_default_timezone_set('Asia/Manila');
           $message->message_title = "Inquiry for order: ".$order->code ;
           $message->message_date = date("Y-m-d H:i:s",time());
           $message->message_label = "Contact";
           $message->user_id = auth()->user()->user_id;
           $message->orderinfo_id = $request->orderinfo_id;
           $message->save();
           return Redirect::route('user.profile')->with('success', 'Inquiry submitted successfully');
       
     }




     public function getReview(...$ids){
        $order_id = $ids[0];
        $item_id = $ids[1];
        $order = Order::with('items')->where('orderinfo_id',$order_id)->first();
        // dd($order);
        return view('shop.review', compact('order', 'item_id'));
     }

  
     public function postReview(Request $request){
         $validator = $this->validator($request);
         if ($validator->passes()) {
           $orderline = DB::table('orderline')
           ->where('orderinfo_id', $request->orderinfo_id) 
           ->where('item_id', $request->item_id)
           ->update([
            'is_reviewed' => '1'
           ]);

           $review = new Review;    
           $review->review_content = $request->review_content;
           $review->review_rating = $request->rating;
           date_default_timezone_set('Asia/Manila');
           $review->review_date = date("Y-m-d H:i:s",time());
           $review->item_id = $request->item_id;
           $review->user_id = auth()->user()->user_id;
           $review->save();
        return Redirect::route('user.profile')->with('success', 'Review submit successfully');
        }
        else {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        // $orderline = DB::table('orderline')
        // return view('shop.review', compact('order', 'item_id'));
     }
}
