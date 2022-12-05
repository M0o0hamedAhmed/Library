@extends('layouts.app')

@section('title')
Paginate Page
@endsection


@section('content')
<h1 class="text-secondary text-center">Books </h1>

@auth()
    <a type="button" class="btn btn-primary mb-3" href="{{ route('books.createBooks') }}">Add New</a>
@endauth

<div class="container d-flex justify-content-between">




    @foreach($BooksPaginate as $book)
        <a href="{{route('books.showBooks' , $book->id)}}">

            <div class="card" style="width: 18rem;">
                @if ($book->img !== null)
                    <img src='{{ asset("uploads/$book->img")}}' class="card-img-top " alt="...">
                @endif

                <div class="card-body">
                    <h5 class="card-title">Name : {{$book->name}}</h5>
                    <p class="card-text">Bio :  {{$book->desc}}</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Price  : {{$book->price}} $</li>
                    @foreach($authors as $author)
                            @if($book->author_id == $author->id)
                            <li class="list-group-item"> : اسم مؤلف الكتاب <br>
                             {{$author->name}}  </li>
                            @endif

                    @endforeach


                    <li class="list-group-item">Updated at {{ $book->author->name }}</li>
                    <li class="list-group-item">Updated at {{ $book->updated_at }}</li>
                    <li class="list-group-item">Created_at {{ $book->created_at }}</li>
                </ul>
                <div class="card-body">
                    <a href="{{ route('books.showBooks',$book->id) }}" class="btn btn-success p-2"> Show  </a>

                    @auth()
                        <a href="{{ route('books.edit',$book->id) }}" class="btn btn-primary p-2"> Edit </a>
                        <a href="{{ route('books.delete',$book->id) }}" class="btn btn-danger ">Delete</a>

                    @endauth
                </div>
            </div>
        </a>




    <hr>
    @endforeach



</div>
<div class="d-flex justify-content-center m-5">
    {!! $BooksPaginate->links() !!}
</div>

<!-- {!! $BooksPaginate->render() !!} -->


@endsection
