@extends('layouts.adminPanel')
@section('body')
<button class="btn btn-primary" onclick="back()">-></button>

<div class="col-12 col-sm-6 mx-auto ltr">
    {{ Form::model($office,['route'=>['office.update',$office->office_id],'method'=>'PATCH','files'=>true]) }}    
    <div > {{ Form::text('name',null,['placeholder'=>'ناو بگۆڕە','class'=>'form-control text-center mt-2']) }}         </div>
    <div > {{ Form::text('phone_number',null,['placeholder'=>'ژ.مۆبایل بگۆڕە','class'=>'form-control text-center mt-2']) }}         </div>
    <div > {{ Form::text('address',null,['placeholder'=>'ناونیشان بگۆڕە','class'=>'form-control text-center mt-2']) }}         </div>

     {{ Form::submit('تازەكردنەوە',['class'=>'btn btn-success mt-2 btn-block']) }} 
    {{ Form::close() }}

    {{ Form::model($office,['route'=>['office.destroy',$office->office_id],'method'=>'DELETE']) }}
       {{ Form::submit('سڕینەوە',['class'=>'btn btn-danger mt-2 btn-block']) }} 
    {{Form::close()}}
</div>

<div class="col-10 col-sm-6 mx-auto mt-2">
    <ul class="list-group"> 
        @foreach($errors->all() as $error)
    <li class="list-group-item disabled mt-2 bg-danger text-light animate__animated animate__shakeX  mx-auto text-center" aria-disabled="true">{{$error}}</li> 
        @endforeach
    </ul>
   
     

   
</div>

<script>
    function back(){
        window.history.back();
    }
</script>
@endsection