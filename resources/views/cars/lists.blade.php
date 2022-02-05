@extends('layouts.public')
@section('body')

<div class="custom-padding ">




    @if(count($automobiles)>0)
    <div class="row posts  mx-auto">
    @foreach($automobiles as $auto)
    <div class=" mt-2  border border-dark p-0" id="">
        <div class="col-12 mx-auto  p-1 LRD row animate__animated animate__backInRight ">
            <a href="{{route('carsView.show',$auto->auto_id)}}" class="col-12 mx-auto p-0 row ">
            <div class=" text-center alSee col-12 p-0">
                <small class=" d-block mt-1 p-1 text-dark s10">
                    {{$auto->main_sections->sec_name}}
                </small>
                <p class=" bg-head LRD col-12 p-2 col-12  mt-1 " >
                    {{$auto->name}}
                </p>
            </div>
            @foreach(explode('|',$auto->images) as $row)
            {{HTML::image('posts/'.$row,'posts',['class'=>'col-12 p-0 mx-auto d-block LRD img2'])}}
            @php break; @endphp
            @endforeach
            <small class="badge badge-dark nrx mx-auto col-12 d-block mt-2 p-2">نرخ : <span>{{$auto->price}}  $</span></small>
            </a>
        </div>
    </div>
    @endforeach
 </div>
        {{$automobiles->links("vendor.pagination.default")}}
    

    @else
    <div class="col-12 col-md-6 mx-auto">
            <p class="badge-custom2 p-2 LRD text-center">هيچ ئۆتۆمبێلێك بەردەست نییە</p>

    </div>
    @endif
    
   
</div>
@endsection