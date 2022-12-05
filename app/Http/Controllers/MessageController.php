<?php


namespace App\Http\Controllers;
use App\Models\Message;
use Illuminate\Http\Request;


class MessageController extends Controller
{
    //

    public function send(Request $request){

       $data = $request->validate([
            'name' => 'required|string|max:100' ,
            'msg'  => 'required|string'
        ]) ;
       Message::create($data) ;

       return response()->json([
          'success'  => 'your message sent successfully'
       ]);

    }
}
