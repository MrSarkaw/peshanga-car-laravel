@extends('layouts.normalUser')
@section('body')
<button class="btn btn-success mt-2 mb-2 ml-3" data-target="#addSection" data-toggle="modal">+ زيادكردن</button>


@if(session()->has('success'))
   <div class="col-5 col-sm-3 mx-auto text-center text-light alert bg-success success">تازەكرایەوە</div>
@endif 
@if(session()->has('deletes'))
   <div class="col-5 col-sm-3 mx-auto text-center text-light alert bg-danger deletes">سڕایەوە</div>
@endif 


<span class="badge badge-warning p-2 d-block mb-4 col-12 borde-bottom border-warning">بڵاوكراوەكانت</span>

<div class="col-12 divPost  mx-auto text-center">
    @foreach ($amer as $amers)
    <div class="boxPost p-2">
      
        <span class="badge badge-warning mt-2">{{$amers->main_sections->sec_name}}</span>
        <p class="bg-warning text-dark rounded h4">{{$amers->name}}</p>

        <div class="col-12 p-0">
            @foreach(explode('|',$amers->images) as $row)
                <div class="col-12 p-0 border border-warning mpost">
                    {!! HTML::image('posts/'.$row,null,['class'=>'col-12 mainImg p-0']) !!}
                </div>
            @php break; @endphp
            @endforeach
        
            <div class="mt-2 posts border border-warning">

                @foreach (explode('|',$amers->images) as $row2)
                   
                        {!! HTML::image('posts/'.$row2,null,['class'=>'col-12 img  p-0']) !!}
                   
                @endforeach
                
            </div> 
        </div>
        <span class="badge badge-warning ">نرخ : {{$amers->price}}</span>
        <span class="badge badge-warning mt-2">شار : {{$amers->cities->city_name}}</span>
    
        <div class="note border-warning border">
            {{$amers->note}}
        </div>
        <a href="{{route('amer.edit',$amers->id)}}">
             <button class="btn btn-warning mt-2 col-12 btn-sm"><i class="fas fa-cog"></i></button>
        </a>
       
    </div>


    @endforeach
   
   
</div>
<br>
 {{$amer->links()}}


<div id="addSection" class="modal fade rtl" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button class="btn btn-light" data-dismiss="modal">X</button>
            </div>
            <div class="modal-body">
                {{-- form --}}
                <form action="" method="POST" class="ltr" action="{{route('amer.store')}}" id="form1" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group text-center  mb-2">
                        <select name="city_id" class="col-6 col-md-9" id="">
                            <option value=""></option>
                            @foreach ($cities as $city)
                                 <option value="{{$city->city_id}}">{{$city->city_name}}</option>
                            @endforeach
                           
                        </select>                           
                        <div class="input-group-prepend col-6 col-md-3 p-0">
                          <span class="input-group-text col-12" id=""> : شار دياری بكە</span>
                        </div>
                      </div>
                    <div class="input-group mt-2">
                        <input class="form-control  text-center" placeholder="" type="text" name="name">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id=""> : ناو</span>
                        </div>
                      </div>

                      <div class="input-group text-center mt-2 mb-2">
                        <select name="sec_id" class="col-5 col-md-8" id="">
                            <option value=""></option>
                            @foreach ($main as $sec)
                                 <option value="{{$sec->sec_id}}">{{$sec->sec_name}}</option>
                            @endforeach
                           
                        </select>                           
                        <div class="input-group-prepend col-7 col-md-4 p-0">
                          <span class="input-group-text col-12" id=""> : جۆری ئامێر دیاری كە</span>
                        </div>
                      </div>

                      <div class="input-group mt-2">
                        <input class="form-control  text-center" placeholder="" type="number" name="price">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id=""> : نرخ</span>
                        </div>
                      </div>

                      <div class="input-group mt-2">
                          <div class="input-group-prepend col-12 p-0 ">
                          <span class="input-group-text col-12 text-center" id="">  تێبینیت بنووسە</span>
                        </div>
                        <textarea name="note" id="" class="form-control" maxlength="255" rows="10"></textarea>
                        
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
                    
                    

                    
                    <div class="col-12 errorMessage">
                      
                    </div>
                    
                    <button class="btn btn-primary btn-sm btn-block mt-2 " id="submit">+ زیادكردن</button>

                    <div class="col-12 p-0 mb-4 mx-auto  row successMess">

                    </div>
                    <br><br>
                    <div class="col-8  mx-auto mt-3">
                        <img src="" alt="" class="col-12 LRD prev">
                    </div>
                </form>
            {{-- end form --}}
            </div>
        </div>
    </div>
</div>

<script>
    $('#form1').submit(function (e) { 
        e.preventDefault();
        
        $( '.errorMessage' ).html('');
        $( '.success' ).html('');
        $( '.deletes' ).html('');


        $( '.prev' ).attr('src','');
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
               if(response.message!="failed"){
                $('.successMess').append("<span class='badge badge-success col-12 mt-2 p-2'>زيادكرا<span>");                       
                   $('#form1').trigger("reset");;
                }
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
    });

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
