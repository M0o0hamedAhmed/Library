

@extends('layouts.app')

@section('title')
 show page
@endsection

@section('content')

<h1>show Data</h1>


 <h3>  {{ $author->id }}  {{$author->name}}</h3>
 <P>{{$author->bio}}</P>
 <small>{{$author->created_at}}</small>
<hr>

<a href="{{route('authors.allAuthors')}}">Back to all </a>


@endsection
