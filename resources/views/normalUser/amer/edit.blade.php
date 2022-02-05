@extends('layouts.normalUser')
@section('body')
<div class="col-12 colsm-9 col-md-6 col-lg-5 mx-auto text-center">
     {{-- form --}}
     {!! Form::model($amers,['method'=>'PATCH','url'=>('amer/'.$amers->id),'class'=>'ltr','id'=>'form1','files'=>true]) !!}
       
     <div class="input-group">
        <select class="form-control"  name="city_id">
            <option value="">شار بۆ ژمارەی سەیارە دیاری بكە</option>
        @foreach($cities as $city)
            <option {{$amers->city_id==$city->city_id? 'selected':''}} value="{{$city->city_id}}">{{$city->city_name}}</option>
        @endforeach
        </select>
        <div class="input-group-prepend">
          <span class="input-group-text" id="">: شار  </span>
        </div>
      </div>

      
    
     
     
   


      <div class="input-group mt-2">
        {!! Form::text('name',null,['class'=>'form-control  text-center','placeholder'=>'ناو']) !!}
        <div class="input-group-prepend">
          <span class="input-group-text" id=""> :  ناو 
          </span>
        </div>
      </div>

      
    <div class="input-group mt-2">
        <select class="form-control" name="sec_id">
            <option >جۆری ئامێر دیاری بكە</option>
            @foreach($main_sections as $sec)
                <option value="{{$sec->sec_id}}" {{ $sec->sec_id ==$amers->sec_id ? 'selected' : '' }}>{{$sec->sec_name}}</option>
            @endforeach
        </select>
        <div class="input-group-prepend">
          <span class="input-group-text" id=""> : جۆری مۆدێل دیاری بكە </span>
        </div>
      </div>


          <div class="input-group mt-2">
            {!! Form::number('price',null,['class'=>'form-control  text-center','placeholder'=>""]) !!}
            <div class="input-group-prepend">
              <span class="input-group-text" id=""> : نرخ بنووسە </span>
            </div>
          </div>
    
      
            

           
      <div class="input-group mt-2">
        {!! Form::textarea('note',null,['class'=>'form-control  text-center','placeholder'=>""]) !!}
        <div class="input-group-prepend">
          <span class="input-group-text" id=""> : تێبینیت بنووسە </span>
        </div>
      </div>

        


        <div class="col-12  border border-light rounded">
            <div class="float-right col-3 m-1 p-0">
                <button class="btn btn-primary col-5" type="button" id="inc">+</button>
               <button class="btn btn-danger" id="dec" type="button">-</button>
            </div>
            <div class="float-left col-6 m-1">
                <span class="badge badge-info p-2 m-2">ئەتوانیت تا 20 وێنە دانێیت</span>
            </div>
            
            <div class="imgs">
               
            <input class="form-control" type="file" name="images[]">
             
     
         </div>  
         <div class="allImages row">
               <div class="col-6 p-2 ">
                 <img src="" class="col-12 s0 " alt="">
               </div>
         </div>
      
        </div>
        

        <div class="col-12 errorMessage mt-2">
            
           
             
        </div>
        <div class="col-7 float-left row successMess">

        </div>
        <button class="btn btn-primary col-12 mt-2 mb-4" id="submit">تازەكردنەوە</button>

        

   {!! Form::close() !!}

{{-- end form --}}

    {{ Form::model($amers,['route'=>['amer.destroy',$amers->id],'method'=>'DELETE']) }}
        {{ Form::submit('سڕینەوە',['class'=>'btn btn-danger mt-2 btn-block']) }} 
    {{Form::close()}}
</div>

     
<script>
    function readURL(input,length) {
               var reader = new FileReader();
               reader.onloadend = function (e) {
                   $('.s'+length).attr('src', e.target.result);
               }
               reader.readAsDataURL(input.files[0]);
       }

       $(document).on('change', '.imgs input[type="file"]', function () {
           let index=$(this).index();
           readURL(this,index);
       });
       
       $('#inc').on('click',()=>{
         let indexs=$(' .imgs  input[type="file"]').length;
         if(indexs<20){
             $('form .imgs').append("<input type='file' name='images[]' class='mt-2 form-control'>");
         $('.allImages').append(' <div class=" col-6 p-2">'
                   +'<img src="" class="col-12 s'+(indexs)+'">'
               +'</div>')
         }
         
     })

     $('#dec').on('click',()=>{
       let indexs=$(' .imgs  input[type="file"]').length;
       if(indexs>1){
         $('form .imgs input[type="file"]').last().remove();
       $('.allImages img').last().remove();   
       }
      
     })

</script>
@endsection