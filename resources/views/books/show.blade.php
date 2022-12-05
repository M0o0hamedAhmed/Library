

@extends('layouts.app')

@section('title')
 show page {{$book->name}}
@endsection

@section('content')


    <a href="{{route('books.showBooks' , $book->id)}}" >

        <div class="card" style="width: 60%;">
            @if ($book->img !== null)
                <img src='{{ asset("uploads/$book->img")}}' class="card-img-top " alt="...">
            @endif

            <div class="card-body">
                <h5 class="card-title">Name : {{$book->name}}</h5>
                <p class="card-text">Bio :  {{$book->desc}}</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Price  : {{$book->price}} $</li>
                <li class="list-group-item">Updated at {{ $book->updated_at }}</li>
                <li class="list-group-item">Created_at {{ $book->created_at }}</li>
            </ul>
            <div class="card-body">

                @auth()
                    <a href="{{ route('books.edit',$book->id) }}" class="btn btn-primary p-2"> Edit </a>
                    <a href="{{ route('books.delete',$book->id) }}" class="btn btn-danger ">Delete</a>
                @endauth
            </div>
        </div>
    </a>


{{--<h1>show Data</h1>--}}


{{-- <h3>  {{ $book->id }}  {{$book->name}}</h3>--}}
{{-- <P>{{$book->bio}}</P>--}}
{{-- <small>{{$book->created_at}}</small>--}}
{{--<hr>--}}

<a class="btn btn-primary p-2 mt-3" href="{{route('books.paginateBooks')}}">Back to all </a>


@endsection
