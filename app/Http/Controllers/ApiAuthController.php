<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function GuzzleHttp\Promise\all;

class ApiAuthController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }

    public function index() {
        $author = Author::with('Books')->get() ;

        return response()->json($author) ;
    }

    public function show($id){
//        $author = Author::find($id) ;
        $author = Author::with('Books')->find($id) ;
        return response()->json($author) ;
    }

    public function store(Request $request) {

        // Validation
        $validator = validator::make($request->all(),[
            'name' => 'required|string|min:3',
            'bio' => 'required|string',
            'img' => 'nullable|image|mimes:jpg,jpeg,png'
        ]) ;
        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ]) ;
        }


        $img = $request->img;
        $ext = $img->getClientOriginalExtension();
        $name = "author-" . uniqid() . ".$ext";
        $img->move(public_path('uploads'), $name);
        $author = Author::create([
            'name' => $request->name,
            'bio' => $request->bio,
            'img' => $name,


        ]);
        return response()->json([
            'success' => "success Creat" ,
            'author' =>  $author
            //            'author' =>  AutherResource::make($author)
        ]) ;
    }

    public function  update($id,Request $request) {
        $author = Author::find($id);
        $oldName = $author->img ;


        $img = $request->img;
        // if($img !==null){
        if($request->hasFile('img')){
            $ext = $img->getClientOriginalExtension();
            $name = "author-" . uniqid() . ".$ext";
            $img->move(public_path('uploads'), $name);
            if($author->img ){
                unlink(public_path("uploads/$oldName")) ; // Delete img
            } ;
            $author = Author::query()->find($id)->update([
                'name' => $request->name,
                'bio' => $request->bio,
                'img' => $name
            ]);

        }elseif($img === null) {
            $author = Author::find($id)->update([
                'name' => $request->name,
                'bio' => $request->bio,
            ]);

        }

        return response()->json([
            'success' => 'author update success' ,
            'author'  => $author
        ]) ;

    }

    public  function  delete($id){
        $author = Author::find($id);
        $name = $author->img;
        // unlink(public_path("uploads/$name")) ;
        // unlink(asset("uploads/$name")) ;
        $author->delete();

        return response()->json([
            'success' => 'Delete Done'
        ]);
    }
}
