<?php

use Illuminate\Support\Facades\Route;
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
use App\Models\Item;
use App\Models\Build;
use App\Http\Controllers\BuilderController;
use App\Http\Controllers\MessageCustomerController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     // return view('welcome');
//   //  $brand = Brand::find(1);
// // dd($brand);
//    // dd($brand->category->category_id);
// //dd(Category::with('brands')->get());

//    // $items = Item::with('motherboard')->get();

//    // foreach ($items as $item) {
     
//    //    if (! $item->motherboard == null) {
//    //       dump($item->motherboard->cpu_socket);
//    //    }
//    // }

// // dd(Item::with('build_printer')->get());
//    //return view('shop.builder');
//    $videocard = Videocard::with('item')
//       ->join('stocks','stocks.item_id','videocards.item_id')
//       ->first();
// dd($videocard->quantity);
// });


// Route::get('/', function () {
//    //return view('shop.builder');
//     $processors = Processor::with('item')->get();
//   //  dd($processors);
//    return view('bushop.ildOption');
// });


// Route::get('/', [
//      'uses' => 'ProductController@getIndex',
//      'as' => 'product.index'
//     ]);

      Route::get('/', [
     'uses' => 'ProductController@getIndex',
     'as' => 'product.index',
     'middleware' =>'home'
    ]);

      Route::get('/showTobuy/{item_id}/{category}/{fromBuilder?}', [
     'uses' => 'ProductController@showTobuy',
     'as' => 'product.showTobuy',
     'middleware' =>'home'
    ]);


Route::group(['prefix' => 'user'], function(){

   Route::group(['middleware' => 'guest'], function() {
        Route::get('signup', [
        'uses' => 'UserController@getSignup',
        'as' => 'user.signup',
            ]);
        
        Route::post('signup', [
                'uses' => 'UserController@postSignup',
                'as' => 'user.signup',
           ]);
        Route::get('signin', [
                'uses' => 'UserController@getSignin',
                'as' => 'user.signin',
            ]);
        Route::post('signin', [
                'uses' => 'UserController@postSignin',
                'as' => 'user.signin',
         ]);

         Route::get('forget_password', [
                'uses' => 'UserController@forgetPassword',
                'as' => 'forget.password',
            ]);

         Route::get('validate_email', [
                'uses' => 'UserController@validateEmail',
                'as' => 'validate.email',
            ]);

         Route::get('/confirm_password/{token?}/{email?}', function($token = " " , $email = " "){
         $data['token'] = $token;
         $data['email'] = $email;
         return View::make('password_reset',$data);
        });

       Route::post('/resetPassword',['uses' => 'UserController@resetPassword' , 'as'=>'resetPassword']);


    });

     


      Route::get('shopping-cart', [
       'uses' => 'ProductController@getCart',
       'as' => 'product.shoppingCart',
       'middleware' =>'admin:0'
       ]);


       Route::get('add-to-cart/{id}',[
           'uses' => 'productController@getAddToCart',
           'as' => 'product.addToCart'
       ]);

       Route::get('checkout',[
           'uses' => 'productController@postCheckout',
           'as' => 'checkout',
           'middleware' =>'admin:0'
       ]);


        Route::get('cancel/{order_id}/', [
       'uses' => 'ProductController@getCancel',
       'as' => 'product.getCancel',
       'middleware' =>'admin:0'
       ]);

          Route::post('cancel/', [
       'uses' => 'ProductController@postCancel',
       'as' => 'product.postCancel',
       'middleware' =>'admin:0'
       ]);



        Route::get('contact/{order_id}/', [
       'uses' => 'ProductController@getContact',
       'as' => 'product.getContact',
       'middleware' =>'admin:0'
       ]);

          Route::post('contact/', [
       'uses' => 'ProductController@postContact',
       'as' => 'product.postContact',
       'middleware' =>'admin:0'
       ]);



        Route::get('review/{order_id}/{item_id}', [
       'uses' => 'ProductController@getReview',
       'as' => 'product.getReview',
       'middleware' =>'admin:0'
       ]);

        Route::post('review/', [
       'uses' => 'ProductController@postReview',
       'as' => 'product.postReview',
       'middleware' =>'admin:0'
       ]);


      Route::get('remove/{id}',[
           'uses'=>'productController@getRemoveItem',
           'as' => 'product.remove'
       ]);
       Route::get('/reduce/{id}', [
       'uses' => 'ProductController@getReduceByOne',
       'as' => 'product.reduceByOne'
      ]);

 Route::get('/add/{id}', [
       'uses' => 'ProductController@getAddByOne',
       'as' => 'product.addByOne'
      ]);


Route::group(['middleware' => 'admin:0,1,2'], function() {
   Route::get('logout', [
              'uses' => 'userController@getLogout',
              'as' => 'user.logout',
              ]);
   
   Route::get('/edit/{id}', [
              'uses' => 'userController@edit',
              'as' => 'user.edit',
              ]);

   Route::post('update', [
              'uses' => 'userController@update',
              'as' => 'user.update',
              ]);

   Route::get('/profile/show/{id}', [
              'uses' => 'UserController@profileShow',
              'as' => 'profile.show',
              ]);
 });

   Route::group(['middleware' => 'admin:0'], function() {
      Route::get('profile', [
        'uses' => 'userController@getProfile',
        'as' => 'user.profile',
      ]);
   

   });


    Route::group(['middleware' => 'admin:1'], function() {
        Route::post('/search',['uses' => 'SearchController@search','as' => 'search'] );

     Route::resource('motherboard', 'MotherboardController');
     Route::resource('harddrive', 'HarddriveController');
     Route::resource('operatingsystem','OperatingsystemController');

     Route::resource('videocard','VideocardController');
     Route::resource('monitor','MonitorController');
     Route::resource('memory','MemoryController');

     Route::resource('mouse','MouseController');
     Route::resource('printer','PrinterController');
     Route::resource('headphone','HeadphoneController');

     Route::resource('casing','CasingController');
     Route::resource('category','CategoryController');
     Route::resource('brand','BrandController');
     Route::resource('keyboard','KeyboardController');


     Route::resource('powersupply','PowersupplyController');
     Route::resource('processor','ProcessorController');
     Route::resource('soliddrive','SoliddriveController');

     Route::resource('item','ItemController');

     
     
     Route::resource('messageadmin','MessageAdminController');
     Route::get('dashboard', ['uses'=>'DashboardController@index','as'=>'admin.dashboard']);
     Route::get('backup', ['uses'=>'DashboardController@backup','as'=>'admin.backup']);
     Route::resource('useradmin','UserAdminController');
   });


    Route::group(['middleware' => 'admin:1,2'], function() {
    Route::resource('order','OrderController');
    Route::post('order/updateStatus/{id}', ['uses'=>'OrderController@updateStatus','as'=>'order.updateStatus']);
        });

//FOR BUILDER
Route::get('pc/builder/', ['uses'=>'BuilderController@getBuilder','as'=>'pc.builder']);

Route::group(['middleware' => 'admin:1,0'], function() {
Route::get('pc/option/', ['uses'=>'BuilderController@getBuilderOption','as'=>'pc.builderOption']);
Route::get('pc/show/{id}', ['uses'=>'BuilderController@getShow','as'=>'pc.show']);


Route::get('pc/add_processor/{item_id}', ['uses'=>'BuilderController@getProcessor','as'=>'pc.processor']);
Route::get('pc/add_motherboard/{item_id}', ['uses'=>'BuilderController@getMotherboard','as'=>'pc.motherboard']);

Route::get('pc/add_memory/{item_id}', ['uses'=>'BuilderController@getMemory','as'=>'pc.memory']);
Route::get('pc/add_harddrive/{item_id}', ['uses'=>'BuilderController@getHarddrive','as'=>'pc.harddrive']);
Route::get('pc/add_soliddrive/{item_id}', ['uses'=>'BuilderController@getSoliddrive','as'=>'pc.soliddrive']);
Route::get('pc/add_videocard/{item_id}', ['uses'=>'BuilderController@getVideocard','as'=>'pc.videocard']);
Route::get('pc/add_casing/{item_id}', ['uses'=>'BuilderController@getCasing','as'=>'pc.casing']);
Route::get('pc/add_powersupply/{item_id}', ['uses'=>'BuilderController@getPowersupply','as'=>'pc.powersupply']);
Route::get('pc/add_keyboard/{item_id}', ['uses'=>'BuilderController@getKeyboard','as'=>'pc.keyboard']);
Route::get('pc/add_mouse/{item_id}', ['uses'=>'BuilderController@getMouse','as'=>'pc.mouse']);
Route::get('pc/add_monitor/{item_id}', ['uses'=>'BuilderController@getMonitor','as'=>'pc.monitor']);
Route::get('pc/add_headphone/{item_id}', ['uses'=>'BuilderController@getHeadphone','as'=>'pc.headphone']);
Route::get('pc/add_printer/{item_id}', ['uses'=>'BuilderController@getPrinter','as'=>'pc.printer']);

Route::get('pc/add_operatingsystem/{item_id}', ['uses'=>'BuilderController@getOperatingsystem','as'=>'pc.operatingsystem']);


Route::get('pc/back/{prevCategory}', ['uses'=>'BuilderController@getBack','as'=>'pc.back']);
Route::get('pc/skip/{category}', ['uses'=>'BuilderController@getSkip','as'=>'pc.skip']);
Route::get('pc/finish/', ['uses'=>'BuilderController@getFinish','as'=>'pc.finish']);
Route::get('pc/addToCart/', ['uses'=>'BuilderController@getAddToCart','as'=>'pc.addToCart']);
Route::get('pc/save/', ['uses'=>'BuilderController@getSave','as'=>'pc.getSave']);
Route::get('pc/new/', ['uses'=>'BuilderController@getNew','as'=>'pc.getNew']);
Route::get('pc/prebuilt/', ['uses'=>'BuilderController@getPrebuilt','as'=>'pc.getPrebuilt']);
Route::post('pc/new/', ['uses'=>'BuilderController@postNew','as'=>'pc.postNew']);
Route::get('pc/delete/{id}', ['uses'=>'BuilderController@getDelete','as'=>'pc.getDelete']);
 Route::resource('messagecustomer','MessageCustomerController');
});


});