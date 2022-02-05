@extends('layouts.adminPanel')

@section('body')
<button class="btn btn-success mt-2 mb-2 ml-3" data-target="#addUser" data-toggle="modal">+ زيادكردنی بەكارهێنەر</button>
@if(session()->has('success'))
   <div class="col-5 col-sm-3 mx-auto text-center text-light alert bg-success">تازەكرایەوە</div>
@endif 
@if(session()->has('deletes'))
   <div class="col-5 col-sm-3 mx-auto text-center text-light alert bg-danger">سڕایەوە</div>
@endif 
<div class="col-12 table-responsive mx-auto">
    <table class="col-12 text-center ">
        <thead>
            <tr>
                <th>ئاست</th>
                <th>ناو</th>
                <th>ژ.مۆبایل</th>
                <th>شار</th>
                <th>كاتی دروست بوون</th>
                <th>دەستكاری كردن</th>
            </tr>
        </thead>
        
        <tbody>
            @foreach($user as $users)
                <tr>
                    <th>{{$users->role->name}}</th>
                    <th>{{$users->username}}</th>
                    <th>{{$users->phone_number}}</th>
                    @if($users->city_id!=null)
                   <th>{{$users->cities2->city_name}}</th>
                    @else
                     <th>دیارینەكراوە</th>
                    @endif
                    <th class="ltr">{{$users->created_at->diffForHumans()}}</th>
                    <th><a href="{{route('user.show',$users->user_id)}}" class="btn btn-warning text-dark"><i class="fas fa-cog"></i></a></th>
                </tr>
            @endforeach
           
        </tbody>
    </table> 
    <div class="mt-2">
        {{ $user->links() }}
    </div>
    


   
    <div id="addUser" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="btn btn-light" data-dismiss="modal">X</button>
                </div>
                <div class="modal-body">
                    {{-- form --}}
                    <form action="" method="POST" class="ltr" action="{{route('user.store')}}" id="form1">
                        <div class="allinput">
                            @csrf

                            <div class="input-group mt-2">
                                <input class="form-control  text-center" placeholder="" type="text" name="username">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id=""> : ناو</span>
                                </div>
                              </div>
                          
                              <div class="input-group mt-2">
                                <input  class="form-control  text-center" placeholder="" type="password" name="password">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id=""> : پاسۆرد</span>
                                </div>
                              </div>
                            
                              <div class="input-group mt-2">
                                <input class="form-control  text-center" placeholder="" type="number" name="phone_number">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id=""> : ژمارەی مۆبایل</span>
                                </div>
                              </div>
                            
    
                              <div class="input-group mt-2">
                                <select class="form-control" id="city_id" name="city_id">
                                    <option value="">شار دیاری بكە</option>
                                    @foreach($cities as $city)
                                        <option value="{{$city->city_id}}" rel="{{$city->city_name}}">{{$city->city_name}}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id=""> : شار </span>
                                </div>
                              </div>
                            
                              <div class="input-group mt-2">
                                <select class="form-control" id="role_id" name="role_id">
                                    <option value="">ئاستی دیاری بكە</option>
                                    @foreach($permission as $roles)
                                        <option value="{{$roles->role_id}}" rel="{{$roles->name}}">{{$roles->name}}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id=""> : ئاست </span>
                                </div>
                              </div>
                            
    
    
                    
    
                        </div>
                       
                        <div class="col-12 errorMessage">
                          
                        </div>
                        
                        <button class="btn btn-primary float-right mt-3" id="submit">+ زیادكردن</button>

                        <div class="col-7 float-left row successMess">

                        </div>

                    </form>
                {{-- end form --}}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#form1').submit(function (e) { 
        e.preventDefault();
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
                $('tbody').prepend('<tr><th>'+$('#role_id').children("option:selected").attr('rel')+'</th>'
                +'<th>'+$('input[name="username"]').val()+'</th>'
                +'<th>'+$('input[name="phone_number"]').val()+'</th><th>'+$('#city_id').children("option:selected").attr('rel')+'</th><th>1 second ago</th><th><button class="btn btn-warning" disabled><i class="fas fa-cog"></i></button></th></tr>');
                   $('#form1').trigger('reset');
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


    $('#role_id').on('change',function(){
        if($('#role_id').val()=='2'){
            $('.allinput').append('<div class="input-group mt-2" id="com">'
                                    +'<input class="form-control  text-center" placeholder="" type="text" name="company" >'
                                    +'<div class="input-group-prepend"><span class="input-group-text" id=""> : تايبەتە بە چ سەیارەیەك بینووسە </span>'
                                    +'</div></div>')
        }else{
            $('#com').remove();
        }
    })


</script>
@endsection