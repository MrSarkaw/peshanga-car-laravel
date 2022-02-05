@extends('layouts.public')
@section('body')
    <div class="col-12">
     <a class="customBtn btn-sm mr-3" href="{{url('/')}}">گەڕاندنەوە</a>
    </div>
    <div class="col-12 text-center mx-auto s12 special1" >
        <button class="customBtn searchTaybat ">گەڕانی تایبەت ئەنجام بدە</button>

        <br>
        
        {!! Form::open(['method'=>'get','url'=>('resultCars')])!!}
            <div class="col-12 row p-0 mx-auto pb-5 ">

                <div class="col-12 col-sm-6 col-md-3 col-lg-2 mt-4 mx-auto text-center ">
                    <div class="col-12 p-0 mx-auto">
                        
                        <label class="badge  badge-custom2 p-1 col-12 row">
                           <img src="../icons/one.svg" class="PCIcons" alt=""> <span class="l1">--></span>                       
                        </label>

                        <label  class="badge badge-custom p-1 col-12">
                            <img src="../icons/bridge.svg" class="ic"  alt="">
                            شار دیاری بكە</label>
                        {!! Form::select('city_id',[''=>'----']+$cities,
                                            true,['class'=>'form-control cities']) !!}
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3 col-lg-2 mt-4 mx-auto text-center">
                    <div class="col-12 p-0 mx-auto">
                        <label  class="badge badge-custom2  p-1 col-12 row">
                            <img src="../icons/two.svg" class="PCIcons" alt=""> <span class="l1">--></span>                    
                         </label>
                        <label for="car" class="badge badge-custom p-1 col-12">
                            <img src="../icons/taxi.svg" class="ic"  alt="">
                             ئۆتۆمبیل</label>
                        {!! Form::select('companies',[],
                                            true,['class'=>'form-control','id'=>'companies']) !!}
                    </div>
                </div>

                <div class="col-12 col-sm-9 col-md-3 col-lg-2 mt-4 mx-auto text-center">
                    <div class="col-12 p-0 mx-auto">
                        <label  class="badge badge-custom2  p-1 col-12 row">
                            <img src="../icons/three.svg" class="PCIcons" alt=""> <span class="l1">--></span>                       
                         </label>
                        <label for="jor" class="badge badge-custom p-1 col-12">
                            <img src="../icons/wheel.svg" class="ic"  alt="">
                             جۆری ئۆتۆمبیل</label>
                        {!! Form::select('automobiles',[],
                                            true,['class'=>'form-control auto automobiles']) !!}
                    </div>
                </div>


                <div class="col-12 col-sm-6 col-md-3 col-lg-2 mt-4 mx-auto text-center">
                    <div class="col-12 p-0 mx-auto row">
                        <label  class="badge badge-custom2  p-1 col-12 row mx-auto">
                            <img src="../icons/four.svg" class="PCIcons" alt=""> <span class="l1">--></span>                       
                         </label>
                        <label  class="badge badge-custom p-1 col-12">
                            <img src="../icons/model.svg" class="ic"  alt="">
                             مۆدێل</label>
                        <div class="col-12 col-md-6">
                            <div class="col-12 p-0">
                                 {!! Form::select('minModel',[],
                                            true,['class'=>'form-control minModel']) !!}
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="col-12 p-0">
                                 {!! Form::select('maxModel',[],
                                            true,['class'=>'form-control maxModel']) !!}
                            </div>
                        </div>
                       
                    </div>
                </div>


                
                <div class="col-12 col-sm-6 col-md-6 col-lg-2 mt-4 mx-auto text-center">
                    <div class="col-12 p-0 mx-auto row">
                        <label  class="badge badge-custom2  p-1 col-12 row mx-auto">
                            <img src="../icons/five.svg" class="PCIcons" alt="">                       
                         </label>
                        <label  class="badge badge-custom p-1 col-12">
                            <img src="../icons/automobile.svg" class="ic"  alt="">
                            نرخ
                        </label>
                        <div class="col-12 col-md-6">
                            <div class="col-12 p-0">
                                 {!! Form::select('minPrice',[],
                                            true,['class'=>'form-control minPrice']) !!}
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="col-12 p-0">
                                 {!! Form::select('maxPrice',[],
                                            true,['class'=>'form-control maxPrice']) !!}
                            </div>
                        </div>
                       
                    </div>
                </div>
                
               
                <div class="col-12 mx-auto mt-4">
                    <div class="col-12 col-md-6 col-lg-2 mx-auto text-center">
                        <label  class="badge badge-custom2  p-1 col-12 row mx-auto">
                            <img src="../icons/six.svg" class="PCIcons" alt="">                       
                         </label>
                        {{form::button('<img src="../icons/search.svg" class="icons2"> گەڕان',
                        ['type'=>'submit','class'=>'customBtn btn-block'])}}
                    </div>
                 
                </div>      


            </div> 
            
            
         {!! Form::close() !!}
        

        
            
    </div>

    <div class="col-12 col-md-6 mx-auto text-center">
             @foreach ($errors->all() as $error)
                 <p class="alert alert-danger mt-2">{{$error}}</p>
             @endforeach
         </div>
   <script>
          $('.cities').on('change',()=>{
            let name=$('.cities').val();

            $('#companies').html(null);
            $('.auto').html(null);
            if(name!=''){
                $.ajax({
                    type: "get",
                    cache:false,
                    processData:false,
                    contentType:false,
                    url:'/getCompanies/'+name,
                    success:function(response){
                    if(response){
                        if(response.success!=null){
                            $('#companies').append(response.success);
                        }else{
                            $('#companies').append("<option>بەردەست نییە</option>");
                        }
                            
                    
                    }
                    }
                })   
            }
            
        })
        $('#companies').on('change',()=>{
            let id=$('#companies').val();
            $('.auto').html(null);
            if(id != ''){
             $.ajax({
                type: "get",
                cache:false,
                processData:false,
                contentType:false,
                url:'/getAutomobiles/'+id,
                success:function(response){
                if(response){
                    if(response.success!=''){
                        $('.auto').append(response.success);
                    }
                  }
                }
            })   
            }
            
        })
        $('.automobiles').on('change',()=>{
            $('.minModel').html(null);
            $('.maxModel').html(null);
            let name=$('.automobiles').val();
            if(name != ''){
             $.ajax({
                type: "get",
                cache:false,
                processData:false,
                contentType:false,
                url:'/getModel/'+name,
                success:function(response){
                if(response){
                    if(response.success!=''){
                        $('.minModel').append('<option value=""> نزمترين مۆدێل هەڵبژێرە</option>');
                        $('.maxModel').append('<option value=""> بەرزترین مۆدێل هەڵبژێرە</option>');
                        $('.minModel').append(response.success);
                        $('.maxModel').append(response.success);
                    }
                  }
                }
            })   
            }
            
        })
        


        $('.maxModel').on('change',()=>{
          modelMinMax();
        })

        $('.minModel').on('change',()=>{
          modelMinMax();
        })

        function modelMinMax(){
            $('.minPrice').html(null);
            $('.maxPrice').html(null);
            let min=$('.minModel').val();
            let max=$('.maxModel').val();
             if( min != '' && max != ''){
                $.ajax({
                    url:'/getPrice/'+min+'/'+max+'',
                    processData:false,
                    contentType:false,
                    cache:false,
                    type:'get',
                    success:function(response){
                        if(response.success == null){
                            alert("r");
                        }
                        $('.minPrice').append('<option value=""> نزمترين نرخ هەڵبژێرە</option>');
                        $('.maxPrice').append('<option value=""> بەرزترین نرخ هەڵبژێرە</option>');
                        $('.minPrice').append(response.success);
                        $('.maxPrice').append(response.success);
                    }
                })
           }
        }

        function back() { 
            window.history.back();
         }
   </script>
@endsection
