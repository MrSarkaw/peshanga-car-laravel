@extends('layouts.adminPanel')

@section('body')
<button class="btn btn-success mt-2 mb-2 ml-3" data-target="#addSponser" data-toggle="modal">+ زيادكردنی ڕیكلام</button>
<div class="col-8 
    col-sm-6 col-md-4 mt-4 mx-auto mess">
    
</div>
<div class="col-12 table-responsive mx-auto">
    <table class="col-12 text-center ">
        <thead>
            <tr>
                <th>وێنە</th>
                <th>زيادكردنی</th>
                <th>كاتی دروست بوون</th>
                <th>سڕاینەوە</th>
            </tr>
        </thead>
        
        <tbody>
            @foreach ($sponsers as $sponser)
            <tr id="{{$sponser->sponser_id}}">
                <th> {!! HTML::image('reklam/'.$sponser->image,null,['class'=>'col-12 icon mt-1 ']) !!}</th>
                <th>{{$sponser->user->username}}</th>
                <th class="ltr">{{$sponser->created_at->diffForHumans()}}</th>
                <th>
                    {!! Form::open(['method'=>"DELETE",'url'=>('sponser/'.$sponser->sponser_id),'class'=>'form2']) !!}
                        {!! Form::button('<i class="fas fa-trash"></i>',['type'=>'submit','class'=>'btn btn-danger text-dark']) !!}
                     {!! Form::close() !!}
                </th>
            </tr>
           @endforeach
           
        </tbody>
    </table> 
    <div class="mt-2">
        {{ $sponsers->links() }}
    </div>
    

   

   
<div id="addSponser" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button class="btn btn-light" data-dismiss="modal">X</button>
            </div>
            <div class="modal-body">
                {{-- form --}}
                <form action="" method="POST" class="ltr" action="{{route('sponser.store')}}" id="form1" enctype="multipart/form-data">
                    @csrf
                   
                    <div class="form-group">
                        <input class="form-control  text-center" placeholder="ناو" type="file" name="image">
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
        $( '.mess' ).html('');
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
                $('tbody').prepend(' <tr><th><img src="reklam/'+response.path+'" class="col-12 mt-1 icon rounded"></th>'
                                           +'<th>'+response.username.username+'</th><th class="ltr">1 second ago</th>'
                                           +'<th><button class="btn btn-danger text-dark" disabled><i class="fas fa-trash" ></i></button></th><tr>');
                                            
                                               
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

    $('.form2').submit(function(e){
        e.preventDefault()
        let formData=new FormData($(this)[0]);
        let url=$(this).attr('action');
        $.ajax({
            type:"post",
            url:url,
            data:formData,
            cache:false,
            processData:false,
            contentType:false,
            success:function(response){
               $('#'+response.id+'').remove();
               $( '.mess' ).html('<div class="alert alert-danger col-12 text-center">'
                                        +'سڕایەوە'
                                        +'</div>');
            }
        })
    })

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