@extends('layouts.public')

@section('body')
<button class="customBtn btn-sm mr-3" onclick="back()">گەڕاندنەوە</button>
    <div class="col-12 row mb-4 mx-auto">
        @if(count($ashyas)>0)
            @foreach ($ashyas as $ashya)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3  mx-auto mb-2 bg-body LRD p-1 text-center  mt-2">
                <div class="col-12 borderH LRD">
                <p class="bg-head mt-2 gray LRD p-1">
                    <span> 
                        {{HTML::image('ashyaImage/'.$ashya->image,'posts',['class'=>'col-3 p-0 mx-auto rounded-circle  '])}}
                    </span>
                   {{$ashya->name}}
                </p> 
                
                <p class="p-0  s11 m-0">{{$ashya->address}}</p>
                <p class="p-0  s11 border-dark border-top m-0">ژ.مۆبایل : {{$ashya->phone_number}} </p>
                </div>
            </div>    
            @endforeach
        
        @endif       
    </div>

    <script>
        function back(){
            window.history.back();
        }
    </script>
@endsection
