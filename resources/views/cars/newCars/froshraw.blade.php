@extends('layouts.public')
@section('body')
<div class="LRD badge-custom2 text-center col-12 col-md-6 m mx-auto text-center p-2">
     ڕاپۆرتی كۆمپانیاكان و پێشانگاكان
</div>
<div class="col-12 col-sm-12  mx-auto row postResult
        animate__animated animate__zoomInUp custom-padding ">
    @foreach($froshtn as $row)
        <div class="col-12 p-2 m-2  mt-4 mx-auto border border-dark shadow-lg LRD">
            <div class="col-12 text-right p-0 ltr">
                <p class="badge badge-custom2 m-0 text-right"> <span>{{$row->created_at->diffForHumans()}}</span> : كات  </p> 
                <p class="badge badge-custom2 m-0 text-right"> <span>{{$row->user->username}}</span> : بڵاوكراوەتەوە لە لايەن</p> 

            </div>
            <div class="col-12 mx-auto text-center bg-body  text-dark p-2 m-2 LRD">
                <span> {{$row->raport}}</span>
            </div>
           
        </div>
    @endforeach
</div>
{{$froshtn->links("vendor.pagination.default")}}

@endsection