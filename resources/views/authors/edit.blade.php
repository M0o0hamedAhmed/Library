@extends('layouts.app') ;


@section('title')
Edit Page {{ $author->name}}
@endsection


@section('content')
@include('inc.errors')
<form method="POST" action="{{ route('authors.update', $author->id ) }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Name</label>
      <input name="name" type="text" class="form-control" placeholder="name" value="{{$author->name}}">

    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Bio</label>
        <textarea name="bio" class="form-control " style="height: 400" placeholder="Bio" rows="3" >{{$author->bio}}</textarea>
    </div>
    @if ($author->img !== null)
    <img src='{{ asset("uploads/$author->img")}}'   class="card-img-top w-25" alt="...">
    @endif
    <div class="mb-3">
        <label for="formFileLg" class="form-label">Large file input example</label>
        <input class="form-control form-control-lg" id="formFileLg" type="file" name="img">
      </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <a type="button" href="{{ route('authors.paginateAuthors') }}" class="btn btn-primary">Back</a>
    {{$author->img }}
  </form>


@endsection
