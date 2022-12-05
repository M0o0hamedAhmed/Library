<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    //
    public function index()
    {
        //  call the model to fetch all author
        $authors = Author::select('id', 'name')
            // ->where('id', '>', 9)
            ->orderBy('id')
            // ->take(10)
            ->get();
        return view('authors/index', ['authors' => $authors]);
        // dd($authors) ;

    }

    public function latest()
    {
        //  The last three authors
        $latest = Author::query()->orderBy('id', 'DESC')->take(3)->get();
        return view('authors/latest', ['authors' => $latest]);
    }

    public function paginate()
    {
        $authorsPaginate = Author::paginate(3);
        $user = User::query()->get() ;
        return view('authors/paginate', ['authorsPaginate' => $authorsPaginate,'user' =>  $user]);

    }

    public function show($id)
    {
        // $author = Author::where('id','=',$id)->first() ;
        $author = Author::find($id);
        // dd($author) ;
        return view('authors/show', ['author' => $author]);
    }


    public function search($word)
    {
        // $author = Author::where('id','=',$id)->first() ;
        $searchReasult = Author::Where('name', 'like', "%$word%")->get();
        // dd($searchReasult) ;
        return view('authors/search', ['searchReasult' => $searchReasult]);
    }
    public function create()
    {
        return view('authors/create');
    }

    public function  store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3',
            'bio' => 'required|string',
            'img' => 'required|image|mimes:jpg,jpej,png'
        ]);

        $img = $request->img;
        $ext = $img->getClientOriginalExtension();
        $name = "author-" . uniqid() . ".$ext";
        $img->move(public_path('uploads'), $name);
        Author::create([
            'name' => $request->name,
            'bio' => $request->bio,
            'img' => $name

        ]);
        return redirect(route('authors.paginateAuthors'));
    }

    public function edit($id)
    {
        $author = Author::find($id);
        return view('authors.edit', ['author' => $author]);


    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|min:3',
            'bio' => 'required|string',
            'img' => 'nullable|image|mimes:jpg,jpeg,png'
        ]);

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
            $author = Author::find($id)->update([
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




        // $author = Author::find($id)->update([
        //     'name' => $request->name,
        //     'bio' => $request->bio,
        //     'img' => $name
        // ]);


        // return redirect( route('authors.showAuthors',$request->id)) ;
        return back();
    }

    public function delete($id)
    {
        $author = Author::find($id);
        $name = $author->img;
      // unlink(public_path("uploads/$name")) ;
        // unlink(asset("uploads/$name")) ;
        $author->delete();

        return back();
    }
}
