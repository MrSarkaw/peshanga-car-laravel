@extends('layouts.adminPanel')
@section('body')
<button class="btn btn-success mt-2 mb-2 ml-3" data-target="#addRaport" data-toggle="modal">+ زيادكردنی ڕاپۆرت</button>
@if(session()->has('success'))
   <div class="col-5 col-sm-3 mx-auto text-center text-light alert bg-success">تازەكرایەوە</div>
@endif 
@if(session()->has('deletes'))
   <div class="col-5 col-sm-3 mx-auto text-center text-light alert bg-danger">سڕایەوە</div>
@endif 
<span class="badge badge-warning p-2 d-block mb-4">ڕاپۆرتەكانت</span>
<div class="raports">
    @foreach($reportFroshtn as $row)
        <div class="col-12 p-2 m-2  bg-warning mx-auto rounded">
            <div class="col-12 text-right p-0 ltr">
                <p class="badge badge-dark m-0 text-right"> <span>{{$row->created_at->diffForHumans()}}</span> : بڵاوكراوەتەوە لە </p> 
            </div>
            <div class="col-12 mx-auto text-center bg-dark rounded text-light p-2 m-2 rounded">
                <span> {{$row->raport}}</span>
            </div>
            <div>
                <a href="{{route('raport.show',$row->id)}}">
                    <button class="btn btn-dark">
                        <i class="fas fa-cog"></i>  
                    </button>  
                </a>
            </div>
        </div>
    @endforeach
    <div>
        {{$reportFroshtn->links()}}
    </div>
</div>

<div id="addRaport" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button class="btn btn-light" data-dismiss="modal">X</button>
            </div>
            <div class="modal-body">
                {{-- form --}}
                <form action="" method="POST" class="ltr" action="{{route('raport.store')}}" id="form1">
                    <div class="allinput">
                        @csrf

                     
                        <div class="input-group mt-2">
                            <textarea class="form-control  text-center" maxlength="2000" rows="10" type="text" name="raport"></textarea>
                            <div class="input-group-prepend">
                              <span class="input-group-text" id=""> : ڕاپۆرت بنووسە</span>
                            </div>
                          </div>
                      
  
                    </div>
                   
                    <div class="col-12 errorMessage p-0 mt-2">
                      
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
                $('.successMess').append("<span class='badge badge-success col-12 mt-2 p-2'>زيادكرا<span>");
                $('.raports').prepend('<div class="col-12 p-2 m-2  bg-warning mx-auto rounded">'
                       + '<div class="col-12 text-right p-0 ltr">'
                        +    '<p class="badge badge-dark m-0 text-right"> <span>1 second ago</span> : بڵاوكراوەتەوە لە </p> '
                        +'</div>'
                        +'<div class="col-12 mx-auto text-center bg-dark rounded text-light p-2 m-2 rounded">'
                         +   "<span>"+response.newData+"</span>"
                        +"</div>"
                        +"<div>"
                         +  ' <button class="btn btn-dark" disabled>'
                          +    '  <a href="">'
                           +  '   <i class="fas fa-cog"></i>  '
                            +    '</a>'
                            +'</button>'
                       +' </div>'
                  +'  </div>'
                )

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