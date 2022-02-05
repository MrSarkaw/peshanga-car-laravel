@extends('layouts.public')

@section('body')
<br> 
    <div class="col-12 pl-3 pr-3 mx-auto  text-center ">
        <div class="col-12   mx-auto ">
            <div class="col-12 lg hide row mx-auto s17 LRD p-0">
                    <div class="col-6   p-1">
                        <a href="{{route('LC','company')}}" class="">
                         <div class="col-12 LRD  borderH com p-2">
                                بۆ بینینی لیستی كۆمپانیاكان سەردانی ئێرە بكە
                         </div>
                        </a> 
                    
                    </div>
                    <div class="col-6  p-1 ">
                        <a href="{{route('LC','peshangakan')}}" class="">
                            <div class="col-12 borderH LRD pesh p-2">
                                    بۆ بینینی لیستی پێشانگاكان سەردانی ئێرە بكە   
                            </div> 
                       </a>
                    </div>
            </div>
           
            <div class="col-12 sm hide row mx-auto s17 LRD p-0">
                <div class="col-6   p-1">
                    <a href="{{route('LC','company')}}" >
                        <div class="col-12 LRD borderH com p-2">
                                لیستی كۆمپانیاكان 
                        </div>
                     </a>
                
                </div>
                <div class="col-6  p-1 ">
                    <a href="{{route('LC','peshangakan')}}" class="">
                        <div class="col-12 borderH LRD pesh  p-2">
                                لیستی پێشانگاكان    
                        </div> 
                    </a>
                </div>
        </div>
          

        </div>
        
    </div>
    
    <br>
    <div class="col-12  pl-4 pr-4 custom-padding animate__animated animate__zoomInUp  row cars mx-auto">
        @foreach ($sections as $section)
            <div class="mainCard mt-3 p-1">
          <a href="{{route('searchCar',$section->sec_id)}}" class=""> 
               <div class="col-12 card ">
                   {!! HTML::image('images/'.$section->image,null,['class'=>"card-img-top" ]) !!}
                    <p class="carBtn text-center p-1 s12">{{$section->sec_name}}</p> 
                </div> 
            </a>
        </div>  
        @endforeach
      

        {{-- <div class="mainCard mt-3 p-1">
            <a href="{{url('searchCars','taxi')}}" >
                <div class="col-12 card ">
                    <img class="card-img-top" src="wallpaper/taxi.png" alt="">
                   <p class="carBtn text-center p-1 s12">تاكسی</p> 
                </div> 
            </a>
        </div>
        <div class="mainCard mt-3 p-1">
            <a href="">
               <div class="col-12 card">
                <img class="card-img-top" src="wallpaper/barz.png" alt="">
                    <p  class="carBtn text-center p-1 s12">ئۆتۆمبێلی بەرز</p>
            </div> 
            </a>
             
        </div>
        <div class="mainCard mt-3 p-1">
            <a href="">
                <div class="col-12 card">
                <img class="card-img-top" src="wallpaper/grant.png" alt="">
                    <p class="carBtn text-center p-1 s12">ئۆتۆمبێلی گرانت</p>
            </div> 
            </a>
            
        </div>

        <div class="mainCard mt-3 p-1">
            <a href="">
                <div class="col-12 card">
                    <img class="card-img-top" src="wallpaper/wanawsha.png" alt="">
                        <p class="carBtn text-center p-1 s12">ئۆتۆمبێلی وەنەوشە</p>
                </div>
            </a>
        </div>

        
        <div class="mainCard mt-3 p-1">
            <a href="">
                 <div class="col-12 card">
                    <img class="card-img-top" src="wallpaper/pekab.png" alt="">
                        <p  class="carBtn text-center p-1 s12">پیکاب</p>
                </div> 
            </a>
           
        </div>

        <div class="mainCard mt-3 p-1">
            <a href="">
                 <div class="col-12 card">
                    <img class="card-img-top" src="wallpaper/pekabeDablKabena.png" alt="">
                        <p class="carBtn text-center p-1 s12">پیکابی دەبڵ کابینە </p>
                </div>
            </a>
            
        </div>


        
        <div class="mainCard mt-3 p-1">
            <a href="">
                  <div class="col-12 card">
                        <img class="card-img-top" src="wallpaper/pekabe7ml.png" alt="">
                            <p class="carBtn text-center p-1 s12">پیکابی حملی گاز</p>
                    </div> 
            </a>
          
        </div>

       
        
        <div class="mainCard mt-3 p-1">
            <a href="">
                <div class="col-12 card">
                    <img class="card-img-top" src="wallpaper/pas.png" alt="">
                        <p class="carBtn text-center p-1 s12">پاس</p>
                </div> 
            </a>
            
        </div>


        
        <div class="mainCard mt-3 p-1">
            <a href="">
                <div class="col-12 card">
                    <img class="card-img-top" src="wallpaper/kala.png" alt="">
                        <p class="carBtn text-center p-1 s12">كەلە</p>
                </div>
            </a>
             
        </div>


        
        <div class="mainCard mt-3 p-1">
            <a href="">
                <div class="col-12 card">
                    <img class="card-img-top" src="wallpaper/pshteTrela.png" alt="">
                        <p class="carBtn text-center p-1 s12">پشتی تڕێلە</p>
                </div> 
            </a>
        </div>


        
        <div class="mainCard mt-3 p-1">
            <a href="">
                <div class="col-12 card">
                    <img class="card-img-top" src="wallpaper/Ogawra.png" alt="">
                        <p href="" class="carBtn text-center p-1 s12"> ئوتومبێلی گەورە </p>
                </div> 
            </a>
        </div>

       
        
        
        <div class="mainCard mt-3 p-1">
            <a href="">
                <div class="col-12 card">
                    <img class="card-img-top" src="wallpaper/galaba.png" alt="">
                        <p class="carBtn text-center p-1 s12"> گەڵابە</p>
                </div>
            </a>
        </div>

       
        
        
        <div class="mainCard mt-3 p-1">
            <a href="">
                <div class="col-12 card">
                    <img class="card-img-top" src="wallpaper/kren.png" alt="">
                        <p class="carBtn text-center p-1 s12">  كرێن </p>
                </div>
            </a>
        </div>

         
        <div class="mainCard mt-3 p-1">
            <a href="">
                <div class="col-12 card">
                    <img class="card-img-top" src="wallpaper/benakare.png" alt="">
                        <p class="carBtn text-center p-1 s12">  ئامێری بیناکاری  </p>
                </div> 
            </a>
        </div>

         
        <div class="mainCard mt-3 p-1">
            <a href="">
                <div class="col-12 card">
                    <img class="card-img-top" src="wallpaper/kushtwkal.png" alt="">
                        <p class="carBtn text-center p-1 s12">   ئامێری كوشتوكاڵ  </p>
                </div>
            </a>
        </div>
 
        
        <div class="mainCard mt-3 p-1">
            <a href="">
                <div class="col-12 card">
                    <img class="card-img-top" src="wallpaper/karavan.png" alt="">
                        <p class="carBtn text-center p-1 s12"> کەرەڤان (Office) </p>
                </div>
            </a> 
        </div>

       
        
        
        <div class="mainCard mt-3 p-1">
            <a href="">
                <div class="col-12 card">
                    <img class="card-img-top" src="wallpaper/moleda.png" alt="">
                        <p class="carBtn text-center p-1 s12"> مۆلیدات  </p>
                </div>
            </a>
        </div>

         
        <div class="mainCard mt-3 p-1">
            <a href="">
                <div class="col-12 card">
                    <img class="card-img-top" src="wallpaper/taya.png" alt="">
                        <p class="carBtn text-center p-1 s12"> تایە و ویل  </p>
                </div> 
            </a>
        </div>

         
        <div class="mainCard mt-3 p-1">
            <a href="">
                <div class="col-12 card">
                    <img class="card-img-top" src="wallpaper/parcha.png" alt="">
                        <p class="carBtn text-center p-1 s12">   پارچەی یەدەکی جۆراوجۆر   </p>
                </div>
            </a> 
        </div> --}}
    </div>

    <script>
        
    </script>
@endsection