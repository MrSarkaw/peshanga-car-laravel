@extends('layouts.public')
@section('body')

<div class="custom-padding ">
    <div class="col-12">
        <a class="customBtn btn-sm mr-3" href="{{url('/')}}">گەڕاندنەوە</a>
       </div>
    @if(session()->has('comp') || \Session::has('peshanga'))
    <form action="" method="POST" class="ltr"  id="form1">
        <div class="allinput">
            @csrf
            <div class="input-group col-12 col-md-6 mx-auto mb-3">
                <select class="form-control"  name="city_name" id="cities">
                    <option value=""></option>
                    @foreach($cities as $city)
                        <option value="{{$city->city_id}}">{{$city->city_name}}</option>
                    @endforeach
                </select>
                <div class="input-group-prepend">
                  <span class="input-group-text" id="">: شار دياری بكە</span>
                </div>
              </div>
        </div>
        @if(\Session::has('comp'))
        <p class="col-12 col-md-6 mx-auto badge-custom2 text-center p-2 LRD">ليستی كۆمپانیاكان</p> 
        @else
        <p class="col-12 col-md-6 mx-auto badge-custom2 text-center p-2 LRD">ليستی پێشانگاكان</p>
        @endif
        <div class="row posts  mx-auto view col-12" style="direction: rtl">
            
        </div>
      
    @endif
   
</div>



<script>
$('#cities').on('change',function (e) { 
    e.preventDefault();
    let data=$('#cities').val();
    $.ajax({
        type: "get",
        url: "/viewCompany/"+data,
        cache:false,
        processData:false,
        contentType:false,
        
        success: function (response) {
            if(response.content==0){
                $('.view').html(' <p class="badge-custom2 p-2 LRD text-center"> بەردەست نییە</p>');
            }else{
              $('.view').html(response.content);  
            }
            
        }
    });
    
});
</script>
@endsection