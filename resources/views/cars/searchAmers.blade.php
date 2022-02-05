@extends('layouts.public')
@section('body')
    <div class="custom-padding">
        <div class="col-12">
        <a class="customBtn btn-sm mr-3" href="{{url('/')}}">گەڕاندنەوە</a>
        </div>
        <div class="col-12 col-sm-9 col-md-6 p-2  text-center mx-auto special1 s12  LRD mt-1  " >
        
            
            {!! Form::open(['method'=>'get','url'=>('getAmer')])!!}
                <div class="col-12 row p-0 mx-auto  shadow-lg">

                    <div class="col-12 col-sm-6   mx-auto text-center ">
                        <div class="col-12 p-0 mx-auto">
                            
                            <label class="badge  badge-custom2 p-1 col-12 row">
                            <img src="../icons/one.svg" class="PCIcons" alt=""> <span class="l1">--></span>                       
                            </label>

                            <label  class="badge badge-custom p-1 col-12">
                                <img src="../icons/bridge.svg" class="ic"  alt="">
                                شار دیاری بكە</label>
                            <div class="form-group">
                                <select id="city_id" class="form-control cities" name="">
                                    <option value=''>-----</option>
                                    @foreach ($cities as $city)
                                        <option value="{{$city->city_id}}">{{$city->city_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6   mx-auto text-center">
                        <div class="col-12 p-0 mx-auto">
                            <label  class="badge badge-custom2  p-1 col-12 row">
                                <img src="../icons/two.svg" class="PCIcons" alt="">                    
                            </label>
                            <label for="car" class="badge badge-custom p-1 col-12">
                                <img src="../icons/taxi.svg" class="ic"  alt="">
                                ناوی ئامێر</label>
                           
                                    <select class="form-control" 
                                             name="name" id="names" >
                                        
                                     </select>
                             
                           
                        </div>
                    </div>

                </div> 
                

                <button  class="btn btn-primary btn-sm btn-block">گەڕان</button>
                
            {!! Form::close() !!}
            
                    
            
                
        </div>

         
      
        
    </div>
    
    
   
  
  <script>
             $('.select2').select2();
       
          $('.cities').on('change',()=>{
            let name=$('.cities').val();
            $('#names').html(null);
            $('.postResult').html(null);
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
                            $('#names').append(response.success);
                        }else{
                            $('#names').append("<option>بەردەست نییە</option>");
                        }
                            
                    
                    }
                    }
                })   
            }
            
        })
     
       

      

        function back() { 
            window.history.back();
         }
   </script>
@endsection
