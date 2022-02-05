@extends('layouts.public')
@section('body') 
<div>
    <a href="{{route('searchCar',$sec)}}" class="customBtn btn-sm mr-3" onclick="back()">گەڕاندنەوە</a>
</div>
                <div class="col-12 col-sm-12 mt-5  mx-auto row postResult
                animate__animated animate__zoomInUp custom-padding">

                @if(count($amers)>0)        
                    @foreach ($amers as $auto)
                        <div class=" mt-2 mainCard p-2" id="">
                            <div class="col-12 mx-auto border border-dark p-1 row ">
                                <a href="resultAmer/{{$auto->id}}" class="col-12 mx-auto p-0 row ">
                                <div class=" text-center alSee col-12 ">
                                    <small class=" d-block mt-1 p-1 text-dark s10">
                                        {{$auto->main_sections->sec_name}}
                                    </small>
                                    <p class=" bg-head LRD col-12 p-2 col-12  mt-1 " >
                                        {{$auto->name}}
                                    </p>
                                </div>
                                @foreach (explode('|',$auto->images) as $img)
                                                                    {{HTML::image('posts/'.$img,'posts',['class'=>'col-9 col-md-12 p-0 mx-auto d-block  img2'])}}
                            @php break; @endphp
                                @endforeach
                                <small class="badge badge-dark nrx mx-auto col-12 d-block mt-2 p-2">نرخ : <span>{{$auto->price}}  $</span></small>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
   



                </div>


@endSection