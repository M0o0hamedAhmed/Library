@extends('layouts.app') ;


@section('title')
Edit Page {{ $book->name}}
@endsection


@section('content')
@include('inc.errors')
<form method="POST" action="{{ route('books.update', $book->id ) }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Name</label>
      <input name="name" type="text" class="form-control" placeholder="name" value="{{$book->name}}">

    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Desc</label>
        <textarea name="bio" class="form-control " style="height: 400" placeholder="Bio" rows="3" >{{$book->desc}}</textarea>
    </div>
    <select class="form-control" name="author_id">
        @foreach($authors as $author)
            @if($book->author_id == $author->id)
                <option value="{{$author->id}}" selected>{{$author->name}}  </option>
            @elseif($book->author_id !== $author->id)
                <option value="{{$author->id}}" >{{$author->name}}  </option>
            @endif


        @endforeach
    </select>
    @if ($book->img !== null)
    <img src='{{ asset("uploads/$book->img")}}'   class="card-img-top w-25" alt="...">
    @endif
    <div class="mb-3">
        <label for="formFileLg" class="form-label">Large file input example</label>
        <input class="form-control form-control-lg" id="formFileLg" type="file" name="img">
      </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <a type="button" href="{{ route('books.showBooks',$book->id) }}" class="btn btn-primary">Back</a>
    {{$book->img }}
  </form>


@endsection
