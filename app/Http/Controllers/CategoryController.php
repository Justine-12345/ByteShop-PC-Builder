<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Validator;
use Redirect;
use DB;

class CategoryController extends Controller
{
    protected function validator(Request $request) {
        $rules = [
            'category_name' => 'required'
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
        $categories = Category::all();
        // dd($categories);

        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.add');
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

            $categories = new Category();
            $categories->category_name = $inputs['category_name'];
            $categories->save();

            return Redirect::route('category.index')->with('success','New Category added!');
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
        $categories = DB::table('categories')->where('category_id', '=', $id)->select('*')->get();
        // dd($categories);

        return view('category.show', compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = DB::table('categories')->where('category_id', '=', $id)->select('*')->get();

        return view('category.edit', compact('categories'));
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
            DB::table('categories')->where('category_id', '=', $id)->update(['category_name' => $request->category_name]);

            return Redirect::route('category.index')->with('success','Category updated!');
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
        DB::table('categories')->where('category_id', '=', $id)->delete();

        return Redirect::route('category.index')->with('success','Category deleted!');
    }
}
