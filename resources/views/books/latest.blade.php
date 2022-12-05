
@extends('layouts.app')

@section('title')
Latest Page
@endsection

@section('content')

<h1>latest Data</h1>

@foreach($authors as $author)
 <h3>  {{ $author->id }}  {{$author->name}}</h3>
 <P>{{$author->bio}}</P>
 <small>{{$author->created_at}}</small>
<hr>
@endforeach



@endsection



