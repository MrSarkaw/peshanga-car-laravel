@extends('layouts.public')
@section('body')
    <div class="col-12">
        
        <a href="{{route('searchCar',$sec)}}" class="customBtn btn-sm mr-3" onclick="back()">گەڕاندنەوە</a>
        <button class="btn-sm customBtn hide" id="btnPeshanga">ئەشیاكان</button>
        <button class="btn-sm customBtn hide" id="btncars">پیشاندانی سەیارەكان</button>
    
    </div>
    
    <div class="col-8 float-right mt-4 mx-auto row dvPost  
                 animate__animated animate__jello custom-padding">
        
        
                 {{-- cars --}}
        <div class="col-12 postResult row mx-auto mb-5  custom-padding">


            <div class="col-12 grids  mx-auto LRD p-2 gray bg-head text-center ">
                {{HTML::image('icons/gridBox.svg','icon',['class'=>'grid float-right mr-3','id'=>'box'])}}
                {{HTML::image('icons/gridR.svg','icon',['class'=>'grid','id'=>'square'])}}
                {{HTML::image('icons/gridList.svg','icon',['class'=>'grid float-left ml-2','id'=>'grid'])}}
        
            </div>

            @if(count($automobiles)>0)
                @foreach ($automobiles as $auto)
                    <div class="col-6  col-md-4 col-lg-3 mt-2 p-1 mainCar  " id="">
                        <div class="col-12 mx-auto p-1 mt-2 row  animate__animated animate__backInRight mainDivCar">
                            <a href="{{route('carsView.show',$auto->auto_id)}}" class="col-12 mx-auto p-0 row ">
                                @foreach (explode('|',$auto->images) as $img)
                                      {{HTML::image('posts/'.$img,'posts',['class'=>'col-3 p-0 mx-auto d-block hide img'])}}
                                  @php break; @endphp
                                @endforeach
                            <div class=" text-center alSee col-12 ">
                                <small class=" d-block mt-1 p-1 text-dark s10">
                                   {{$auto->main_sections->sec_name}}
                                </small>
                                <p class=" bg-head LRD col-12 p-2  s10 text-center mt-1 " >
                                    {{$auto->name}}
                                </p>
                            </div>
                            <div class="col-5 text-right mx-auto details hide">
                                <span class="badge badge-dark col-12 p-2 text-center mt-1 " >
                                {{HTML::image('icons/model.svg','icon',['class'=>'ic'])}}  
                                 مۆدێل : {{$auto->model}} 
                                </span>
                               
                                <span class="badge badge-dark col-12 p-2 text-center mt-1 " >
                                    {{HTML::image('icons/car-plate.svg','icon',['class'=>'ic'])}} ڕەقەم : {{$auto->city_name}}
                                </span>
                                <span class="badge badge-dark col-12 p-2 text-center mt-1">
                                    نرخ : <span>{{$auto->price}}  $</span>
                                </span>
                            </div>
                            @foreach (explode('|',$auto->images) as $img)
                            {{HTML::image('posts/'.$img,'posts',['class'=>'col-9 col-md-12 p-0 mx-auto d-block  img2'])}}
                            @php break; @endphp
                            @endforeach
                            <small class="badge badge-dark nrx mx-auto col-12 d-block mt-2 p-2">نرخ : <span>{{$auto->price}}   $</span></small>
                            </a>
                        </div>
                    </div>
                @endforeach
        
           @else

            <p class="alert alert-primary LRD mt-2 text-center p-2 mx-auto col-12">نەدۆزرایەوە</p>
           @endif
           
               <div class="col-12">
                   {{$automobiles->appends(request()->input())->links('pagination::default')}}
                </div>
        </div>
           
    </div>
        {{-- peshanga --}}
        <div class="col-12 float-left col-md-4 mx-auto  mt-3 custom-padding
           row border-right border-dark  animate__animated animate__backInLeft"
         id="peshanga" style="margin-bottom: 70px;">
            <div class="col-12 mb-2 bg-head LRD">
             
                    @foreach ($ashya as $ash)
                        <p href="" class="text-center bg-body LRD p-2  badge-custom2 title mt-2">
                            <a href="{{route('ashya.show',$ash->car)}}" > 
                            بۆ بینینی ئەشیای {{$ash->car}} كلیك بكە
                            </a>
                        </p>
                    @endforeach
                
                @foreach ($sponser as $sponsers)
                        {!! HTML::image('reklam/'.$sponsers->image,'sponsers',['class'=>'col-12 mt-1']) !!}
                @endforeach

                
            </div>
        </div>
        


    <script>
        $(document).ready(()=>{
            $('#grid').on('click',function () { 
                $('.mainCar').removeClass('col-6 col-md-6  col-md-4 col-lg-3 ');
                $('.mainCar').addClass('col-12 mx-auto');
                $('.img').removeClass('hide');
                $('.img').removeClass('col-md-8');
                $('.alSee').removeClass('col-12 text-center mx-auto');
                $('.img2').addClass('hide');
                $('.details').removeClass('hide');
                $('.nrx').addClass('hide');
                $('.mainDivCars  small').removeClass('d-block badge badge-custom');
          })

             $('#box').on('click',function () { 
                $('.posts').addClass('row');
                $('.mainCar').addClass('col-6  col-md-4 col-lg-3 ');
                $('.mainCar').removeClass('col-12 col-10 col-md-6 mx-auto');
                $('.img').addClass('hide');
                $('.alSee').addClass('col-12 text-center mx-auto');
                $('.img2').removeClass('hide');
                $('.details').addClass('hide');
                $('.nrx').removeClass('hide');
                $('.mainDivCars  small').addClass('d-block badge badge-custom');
             })

             $('#square').on('click',function () { 
                $('.posts').removeClass('row');
                $('.mainCar').addClass('col-md-6 mx-auto');
                $('.mainCar').removeClass('col-10 col-md-4 col-lg-3');
                $('.img2').addClass('hide');
                $('.alSee').addClass('col-12 text-center mx-auto');
                $('.img').addClass('col-md-8')
                $('.img').removeClass('hide');
                $('.nrx').removeClass('hide');
                $('.details').addClass('hide');
                $('.mainDivCars  small').addClass('d-block badge badge-custom');
             })
        })
       
       
        function checkWidth2(){
            let size=$(window).width();
            if(size>=768){
                $('#btnPeshanga').addClass('hide');
                $('#btncars').addClass('hide');
                $('.dvPost').removeClass('hide');
                $('#peshanga').removeClass('hide');
                $('#peshanga').addClass('col-md-4');
                $('.dvPost').addClass('col-8');
                $('.dvPost').removeClass('col-12');
                $('#square').removeClass('hide');
                

            }else{
                $('.dvPost').addClass('col-12');
                $('.title').removeClass('gray')
                $('#peshanga  div div').addClass('border border-dark')
                $('.title').addClass('Blue')
                $('#square').addClass('hide');
            }
        }
        checkWidth2();

        $(window).resize(function() {
        this.checkWidth2();
        })

        function back() { 
            window.history.back();
         }
        
         $('#btnPeshanga').on('click',()=>{
            $('.dvPost').addClass('hide');
            $('#peshanga').removeClass('hide border-right border-dark');
            $('#btnPeshanga').addClass('hide');
            $('#btncars').removeClass('hide');
        })

        $('#btncars').on('click',()=>{
            $('#peshanga').addClass('hide');
            $('.dvPost').removeClass('hide');
            $('#btnPeshanga').removeClass('hide');
            $('#btncars').addClass('hide');
        })

        let size2=$(window).width();
        if(size2<768){
            $('#btnPeshanga').removeClass('hide');
            $('#peshanga').addClass('hide');
        }
    </script>
@endsection