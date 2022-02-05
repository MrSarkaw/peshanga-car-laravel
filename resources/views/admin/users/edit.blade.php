@extends('layouts.adminPanel')

@section('body')
    <button class="btn btn-primary" onclick="back()">-></button>

    <div class="col-12 col-sm-6 mx-auto ltr">
        {{ Form::model($userInfo,['route'=>['user.update',$userInfo->user_id],'method'=>'PATCH']) }}  
        <div class="allinput">
            <div class="input-group mt-2">
                {{ Form::text('username',null,['placeholder'=>'','class'=>'form-control text-center ']) }}
                <div class="input-group-prepend">
                  <span class="input-group-text" id=""> : ناو بگۆڕە</span>
                </div>
            </div>
          
            <div class="input-group mt-2">
                {{ Form::password('password',['placeholder'=>'','class'=>'form-control text-center'])   }} 
                <div class="input-group-prepend">
                  <span class="input-group-text" id=""> : پاسۆرد بگۆڕە</span>
                </div>
            </div>
          
          
            <div class="input-group mt-2">
                {{ Form::number('phone_number',null,['placeholder'=>'','class'=>'form-control text-center ']) }} 
                <div class="input-group-prepend">
                  <span class="input-group-text" id=""> : ژ.مۆبایل بگۆڕە</span>
                </div>
            </div>
          
               @if($userInfo->role->name=="companya")
                    <div class="input-group mt-2" id="com">
                     {{ Form::text('company',null,['placeholder'=>'تايبەتە بە چ سەیارەیەك بینووسە','class'=>'form-control text-center ']) }}         
                        <div class="input-group-prepend">
                        <span class="input-group-text" id=""> : تايبەتە بە چ سەیارەیەك بینووسە</span>
                        </div>
                    </div>
                @endif
          
         
                <div class="input-group mt-2">
                    {{ Form::select('city_id',[''=>'شار بگۆڕە']+$cities,null,['class'=>'form-control ']) }}
                    <div class="input-group-prepend">
                      <span class="input-group-text" id=""> : شار</span>
                    </div>
                </div>

                <div class="input-group mt-2">
                    {{ Form::select('role_id',[''=>'ئاست بگۆڕە']+$permission,null,['class'=>'form-control ','id'=>'role_id']) }} 
                    <div class="input-group-prepend">
                      <span class="input-group-text" id=""> : ئاست</span>
                    </div>
                </div>
    
        </div>  
         {{ Form::submit('تازەكردنەوە',['class'=>'btn btn-success mt-2 btn-block']) }} 
        {{ Form::close() }}

        {{ Form::model($userInfo,['route'=>['user.destroy',$userInfo->user_id],'method'=>'DELETE']) }}
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

        $('#role_id').on('change',function(){
            $('input[name="company"]').remove();
        if($('#role_id').val()=='2'){
            $('.allinput').append('<div class="input-group mt-2" id="com">'
                                    +'<input class="form-control  text-center" placeholder="" type="text" name="company" value="">'
                                    +'<div class="input-group-prepend"><span class="input-group-text" id=""> : تايبەتە بە چ سەیارەیەك بینووسە </span>'
                                    +'</div></div>')
        }else{
            $('#com').remove();
        }
    })

    </script>
@endsection