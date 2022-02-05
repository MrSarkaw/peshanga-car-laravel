@extends('layouts.normalUser')
@section('body')
{!! Form::model($raport,['method'=>'PATCH','url'=>route('raport.update',$raport->id)]) !!}
    <div class="allinput"> 
   
              <p class=" text-center bg-warning rounded " id="">  ڕاپۆرت</p>
               
        <div class="input-group mt-2">
            {!! Form::textarea('raport',null,['class'=>"form-control  text-center",'maxlength'=>'2000',]) !!}
            
          </div>
    </div>
   
    <div class="col-12 errorMessage p-0 mt-2">
        <ul class="list-group"> 
            @foreach($errors->all() as $error)
        <li class="list-group-item disabled mt-2 bg-danger text-light animate__animated animate__shakeX  mx-auto text-center" aria-disabled="true">{{$error}}</li> 
            @endforeach
        </ul>
    </div>
    
    <button class="btn btn-success float-right mt-3" id="submit"> تازەكردنەوە</button>

    

{!! Form::close() !!}

{!! Form::model($raport,['method'=>'DELETE','url'=>route('raport.destroy',$raport->id)]) !!}
    <button class="btn btn-danger float-right mt-3 mr-2" id="submit">سڕینەوە</button>
{!! Form::close() !!}

@endsection