@extends('layouts.normalUser')
@section('body')
<div class="col-12 colsm-9 col-md-6 col-lg-5 mx-auto text-center">
     {{-- form --}}
     {!! Form::open(['method'=>'post','route'=>('nAdmin.store'),'class'=>'ltr','id'=>'form1','files'=>true]) !!}
    

     <div class="input-group">
        <select class="form-control"  name="city_name">
            <option value=""></option>
        @foreach($cities as $city)
            <option value="{{$city}}">{{$city}}</option>
        @endforeach
        </select>
        <div class="input-group-prepend">
          <span class="input-group-text" id="">: شار دياری بكە</span>
        </div>
      </div>

      <div class="input-group mt-2">
        <select class="form-control"  name="comp_id">
                <option value=""></option>
            @foreach($companies as $comp)
                <option value="{{$comp->comp_id}}">{{$comp->comp_name}}</option>
            @endforeach
        </select>
        <div class="input-group-prepend">
          <span class="input-group-text" id=""> : ئۆتۆمبێل دیاری بكە </span>
        </div>
      </div>


      <div class="input-group mt-2">
        <input class="form-control  text-center"  type="text" name="name">
        <div class="input-group-prepend">
          <span class="input-group-text" id=""> :  جۆری ئۆتۆمبێل بنووسە</span>
        </div>
      </div>

     

      <div class="input-group mt-2">
        <select class="form-control"  name="sec_id">
            <option value=""></option>
        @foreach($main_sections as $sec)
            <option value="{{$sec->sec_id}}">{{$sec->sec_name}}</option>
        @endforeach
        </select>
        <div class="input-group-prepend">
          <span class="input-group-text" id=""> : جۆری مۆدێل دیاری بكە </span>
        </div>
      </div>

     

      <div class="input-group mt-2">
        <select class="form-control" name="model">
            <option value=""></option>
            @for($i=1980;$i<= now()->year;$i++)
                <option value="{{$i}}">{{$i}}</option>
            @endfor
        </select>
        <div class="input-group-prepend">
          <span class="input-group-text" id=""> :  مۆدێل دیاری بكە </span>
        </div>
      </div>


       
      <div class="input-group mt-2">
        <input class="form-control  text-center" placeholder="" type="number" name="price">
        <div class="input-group-prepend">
          <span class="input-group-text" id=""> : نرخ بنووسە </span>
        </div>
      </div>
     


      <div class="input-group mt-2">
        <input class="form-control  text-center" placeholder="" type="text" name="plate_number">
        <div class="input-group-prepend">
          <span class="input-group-text" id=""> : ژمارەی سەیارە بنووسە </span>
        </div>
      </div>

      <div class="input-group mt-2">
        <input class="form-control  text-center" placeholder="" type="text" name="mobile_number">
        <div class="input-group-prepend">
          <span class="input-group-text" id=""> : ژمارە مۆبایل بنووسە </span>
        </div>
      </div>

      
      @if(auth()->user()->role->name=="companya")
      <div class="input-group mt-2">
        <select class="form-control" name="menu">
          <option value=""></option>
          <option value="new">تازە</option>
          <option value="">كۆن</option>
        </select>
        <div class="input-group-prepend">
          <span class="input-group-text" id=""> : جۆری سەیارە هەڵبژێرە </span>
        </div>
      </div>
      @endif



       
      <div class="input-group mt-2">
        <textarea id="my-textarea" class="form-control text-center" name="note" rows="3" placeholder=""></textarea>
        <div class="input-group-prepend">
          <span class="input-group-text" id=""> : تێبینیت بنووسە </span>
        </div>
      </div>



      <div class="progress mt-2 mb-2">
        <div class="progress-bar bg-success" style="transition: .6s" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
      </div>

        <div class="col-12  border border-light rounded mt-1">
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
        <button class="btn btn-primary col-12 mt-2 mb-4" id="submit">+ زیادكردن</button>

        

   {!! Form::close() !!}
{{-- end form --}}
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


      $('#form1').submit(function (e) { 
        e.preventDefault();
        $('#submit').attr('disabled',true);
        $('#submit').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
         +' <span class="sr-only">Loading...</span>');
        $( '.errorMessage' ).html('');
        let formData=new FormData($(this)[0]);
        let url=$(this).attr('action');
        $.ajax({
            type: "post",
            url: url,
            data: formData,
            cache:false,
            processData:false,
            contentType:false,
            success: function (response) {
               
                $('.successMess').append("<span class='badge badge-success col-12 mt-2 p-2'>"+response+"<span>");
                  $('.progress-bar').addClass("w-100");
                   $('#form1').trigger('reset');
                   $('.allImages div img').attr('src','');
            },
            error: function(data){
                let errors=data.responseJSON;
                
                    $.each( errors.errors, function( key, value ) {
                       $( '.errorMessage' ).append('<div class="alert alert-danger animate__animated animate__shakeX alert-dismissible fade show" role="alert">'
                                            +'<strong>'+value+'</strong>' 
                                            +'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
                                               +'<span aria-hidden="true">&times;</span>'
                                            +'</button>'
                                            +'</div>');
                    });
                   
            }
        });

        setInterval(() => {
          $('.progress-bar').addClass("w-0");
        }, 2000);
        $('#submit').attr('disabled',false);
        $('#submit').html('+ زیادكردن');
    });
</script>
     
@endsection