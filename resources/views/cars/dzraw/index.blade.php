@extends('layouts.public')
@section('body')

<div class="LRD badge-custom2 text-center col-12 mx-auto text-center p-2">
    لەكاتی دزینی سەیارەكانتان ئەتوانن پەیوەندیمان پێوە بكەن و بڵاوی بكەینەوە لەناو وێبسایتەكە ، تا ئاگاداربن و كڕین و فرۆشتنی پێوە نەكەن
</div>
<div class="col-12 col-sm-12   mx-auto row postResult
        animate__animated animate__zoomInUp custom-padding ">
    @foreach($dzraw as $row)
        <div class="col-12 p-2 m-2  mx-auto border border-dark shadow-lg mt-5 LRD">
            <div class="col-12 text-right p-0 ltr">
                <p class="badge bg-body m-0 text-right"> <span>{{$row->created_at->diffForHumans()}}</span> : كات  </p> 

            </div>
            <div class="col-12 mx-auto text-center bg-body  text-dark p-2 m-2 LRD">
                <span> {{$row->raport}}</span>
            </div>
           
        </div>
    @endforeach
</div>
{{$dzraw->links("vendor.pagination.default")}}

@endsection