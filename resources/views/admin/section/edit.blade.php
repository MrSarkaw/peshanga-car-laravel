@extends('layouts.adminPanel')
@section('body')
<button class="btn btn-primary" onclick="back()">-></button>

<div class="col-12 col-sm-6 mx-auto ltr">
    {{ Form::model($section,['route'=>['sections.update',$section->sec_id],'method'=>'PATCH','files'=>true]) }}
    


      <div class="input-group mt-2">
        {{ Form::text('sec_name',null,['placeholder'=>'ناو بگۆڕە','class'=>'form-control text-center ']) }} 
        <div class="input-group-prepend">
          <span class="input-group-text" id=""> : ناو</span>
        </div>
      </div>
      <div class="input-group text-center mt-2 mb-2">
        <select name="menu" class="" id="">
            <option value=""></option>
            <option value="amer" {{$section->menu=="amer"?'selected':''}}>بەڵێ</option>
        </select>                            <div class="input-group-prepend">
          <span class="input-group-text" id=""> : ئەگەر ئامێرە و جۆرەكانیەتی بەڵێ هەڵبژێرە</span>
        </div>
      </div>


    <div>  <input type="file" class="form-control mt-2" name="image"></div>
     {{ Form::submit('تازەكردنەوە',['class'=>'btn btn-success mt-2 btn-block']) }} 
    {{ Form::close() }}

    {{ Form::model($section,['route'=>['sections.destroy',$section->sec_id],'method'=>'DELETE']) }}
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