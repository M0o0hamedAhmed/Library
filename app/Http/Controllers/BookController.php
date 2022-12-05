<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;

class BookController extends Controller
{
    //

//    public function index()
//    {
//        //  call the model to fetch all Book
//        $Books = Book::select('id', 'name')
//            // ->where('id', '>', 9)
//            ->orderBy('id')
//            // ->take(10)
//            ->get();
//        return view('Books/index', ['Books' => $Books]);
//        // dd($Books) ;
//
//    }
//
//    public function latest()
//    {
//        //  The last three Books
//        $latest = Book::orderBy('id', 'DESC')->take(3)->get();
//        return view('Books/latest', ['Books' => $latest]);
//    }
//
    public function paginate()
    {
        $authors = Author::query()->get() ;
        $BooksPaginate = Book::query()->paginate(3);

//        return response()->json($BooksPaginate);

        return view('books/paginate', ['BooksPaginate' => $BooksPaginate,'authors' => $authors]);
    }
//

    public function show($id)
    {
        // $Book = Book::where('id','=',$id)->first() ;
        $Book = Book::find($id);
        // dd($Book) ;
        return view('Books/show', ['book' => $Book]);
    }

//
//
//    public function search($word)
//    {
//        // $Book = Book::where('id','=',$id)->first() ;
//        $searchReasult = Book::Where('name', 'like', "%$word%")->get();
//        // dd($searchReasult) ;
//        return view('Books/search', ['searchReasult' => $searchReasult]);
//    }
    public function create()
    {
        $authors = Author::query()->get() ;

        return view('Books/create',['authors' =>$authors]);
    }
//
    public function  store(Request $request)
    {


        $request->validate([
            'name' => 'required|string|min:3',
            'desc' => 'required|string',
            'img' => 'required|image|mimes:jpg,jpeg,png' ,
            'price' => 'required|numeric|max:999999.99',
            'author_id' => 'required|exists:authors,id'
        ]);

        $img = $request->img;
        $ext = $img->getClientOriginalExtension();
        $name = "Book-" . uniqid() . ".$ext";
        $img->move(public_path('uploads'), $name);
        Book::query()->create([
            'name' => $request->name ,
            'desc' => $request->desc ,
            'price' => $request->price ,
            'img' => $name  ,
            'author_id' => $request->author_id
        ]);
        return redirect(route('books.paginateBooks'));
    }
//
    public function edit($id)
    {
        $authors = Author::query()->get() ;
        $book = Book::find($id);
        return view('Books.edit', ['book' => $book,'authors' => $authors]);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|string|min:3',
            'desc' => 'required|string',

            'img' => 'nullable|image|mimes:jpg,jpeg,png',

        ]);

        $Book = Book::find($id);


        $oldName = $Book->img ;



        $img = $request->img;
        // if($img !==null){
        if($request->hasFile('img')){
            $ext = $img->getClientOriginalExtension();
            $name = "Book-" . uniqid() . ".$ext";
            $img->move(public_path('uploads'), $name);
            if($Book->img ){

                unlink(public_path("uploads/$oldName")) ; // Delete img
            }

            $Book = Book::find($id)->update([
                'name' => $request->name,
                'desc' => $request->desc,
                'img' => $name
            ]);

        }elseif($img === null) {

            $Book = Book::find($id)->update([
                'name' => $request->name,
                'desc' => $request->desc,

            ]);

        }




        // $Book = Book::find($id)->update([
        //     'name' => $request->name,
        //     'bio' => $request->bio,
        //     'img' => $name
        // ]);


        // return redirect( route('Books.showBooks',$request->id)) ;
        return back();
    }

    public function delete($id)
    {
        $Book = Book::find($id);
        $name = $Book->img;
        unlink(public_path("uploads/$name")) ;
        // unlink(asset("uploads/$name")) ;
        $Book->delete();

        return back();
    }
}
