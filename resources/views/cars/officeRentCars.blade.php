@extends('layouts.public')
@section('body')

<div class="custom-padding ">
    @if(count($offices)>0)
    <div class="row posts  mx-auto">
        @foreach($offices as $office)
        <div class=" mt-2  border border-dark p-0" id="">
            <div class="col-12 mx-auto  p-1 LRD row animate__animated animate__backInRight ">
                  {{HTML::image('icons/computer2.svg',null,['class'=>'col-10 cl-sm-9 col-md-8 col-lg-6 d-block mx-auto'])}}
                  <p class="badge-custom col-12 text-center LRD p-1"> ناو : {{$office->name}} </p>
                  <p class="badge-custom col-12 text-center LRD p-1"> ژ.مۆبایل : {{$office->phone_number}} </p>
                  <p class="badge-custom2 col-12 p-2 text-center LRD"> ناونيشان 
                      <br> {{$office->address}} </p>
            </div>
        </div>
        @endforeach
    </div>
        {{$offices->links("vendor.pagination.default")}}
    

    @else
    <div class="col-12 col-md-6 mx-auto">
            <p class="badge-custom2 p-2 LRD text-center">هيچ ئۆفیسێك بەردەست نییە</p>

    </div>
    @endif
    
   
</div>
@endsection