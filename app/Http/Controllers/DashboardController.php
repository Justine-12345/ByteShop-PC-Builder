<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Item;
use App\Models\User;
use App\Charts\MonthlyItemSoldChart;
use App\Charts\MonthlySalesChart;
use App\Charts\MonthlyUsersChart;
use App\Charts\BestSellerChart;
use DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use File;

class DashboardController extends Controller
{
    //
    public function backup(){
         
        Artisan::call('backup:run --only-db');

            $files = File::files(storage_path('app\ByteShop\\'));
            


            foreach ($files as $key => $value) {

                 if($key == count($files) - 1){
                $relativeNameInZipFile = basename($value);
                return Response::download(storage_path().'\app\ByteShop\\'.$relativeNameInZipFile);
                }
                
            }
             

        
        
    }

    public function index(){


        $productSold_months = Order::join('orderline', 'orderline.orderinfo_id', 'orderinfo.orderinfo_id')
        ->where('status','Completed')
        ->selectRaw('SUM(quantity) as sold, month(date_shipped) as month,  year(date_shipped) as year')
        ->groupBy('year','month')
        ->get();

        $productSold_month = null;
        foreach ($productSold_months as $months) {
            if($months->month == date('m') && $months->year == date('Y')){
                $productSold_month = $months;
            } 
        }

          $productSold_months_forChart = Order::join('orderline', 'orderline.orderinfo_id', 'orderinfo.orderinfo_id')
        ->where('status','Completed')
        ->selectRaw('SUM(quantity) as sold,month(date_shipped) as monthInNum ,  MONTHNAME(date_shipped) as month,  year(date_shipped) as year')
        ->groupBy('year','month')
        ->orderBy('monthInNum','ASC')
        ->limit(12)
        ->pluck('month','sold')->all();
if($productSold_months_forChart != null){  
      $productSold_months_chart = new MonthlyItemSoldChart;
     // dd(array_keys($customer));
      $dataset = $productSold_months_chart->labels(array_values($productSold_months_forChart));
        // dd($dataset);
        $dataset= $productSold_months_chart->dataset('Monthly Item Sold -' .$productSold_month->year, 'line', array_keys($productSold_months_forChart));
        $dataset= $dataset->backgroundColor(collect(['#5255e7']));
        $productSold_months_chart->options([
            'responsive' => true,
            'legend' => ['display' => true],
            'tooltips' => ['enabled'=>true],
            // 'maintainAspectRatio' =>true,
            // 'title' => 'test',
            'aspectRatio' => 1,
            'scales' => [
                'yAxes'=> [[
                             'display'=>true,
                            'ticks'=> ['beginAtZero'=> true],
                            'gridLines'=> ['display'=> false],
                            'ticks' => [
                            'beginAtZero' => true,
                            ]
                          ]],
                'xAxes'=> [[
                            'categoryPercentage'=> 0.8,
                            //'barThickness' => 100,
                            'barPercentage' => 1,
                            'ticks' => ['beginAtZero' => false],
                            'gridLines' => ['display' => false],
                            'display' => true
                          ]],
            ],
        ]);
}





        // PRODUCT SALE MONTHLY
        $productSales_month= Order::join('orderline', 'orderline.orderinfo_id', 'orderinfo.orderinfo_id')
        ->join('items','items.item_id','orderline.item_id')
        ->where('status','Completed')
        ->selectRaw('SUM(quantity*price) as sales, month(date_shipped) as month,  year(date_shipped) as year')
        ->groupBy('year','month')
        ->get();

        $productSales_month_forChart= Order::join('orderline', 'orderline.orderinfo_id', 'orderinfo.orderinfo_id')
        ->join('items','items.item_id','orderline.item_id')
        ->where('status','Completed')
        ->selectRaw('SUM(quantity*price) as sales, month(date_shipped) as monthInNum ,  MONTHNAME(date_shipped) as month,  year(date_shipped) as year')
        ->orderBy('monthInNum','ASC')
        ->groupBy('year','month')
        ->limit(12)
        ->pluck('month','sales')->all();


  
        $productSale_month = null;
        foreach ($productSales_month as $months) {
            if($months->month == date('m') && $months->year == date('Y')){
                $productSale_month = $months;
            }
        }
if($productSales_month_forChart != null){
      $productSales_month_chart = new MonthlySalesChart;
     // dd(array_keys($customer));
      $dataset = $productSales_month_chart->labels(array_values($productSales_month_forChart));
        // dd($dataset);
        $dataset= $productSales_month_chart->dataset('Monthly sales -' .$productSale_month->year, 'bar', array_keys($productSales_month_forChart));
        $dataset= $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
        $productSales_month_chart->options([
            'responsive' => true,
            'legend' => ['display' => true],
            'tooltips' => ['enabled'=>true],
            // 'maintainAspectRatio' =>true,
            // 'title' => 'test',
            'aspectRatio' => 1,
            'scales' => [
                'yAxes'=> [[
                             'display'=>true,
                            'ticks'=> ['beginAtZero'=> true],
                            'gridLines'=> ['display'=> false],
                            'ticks' => [
                            'beginAtZero' => true,
                            ]
                          ]],
                'xAxes'=> [[
                            'categoryPercentage'=> 0.8,
                            //'barThickness' => 100,
                            'barPercentage' => 1,
                            'ticks' => ['beginAtZero' => false],
                            'gridLines' => ['display' => false],
                            'display' => true
                          ]],
            ],
        ]);
}


        $users_month= User::where('is_admin',0)
        ->selectRaw('COUNT(user_id) as users, month(created_at) as month,  year(created_at) as year')
        ->groupBy('year','month')
        ->get();

        $users_month_forChart = User::where('is_admin',0)
        ->selectRaw('COUNT(user_id) as users,  month(created_at) as monthInNum ,  MONTHNAME(created_at) as month,  year(created_at) as year')
        ->orderBy('monthInNum','ASC')
        ->groupBy('year','month')
        ->limit(12)
        ->pluck('month','users')->all();

        $user_month = null;
        foreach ($users_month as $months) {
            if($months->month == date('m') && $months->year == date('Y')){
                $user_month = $months;
            }
        }

if($users_month_forChart != null){
        $users_month_chart = new MonthlyUsersChart;
     // dd(array_keys($customer));
      $dataset = $users_month_chart->labels(array_values($users_month_forChart));
        // dd($dataset);
        $dataset= $users_month_chart->dataset('Monthly New Users', 'horizontalBar', array_keys($users_month_forChart));
        $dataset= $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
        $users_month_chart->options([
            'responsive' => true,
            'legend' => ['display' => true],
            'tooltips' => ['enabled'=>true,],
            // 'maintainAspectRatio' =>true,
            // 'title' => 'test',
            'aspectRatio' => 1,
            'scales' => [
                'yAxes'=> [[
                             'display'=>true,
                            'ticks'=> ['beginAtZero'=> true],
                            'gridLines'=> ['display'=> false],
                            'ticks' => [
                            'beginAtZero' => true,
                            ]
                          ]],
                'xAxes'=> [[
                            'categoryPercentage'=> 0.8,
                            //'barThickness' => 100,
                            'barPercentage' => 1,
                            'ticks' => ['beginAtZero' => false],
                            'gridLines' => ['display' => false],
                            'display' => true
                          ]],
            ],
        ]);

}

         $bestSeller_forChart = Order::join('orderline', 'orderline.orderinfo_id', 'orderinfo.orderinfo_id')
        ->join('items','items.item_id','orderline.item_id')
        ->where('status','Completed')
        ->selectRaw('title , items.item_id, SUM(orderline.quantity)  as quantity')
        ->groupBy('items.item_id')
        ->orderBy('quantity', 'DESC')
        ->limit(20)
        ->pluck('title',DB::raw('quantity'))->all();

if($bestSeller_forChart != null){
           $bestSeller_Chart = new BestSellerChart;
     // dd(array_keys($customer));
      $dataset = $bestSeller_Chart->labels(array_values($bestSeller_forChart));
        // dd($dataset);
        $dataset= $bestSeller_Chart->dataset('Best Seller Items', 'doughnut', array_keys($bestSeller_forChart));
        $dataset= $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
        $bestSeller_Chart->options([
            'responsive' => true,
            'legend' => ['display' => true],
            'tooltips' => ['enabled'=>true,],
            // 'maintainAspectRatio' =>true,
            // 'title' => 'test',
            'aspectRatio' => 1,
            'scales' => [
                'yAxes'=> [[
                             'display'=>true,
                            'ticks'=> ['beginAtZero'=> true],
                            'gridLines'=> ['display'=> false],
                            'ticks' => [
                            'beginAtZero' => true,
                            ]
                          ]],
                'xAxes'=> [[
                            'categoryPercentage'=> 0.8,
                            //'barThickness' => 100,
                            'barPercentage' => 1,
                            'ticks' => ['beginAtZero' => false],
                            'gridLines' => ['display' => false],
                            'display' => true
                          ]],
            ],
        ]);
}

        // $productSales_month_chart = "";
        // $productSold_months_chart = "";
        // $users_month_chart = "";
        // $bestSeller_Chart = "";
        return view('admin.index', compact('productSold_month','productSale_month','user_month','productSold_months_chart', 'productSales_month_chart', 'users_month_chart', 'bestSeller_Chart'));
    }
}
