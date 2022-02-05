@extends('layouts.adminPanel')
@section('body')
<button class="btn btn-success mt-2 mb-2 ml-3" data-target="#addSection" data-toggle="modal">+ زيادكردنی بەش</button>


@if(session()->has('success'))
   <div class="col-5 col-sm-3 mx-auto text-center text-light alert bg-success success">تازەكرایەوە</div>
@endif 
@if(session()->has('deletes'))
   <div class="col-5 col-sm-3 mx-auto text-center text-light alert bg-danger deletes">سڕایەوە</div>
@endif 
<div class="col-12 table-responsive mx-auto">
    <table class="col-12 text-center ">
        <thead>
            <tr>
                <th>ناو</th>
                <th>وێنە</th>
                <th>جۆر</th>
                <th>زيادكردنی</th>
                <th>كاتی دروست بوون</th>
                <th>دەستكاری كردن</th>
            </tr>
        </thead>
        
        <tbody>
            @foreach ($sections as $section)
           <tr>
                <th>{{$section->sec_name}}</th>
                <th> {!! HTML::image('images/'.$section->image,null,['class'=>'col-12 icon mt-1 ']) !!}</th>
                <th>
                    @if($section->menu==null)
                    ئۆتۆمبێل
                    @else
                    ئامێر و هاوشێوەكانی
                    @endif
                </th>
                <th>{{$section->user->username}}</th>
                <th class="ltr">{{$section->created_at->diffForHumans()}}</th>
                <th><a href="{{route('sections.show',$section->sec_id)}}" class="btn btn-warning text-dark">
                        <i class="fas fa-cog"></i>
                     </a>
                </th>
            </tr>
           @endforeach
           
        </tbody>
    </table> 
    <div class="mt-2">
        {{ $sections->links() }}
    </div>
    





<div id="addSection" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button class="btn btn-light" data-dismiss="modal">X</button>
            </div>
            <div class="modal-body">
                {{-- form --}}
                <form action="" method="POST" class="ltr" action="{{route('sections.store')}}" id="form1" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group mt-2">
                        <input class="form-control  text-center" placeholder="" type="text" name="sec_name">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id=""> : ناو</span>
                        </div>
                      </div>

                      <div class="input-group text-center mt-2 mb-2">
                        <select name="menu" class="" id="">
                            <option value=""></option>
                            <option value="amer">بەڵێ</option>
                        </select>                            <div class="input-group-prepend">
                          <span class="input-group-text" id=""> : ئەگەر ئامێرە و جۆرەكانیەتی بەڵێ هەڵبژێرە</span>
                        </div>
                      </div>

                   
                  
                    

                    <div class="form-group">
                        <input class="form-control  text-center" type="file" name="image">
                    </div>

                    
                    

                    
                    <div class="col-12 errorMessage">
                      
                    </div>
                    
                    <button class="btn btn-primary float-right" id="submit">+ زیادكردن</button>

                    <div class="col-7 mb-4 float-left row successMess">

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
                $('tbody').prepend(' <tr><th>'+response.name+'</th><th><img src="images/'+response.path+'" class="col-12 mt-1 icon rounded"></th>'
                                           +'<th>'+response.username.username+'</th><th class="ltr">1 second ago</th>'
                                           +'<th><button class="btn btn-warning text-dark" disabled><i class="fas fa-cog"></i></button></th><tr>');
                                            
                                               
                   $('#form1').trigger('reset');
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


    function readURL(input) {
                var reader = new FileReader();
                reader.onloadend = function (e) {
                    $('.prev').attr('src', e.target.result);
                }
                console.log(length);
                reader.readAsDataURL(input.files[0]);
        }

        $(document).on('change', 'input[type="file"]', function () {
            readURL(this);
        });
</script>
@endsection