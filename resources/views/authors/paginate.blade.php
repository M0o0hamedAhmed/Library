@extends('layouts.app')

@section('title')
Paginate Page
@endsection


@section('content')
<h1 class="text-secondary text-center">المولفين </h1>
@auth()

<a type="button" class="btn btn-primary mb-3" href="{{ route('authors.createAuthors') }}">Add New</a>
@endauth
<div class="container d-flex justify-content-between">




    @foreach($authorsPaginate as $author)
    <div class="card" style="width: 18rem;">
        @if ($author->img !== null)
        <img src='{{ asset("uploads/$author->img")}}' class="card-img-top " alt="...">
        @endif

        <div class="card-body">
          <h5 class="card-title">   اسم المولف  : <br>
              <a href="{{route('authors.showAuthors' , $author->id)}}">
              {{$author->name}}</a></h5>
          <p class="card-text"> من هو :
              <br>
              {{$author->bio}}
          </p>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">My ID IS : {{$author->id}}</li>
            <li class="list-group-item">Books</li>
           @foreach($author->books as $item)
                <li class="m-3 list-group-item"> {{$item->name}}</li>
            @endforeach
          <li class="list-group-item">Updated at {{ $author->updated_at }}</li>
          <li class="list-group-item">Created_at {{ $author->created_at }}</li>
        </ul>
        <div class="card-body">
            <a href="{{ route('authors.showAuthors',$author->id) }}" class="btn btn-success p-2"> Show  </a>
            @auth()
                <a href="{{ route('authors.edit',$author->id) }}" class="btn btn-primary p-2"> Edit </a>


{{--                @if(auth()->guard('admin')->user())--}}
{{--                @if(Auth::guard('admin')->check())--}}
                @IsAdmin
                    <a href="{{ route('authors.delete',$author->id) }}" class="btn btn-danger ">Delete</a>
                @endIsAdmin
{{--                @endif--}}
            @endauth
        </div>
      </div>




    <hr>
    @endforeach



</div>
<div class="d-flex justify-content-center m-5">
    {!! $authorsPaginate->links() !!}
</div>

<!-- {!! $authorsPaginate->render() !!} -->


@endsection
