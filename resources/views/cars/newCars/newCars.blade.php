@extends('layouts.public')
@section('body')

<div class="custom-padding ">




    @if(count($companya)>0)
    <div class="row posts  mx-auto">
    @foreach($companya as $users)
    <a href="{{route('CR.show',$users->user_id)}}">
      <div class=" mt-2  border border-dark p-0" id="">
            <div class="col-12 mx-auto  p-1 LRD row animate__animated animate__backInRight ">
            <img src="../icons/computer.svg"  class="col-10 cl-sm-9 col-md-8 col-lg-6 d-block mx-auto" >
                <p class="badge-custom col-12 text-center LRD p-1">ناو : {{$users->username }}  </p>
                <p class="badge-custom2 col-12 text-center LRD p-1"> ژ.مۆبایل <br>{{$users->phone_number}} </p>
                <p class="badge-custom2 col-12 text-center LRD p-1"> تايبەتە بە <br>{{$users->company}} </p>
            </div>
        </div>  
    </a>
        
        
    @endforeach
 </div>
        {{$companya->links("vendor.pagination.default")}}
    

    @else
    <div class="col-12 col-md-6 mx-auto">
            <p class="badge-custom2 p-2 LRD text-center">هيچ كۆمپانیایەك بەردەست نییە</p>

    </div>
    @endif
    
   
</div>
@endsection