<?php
namespace App;
use App\Models\Message;
use App\Models\Category;
use Auth;
/**
 * 
 */
class Notification
{   

    public static function categories(){
        $categories = Category::all();
        return $categories;
    }


    public static function messagesToUser(){
        $i = 0;
        if (Auth::check()) {
              $messages = Message::with('user')
        ->where('is_seen', null)
        ->where('to_user', auth()->user()->user_id)
        ->get();
        

        foreach ($messages as $message) {
            ++$i;
        }
        
        if ($i > 9) {
            $i = "9+";
        }
        return $i;
        }
      
        
    }



    public static function messages($limit = 1){
        $messages = Message::with('user')->limit($limit)
        ->where('is_seen', null)
        ->where('to_user', null)
        ->orderBy('message_id','DESC')
        ->get();
        return $messages;
        
    }


    public static function messagesUnseen(){
         $messages = Message::with('user')
        ->where('is_seen', null)
        ->where('to_user', null)
        ->orderBy('message_id','DESC')
        ->get();
        $i = 0;

        foreach ($messages as $message) {
            ++$i;
        }
        
        if ($i > 9) {
            $i = "9+";
        }
        return $i;
        
    }


}