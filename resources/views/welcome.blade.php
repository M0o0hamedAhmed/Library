@extends('layouts.app')
@section('title') Main Page @endsection


@section('content')

@include('inc.errors')
<div id="msgSuccess" class="alert alert-success"> </div>
<div id="msgError" class="alert alert-danger"> </div>
    <h1 class="text-primary text-center">Send Mail</h1>

<form id="msgForm">
        @csrf
        <div class="mb-3">
            <label  class="form-label" placeholder="Name">Name</label>
            <input type="text" class="form-control"  name="name">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label" >Desription</label>
            <textarea name="msg" class="form-control"  placeholder="Desription" rows="3" ></textarea>
        </div>


        <button type="submit" class="btn btn-primary">Submit</button>
    </form>


@endsection

@section('scripts')

    <script>
        $('#msgSuccess').hide() ;
        $('#msgError').hide() ;
        $('#msgForm').submit(function (e){

            $('#msgSuccess').hide() ;
            $('#msgError').hide() ;
            $('#msgError').empty() ;

            e.preventDefault()
            let msgData =  new FormData($('#msgForm')[0]) ;


            $.ajax({
                type :"POST",
                url: "{{ route('message.send')}}" ,
                data: msgData,
                contentType: false ,
                processData : false,
                success: function (data) {
                    $('#msgSuccess').show() ;
                    $('#msgSuccess').text(data.success)

                },
                error: function (xhr, status,error) {

                    $('#msgError').show() ;

                    $.each(xhr.responseJSON.errors,function (key,item){
                        $('#msgError').append("<p>" +  item + "</p>") ;
                    } )

                } })

        }) ;





    </script>

@endsection
