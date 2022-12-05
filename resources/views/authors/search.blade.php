

@extends('layouts.app')

@section('title')
Search Page 
@endsection


@section('content')
<h1>Search Reasult </h1>


@foreach($searchReasult as $author)
 <h3>id  -   {{ $author->id }}  <br> name - {{$author->name}}</h3>
 <P>{{$author->bio}}</P>
 <small>{{$author->created_at}}</small>
<hr>
@endforeach


@endsection
