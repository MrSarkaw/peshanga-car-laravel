@extends('layouts.public')
@section('body')
<div class="col-12 m-0">
    <button class="customBtn btn-sm mr-3" onclick="back()">گەڕاندنەوە</button>
</div>
<div class="col-12 col-sm-12   mx-auto row postResult
        animate__animated animate__zoomInUp custom-padding ">
        @if(count($cars)>0)
            @foreach ($cars as $car)
            <div class=" mt-2 mainCard p-2" id="">
                    <div class="col-12 mx-auto border border-dark p-1 row ">
                        <a href="{{route('carsView.show',$car->auto_id)}}" class="col-12 mx-auto p-0 row ">
                        <div class=" text-center alSee col-12 ">
                            <small class=" d-block mt-1 p-1 text-dark s10">
                                {{$car->main_sections->sec_name}}
                            </small>
                            <p class=" bg-head LRD col-12 p-2 col-12  mt-1 " >
                                {{$car->name}}
                            </p>
                        </div>
                        @foreach (explode('|',$car->images) as $img)
                                                            {{HTML::image('posts/'.$img,'posts',['class'=>'col-9 col-md-12 p-0 mx-auto d-block  img2'])}}
                    @php break; @endphp
                        @endforeach
                        <small class="badge badge-dark nrx mx-auto col-12 d-block mt-2 p-2">نرخ : <span>{{$car->price}}  $</span></small>
                        </a>
                    </div>
                </div>
        
            @endforeach  
        </div> 
     {{$cars->links("vendor.pagination.default")}}
       @else
        <div class="alert alert-warning col-12 mx-auto text-center" role="alert">
            بەردەست نییە
        </div>
        
    @endif

    <script>
        function back(){
            window.history.back();
        }
    </script>
 @endsection