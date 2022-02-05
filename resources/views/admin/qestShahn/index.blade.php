@extends('layouts.adminPanel')
@section('body')
<button class="btn btn-success mt-2 mb-2 ml-3" data-target="#addSection" data-toggle="modal">+ زيادكردن</button>

@if(session()->has('deletes'))
   <div class="col-5 col-sm-3 mx-auto text-center text-light alert bg-danger deletes">سڕایەوە</div>
@endif 
<div class="col-12 table-responsive mx-auto">
    <table class="col-12 text-center ">
        <thead>
            <tr>
                <th>ناو</th>
                <th>ژ.مۆبایل</th>
                <th>جۆر</th>
                <th>تایبەت بە</th>
                <th>زيادكردنی</th>
                <th>كاتی دروست بوون</th>
                <th>دەستكاری كردن</th>
            </tr>
        </thead>
        
        <tbody>
            @foreach ($qestShahn as $qestShahns)
           <tr>
                <th>{{$qestShahns->name}}</th>
                <th>{{$qestShahns->phone_number}}</th>
                <th>{{$qestShahns->menu}}</th>
                <th>{{$qestShahns->cars}}</th>
                <th>{{$qestShahns->user->username}}</th>
                <th class="ltr">{{$qestShahns->created_at->diffForHumans()}}</th>
                <th>
                 <form method="post" action="{{route('qestShahn.destroy',$qestShahns->id)}}" >
                     @csrf
                     <input type="hidden" name="_method" value="delete" />
                    <button class="btn btn-danger"  type="submit"><i class="fas fa-trash"></i></button>
                 </form>  
                </th>
            </tr>
           @endforeach
           
        </tbody>
    </table> 
    <div class="mt-2">
        {{ $qestShahn->links() }}
    </div>
    





<div id="addSection" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button class="btn btn-light" data-dismiss="modal">X</button>
            </div>
            <div class="modal-body">
                {{-- form --}}
                <form action="" method="POST" class="ltr" action="{{route('qestShahn.store')}}" id="form1" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group mt-2">
                        <input class="form-control  text-center" placeholder="" type="text" name="name">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id=""> : ناو</span>
                        </div>
                      </div>
                      <div class="input-group mt-2">
                        <input class="form-control  text-center" placeholder="" type="text" name="phone_number">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id=""> : ژ.مۆبایل</span>
                        </div>
                      </div>
                  
                      <div class="input-group mt-2">
                        <input class="form-control  text-center" placeholder="" type="text" name="cars">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="">: تایبەتە بە چ سەیارەیەك بینووسە </span>
                        </div>
                      </div>
                     
                      <div class="input-group mt-2">
                            <select id="my-select" class="form-control" name="menu">
                                <option></option>
                                <option value="قیست">قیست</option>
                                <option value="شەحن">شەحن</option>
                            </select>
                        <div class="input-group-prepend">
                          <span class="input-group-text" id=""> : جۆر</span>
                        </div>
                      </div>
                  
                
                    <div class="col-12 mt-3 errorMessage">
                      
                    </div>
                    
                    <button class="btn btn-primary float-right mt-2" id="submit">+ زیادكردن</button>

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
                $('tbody').prepend(' <tr><th>'+response.name+'</th>'
                                           +'<th>'+response.phone_number+'</th><th>'+response.menu+'</th><th>'+response.cars+'</th><th>'+response.username.username+'</th>'
                                           +'<th class="ltr">1 second ago</th>'
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