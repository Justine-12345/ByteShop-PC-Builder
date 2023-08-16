<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        if($request->has('search') || $request->search != null){
            $users = User::where('user_id','!=',auth()->user()->user_id)
            ->where('name','LIKE','%'.$request->search.'%')
            ->orWhere('email','LIKE','%'.$request->search.'%')
            ->orWhere('user_id',$request->search)
            ->groupBy('name','email','user_id')
            ->paginate(10);
             $oldOrder = "user_id";
             $oldArrangement = "ASC";
             $oldStatus = "All";
             return view('user.index', compact('users', 'oldStatus', 'oldOrder', 'oldArrangement'));
        }





        $holdStatus = "";
        $holdOrder = "";
        $holdArrangement = "";


        if($request->status == null && $request->status == ""){
            if($request->oldStatus != null && $request->oldStatus != ""){
             $holdStatus = $request->oldStatus;
            }
            else{
             $holdStatus = "All";   
            }
        }
        else{
          $holdStatus = $request->status;  
        }


        if($request->order == null && $request->order == ""){
            if($request->oldOrder != null && $request->oldOrder != ""){
             $holdOrder = $request->oldOrder;
            }
            else{
             $holdOrder = "user_id";   
            }
        }
        else{
          $holdOrder = $request->order;  
        }

       

        if($request->arrangement == null && $request->arrangement == ""){
          if($request->oldArrangement != null && $request->oldArrangement != ""){
             $holdArrangement = $request->oldArrangement;
            }
            else{
             $holdArrangement = "ASC";   
            }
        }
        else{
          $holdArrangement = $request->arrangement;  
        }


        if($holdStatus == "All"){
        $users = User::whereNotNull('user_id')->where('user_id','!=',auth()->user()->user_id)
        ->orderBy($holdOrder,$holdArrangement)
        ->paginate(10);
        }
        else{
        $users = User::whereNotNull('user_id')->where('user_id','!=',auth()->user()->user_id)
        ->where('is_admin', $holdStatus)
        ->orderBy($holdOrder,$holdArrangement)
        ->paginate(10);
        }

        
        $oldOrder = $holdOrder;
        $oldArrangement = $holdArrangement;
        $oldStatus = $holdStatus;
        return view('user.index', compact('users', 'oldStatus', 'oldOrder', 'oldArrangement'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user = User::with('customer')->where('user_id',$id )->first();
        return view('user.show', compact('user'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //

        $user = User::where('user_id', $id)->first();

        $user->is_admin = $request->is_admin;
        $user->save();

        $newRole = "";

        if ($request->is_admin == 0) {
           $newRole = "Customer";
        }
        if ($request->is_admin == 1) {
           $newRole = "Admin";
        }
        if ($request->is_admin == 2) {
           $newRole = "Rider";
        }


        return redirect()->route('useradmin.index')->with('success', ucwords($user->name).' is now a '.$newRole);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
