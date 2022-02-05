@extends('layouts.normalUser')

@section('body')
<div class="col-12 mx-auto mt-2  ">
    <div class="col-12 col-sm-6 mx-auto ltr">
        {{ Form::model($user,['route'=>['infoUpdate',$user->user_id],'method'=>'PATCH']) }}    
        <div > {{ Form::text('phone_number',null,['placeholder'=>'ژ.مۆبایل بگۆڕە','class'=>'form-control text-center mt-2']) }} </div>
        <div > {{ Form::password('password',['placeholder'=>'پاسۆرد بگۆڕە','class'=>'form-control text-center mt-2']) }} </div>
         {{ Form::submit('تازەكردنەوە',['class'=>'btn btn-success mt-2 btn-block']) }} 
        {{ Form::close() }}

      
    </div>

    <div class="col-10 col-sm-6 mx-auto mt-2">
        <ul class="list-group"> 
            @foreach($errors->all() as $error)
        <li class="list-group-item disabled mt-2 bg-danger text-light animate__animated animate__shakeX  mx-auto text-center" aria-disabled="true">{{$error}}</li> 
            @endforeach
        </ul>
       
         

       
    </div>

</div>


@endsection