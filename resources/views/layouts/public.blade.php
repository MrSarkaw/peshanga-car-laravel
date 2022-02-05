<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
         {{ HTML::style('css/public.css') }}
         <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> 
         <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
         <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
         
    </head>
    <body>
    <div style=" position: relative;" >
        <div class="col-12 p-0 main" style="overflow:hidden" >
            {{-- logo --}}
            <div class=" p-3 col-12  secColor afterMain" >
                <div class="row searchAndLogo">
                    <div class="col-7 col-sm-6 col-md-4 col-lg-3 mb-3 divLogo">
                        <a href="{{url('/')}}">
                             {{ HTML::image('logo/logo4-1.png','logo'
                                                ,array('class'=>' imgLogo p-2 bg-body LRD ')) }}
                         </a> 
                    </div>
                    <div class="col-12 text-center lang2 hide mb-2   s11" >
                        <div class="col-12 mx-auto">
                            <a href="/login" class="p-1 badge badge-custom3 col-7 col-sm-6 col-md-4 col-lg-3 p-2 s15">شێوازی داغڵ بوون</a>
                          </div>
                          
                          <div class="col-12 mx-auto mt-2">
                                <a href="" class="border-left border-light p-1">english</a>
                                <a href="" class="border-left border-light p-1">عربی</a>
                                <a href="" class="p-1">كوردی</a>
                          </div>
                    </div>
                                    
                                
                    {{-- header --}}
                    <div class="col-12 col-sm-9 col-md-6 p-2  hide mx-auto text-center bg-body LRD "
                    id="MenuSearch">
                            <button class="btn btn-p col-3  RD" id="menu">
                                {{ HTML::image('icons/list.svg'
                                ,'icon'
                                ,array('class'=>'icons2')) }} 
                            </button>
                            <button class="btn btn-p col-3 RD" id="search">
                                {{ HTML::image('icons/search.svg'
                                ,'icon'
                                ,array('class'=>'icons2')) }}   
                            </button>
                        
                                            
                    </div>
                      
                    {{-- search --}}
                    <div class="col-12 col-sm-9 col-md-7  mx-auto divSearch  text-center mt-1  LRD hide CustomePos">
                          <div class="col-12 text-left lang hide row s11">
                            <div class="col-6 text-left mb-2">
                                <a href="/login" class="p-1 badge badge-custom3 s16">شێوازی داغڵ بوون</a>
                              </div>
                              
                              <div class="col-6 mx-auto text-left">
                                    <a href="" class="border-left border-light p-1">english</a>
                                    <a href="" class="border-left border-light p-1">عربی</a>
                                    <a href="" class="p-1">كوردی</a>
                              </div>
                              
                            

                        </div>
                        {!! Form::open(['method'=>'get','url'=>'','class'=>'col-12 p-0']) !!}
                            <div class=" search row mx-auto p-0 bg-body ">
                                
                                <div class="col-9 p-0  thridColor mx-auto">
                                    
                                    <input type="text" name="" class="col-8 text-center" id="inpSearch" placeholder="بگەڕێ بۆ ناوی سەیارە">
                                    <select id="selectSearch" class="col-3  p-1  d-inline" name="nameOfComp">
                                        @foreach ($nameOfComp as $comp)
                                        <option value="{{$comp->comp_id}}">{{$comp->comp_name}}</option> 
                                        @endforeach
                                        
                                    </select>
                                

                                </div>
                                {!! form::button(HTML::image('icons/search2.svg','icons',['class'=>'iconsSearch']),['type'=>'submit']) !!}
                                
                            </div>  
                        {!! Form::close() !!} 
                    </div>
                    <div class="col-8 col-sm-7 col-md-5 text-dark boxSearch hide ">
                        
                    </div>
                </div>
                
                
                {{-- menu --}}
                <div class=" mx-auto divmenu1 hide text-center menu2 bg-body p-0 LRD ">
                    <ol class="large mt-2 p-0">
                        <li>
                            {{HTML::image('icons/home.svg','icons',['class'=>'icons'])}}
                            <a href="{{url('/')}}">ماڵەوە</a>
                        </li>
                       
                        <li>
                            {{HTML::image('icons/car.svg','icons',['class'=>'icons'])}}
                            <a href="{{route('CR.index')}}">سەیارەی نوێ</a>
                        </li>

                        <li>
                            {{HTML::image('icons/key.svg','icons',['class'=>'icons'])}}
                            <a href="{{route('froshraw')}}">سەیارەی فرۆشراو</a>
                        </li>

                        <li>
                            {{HTML::image('icons/ch-car.svg','icons',['class'=>'icons'])}}
                            <a href="/shahn">سەیارەی شەحن</a>
                        </li>
                        

                        <li>
                            {{HTML::image('icons/money.svg','icons',['class'=>'icons'])}}
                            <a href="/qist">سەیارەی قيست</a>
                        </li>
                        

                        <li>
                            {{HTML::image('icons/open.svg','icons',['class'=>'icons'])}}
                            <a href="{{route('dzraw')}}">سەیارەی دزراو</a>
                        </li>
                        
                     
                       <li>
                            {{HTML::image('icons/calendar.svg','icons',['class'=>'icons'])}}
                            <a href="{{route('weeklyCars')}}">سەیارەی هەفتە</a>
                        </li>
                        <li>
                            {{HTML::image('icons/computer.svg','icons',['class'=>'icons'])}}
                            <a href="{{route('officeCar')}}">نووسینگەی بەكرێدانی ئۆتۆمبیل</a>
                        </li>

                        <li>
                            {{HTML::image('icons/question.svg','icons',['class'=>'icons'])}}
                            <a href="#">دەربارە</a>
                        </li>
                        <li>
                            {{HTML::image('icons/contact-us.svg','icons',['class'=>'icons'])}}
                            <a href="#">پەیوەندی</a>
                        </li>
                       
                    </ol>
                </div>

               

            </div>
            

          
           

            <div class="col-12 col-sm-11  mx-auto mt-3 mb-5 pb-5  p-0">
                @yield('body')
            </div>
        </div>
        {{-- menu respons --}}
        <div class=" p-3 col-12 mx-auto menu menuPos1 secColor " style="z-index:1">
            <button class="btn btn-light" id="closeMenu">X</button>
            <div class="col-12 col-sm-9 col-md-4 mx-auto mt-2 text-center">
                <ol class="large p-2">
                   
                    <li>
                        {{HTML::image('icons/home.svg','icons',['class'=>'icons'])}}
                        <a href="{{url('/')}}">ماڵەوە</a>
                    </li>
                   
                    <li>
                        {{HTML::image('icons/car.svg','icons',['class'=>'icons'])}}
                        <a href="{{route('CR.index')}}">سەیارەی نوێ</a>
                    </li>

                    <li>
                        {{HTML::image('icons/key.svg','icons',['class'=>'icons'])}}
                        <a href="{{route('froshraw')}}">سەیارەی فرۆشراو</a>
                    </li>

                    <li>
                        {{HTML::image('icons/ch-car.svg','icons',['class'=>'icons'])}}
                        <a href="/shahn">سەیارەی شەحن</a>
                    </li>
                    

                    <li>
                        {{HTML::image('icons/money.svg','icons',['class'=>'icons'])}}
                        <a href="/qist">سەیارەی قيست</a>
                    </li>
                    

                    <li>
                        {{HTML::image('icons/open.svg','icons',['class'=>'icons'])}}
                        <a href="{{route('dzraw')}}">سەیارەی دزراو</a>
                    </li>
                    
                 
                   <li>
                        {{HTML::image('icons/calendar.svg','icons',['class'=>'icons'])}}
                        <a href="{{route('weeklyCars')}}">سەیارەی هەفتە</a>
                    </li>
                    <li>
                        {{HTML::image('icons/computer.svg','icons',['class'=>'icons'])}}
                        <a href="{{route('officeCar')}}">نووسینگەی بەكرێدانی ئۆتۆمبیل</a>
                    </li>

                    <li>
                        {{HTML::image('icons/question.svg','icons',['class'=>'icons'])}}
                        <a href="#">دەربارە</a>
                    </li>
                    <li>
                        {{HTML::image('icons/contact-us.svg','icons',['class'=>'icons'])}}
                        <a href="#">پەیوەندی</a>
                    </li>
                   
                </ol>
            </div>
        </div>

        {{-- footer --}}

        <div class=" p-3 col-12   secColor text-center"
         style="position:absolute;bottom:0;">
         <p> Copyright © 2020 Peshangakan</p>
         <p class="s11"> Developed by DOT Vision Company for IT Solutions and Software Systems</p>
        </div>
    </div>
    </body>
</html>
 <script>

    $(window).resize(function() {
        this.getSizeWindows();
        })
    getSizeWindows();

                function getSizeWindows() {
                            let widthWindow=$(window).width();
                        if(widthWindow < 1216){
                            $('#MenuSearch').removeClass('hide');
                            $('.menu2').addClass('hide');
                            $('.searchAndLogo').removeClass('row');
                            $('.lang').addClass('hide');
                            $('.lang2').removeClass('hide');
                            $('.divSearch').removeClass('CustomePos');
                            $('.lg').addClass('hide');
                            $('.sm').removeClass('hide');
                         
                        }
                        if(widthWindow >= 1216){
                            $('#MenuSearch').addClass('hide');
                            $('.menu2').removeClass('hide'); 
                            $('.searchAndLogo').addClass('row');
                            $('.lang').removeClass('hide');
                            $('.lang2').addClass('hide');
                            $('.divSearch').addClass('CustomePos'); 
                            $('.lg').removeClass('hide');
                            $('.sm').addClass('hide');
                        }
              }

            $(document).ready(function () { 
                $('#search').on('click',function () { 
                    if($('.divSearch').hasClass('hide')){
                        $('.divSearch').removeClass('hide');    
                    }else{
                        $('.divSearch').addClass('hide');    
                    }
                    
                })

                $('#menu').on('click',function () { 
                    $('.menu').removeClass('menuPos1');
                    $('.menu').addClass('menuPos2');
                    $('body').addClass('ovH');
                })
                $('#closeMenu').on('click',function () { 
                    $('.menu').removeClass('menuPos2');
                    $('.menu').addClass('menuPos1');
                    $('body').removeClass('ovH');
                })

                let numberAnimation=0;
                setInterval(()=>{
                    if(numberAnimation==0){
                        $('.peshanga').removeClass('hide');
                        $('.companya').addClass('hide');
                        numberAnimation=1;
                    }else{
                        $('.peshanga').addClass('hide');
                        $('.companya').removeClass('hide');
                        numberAnimation=0;
                    }
                },5000)

                $('.labrdn').on('click',()=>{
                    $('.fixDiv').addClass('hide');
                })
            })


            //searchs
            let widthWindow=$(window).width();
                        if(widthWindow < 1216){
                            $('.divSearch').addClass('animate__animated animate__lightSpeedInRight hide');
                           
                        }
                        if(widthWindow >= 1216){
                            $('.divSearch').removeClass('animate__animated animate__lightSpeedInRight hide');
                        
            }

            
            $('#inpSearch').on('keyup',()=>{ 
                 $('.boxSearch').html(''); 
                if( $('#inpSearch').val() == ''){
                    $('.boxSearch').slideUp(); 
                  
                }else{
                 $('.boxSearch').slideDown(); 
                 $('.boxSearch').removeClass('hide');
                 let nameAuto=$('#inpSearch').val();
                 let comp=$('#selectSearch').val();
                 $.ajax({
                     type: "get",
                     url: "/getMainSearch/"+comp+"/"+nameAuto,
                     data: comp,
                     success: function (response) {
                         $('.boxSearch').html(response.success);
                     }
                 });
                }
                            
            })
   
   
    </script>