@extends('layouts.adminPanel')

@section('body')
<button class="btn btn-success mt-2 mb-2 ml-3" data-target="#addCompany" data-toggle="modal">+ زيادكردنی كۆمپانيا</button>
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
                <th>ناو</th>
                <th>زيادكردنی</th>
                <th>كاتی دروست بوون</th>
                <th>دەستكاری كردن</th>
            </tr>
        </thead>
        
        <tbody>
           @foreach($companies as $company)
           <tr>
                <th>{{$company->comp_name}}</th>
                <th>{{$company->user->username}}</th>
                <th class="ltr">{{$company->created_at->diffForHumans()}}</th>
                <th><a href="{{route('company.show',$company->comp_id)}}" class="btn btn-warning text-dark">
                        <i class="fas fa-cog"></i>
                     </a>
                </th>
            </tr>
           @endforeach
           
        </tbody>
    </table> 
    <div class="mt-2">
        {{ $companies->links() }}
    </div>
    


   
    <div id="addCompany" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="btn btn-light" data-dismiss="modal">X</button>
                </div>
                <div class="modal-body">
                    {{-- form --}}
                    <form action="" method="POST" class="ltr" action="{{route('company.store')}}" id="form1">
                        @csrf
                        <div class="form-group">
                            <input class="form-control  text-center" placeholder="ناو" type="text" name="comp_name">
                        </div>

                        
                        <div class="col-12 errorMessage">
                          
                        </div>
                        
                        <button class="btn btn-primary float-right" id="submit">+ زیادكردن</button>

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
               
                $('.successMess').append("<span class='badge badge-success col-12 mt-2 p-2'>"+response.message+"<span>");
                $('tbody').prepend('<tr><th>'+$('input[name="comp_name"]').val()+'</th><th>'+response.name+'</th>'
                +'<th class="ltr">1 second ago</th><th><button class="btn btn-warning" disabled><i class="fas fa-cog"></i></button></th></tr>');
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
</script>
@endsection