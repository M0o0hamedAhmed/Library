@extends('layouts.app') ;


@section('title')
create Page
@endsection


@section('content')


@include('inc.errors')
<form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Name</label>
        <input name="name" type="text" class="form-control" placeholder="name" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Price</label>
        <input name="price" type="text" class="form-control" placeholder="price" aria-describedby="emailHelp">

    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Desc</label>
        <textarea name="desc" class="form-control" placeholder="Desc" rows="3"></textarea>
    </div>
    <select class="form-control" name="author_id">
        @foreach($authors as $author)
            <option value="{{$author->id}}">{{$author->name}}  </option>
        @endforeach
    </select>
    <div class="mb-3">
        <label for="formFileLg" class="form-label">Large file input example</label>
        <input class="form-control form-control-lg" id="formFileLg" type="file" name="img">
      </div>
    <button type="submit" class="btn btn-primary">Submit</button>



  </form>
@endsection
