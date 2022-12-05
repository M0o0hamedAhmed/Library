
@extends('layouts.app')

@section('title')
index Page
@endsection

@section('content')

<h1>All Data</h1>

@foreach($authors as $author)
 <h3>  {{ $author->id }}  </h3>
<h2> <a href="{{route('authors.showAuthors' , $author->id)}}">{{ $author->name }}</a></h2>
 <P>{{$author->bio }}</P>

@endforeach


@endsection
