<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use Validator;
use Redirect;
use DB;

class BrandController extends Controller
{
    protected function validator(Request $request) {
        $rules = [
            'brand_name' => 'required',
            'category_id' => 'required'
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = DB::table('brands AS b')->join('categories AS c', 'c.category_id', '=', 'b.category_id')->select('*')->get();
        // dd($brands);

        return view('brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('brand.add', compact('categories'));
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
            $inputs = $request->all();

            $brands = new Brand();
            $brands->brand_name = $inputs['brand_name'];
            $brands->category_id = $inputs['category_id'];
            $brands->save();

            return Redirect::route('brand.index')->with('success','New Brand added!');
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
        $brands = DB::table('brands AS b')->join('categories AS c', 'c.category_id', '=', 'b.category_id')->where('brand_id', '=', $id)->select('*')->get();
        // dd($categories);

        return view('brand.show', compact('brands'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brands = DB::table('brands')->where('brand_id', '=', $id)->select('*')->get();
        $categories = Category::all();

        return view('brand.edit', compact('brands', 'categories'));
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
        // dd($request->all());

        $validator = $this->validator($request);

        //for validating if all fields passes
        if ($validator->passes()) {
            DB::table('brands')->where('brand_id', '=', $id)->update(['brand_name' => $request->brand_name, 'category_id' => $request->category_id]);

            return Redirect::route('brand.index')->with('success','Brand updated!');
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
        DB::table('brands')->where('brand_id', '=', $id)->delete();

        return Redirect::route('brand.index')->with('success','Brand deleted!');
    }
}
