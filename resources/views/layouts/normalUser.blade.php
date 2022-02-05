<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link href="{{ asset('css/adminPanel.css') }}" rel="stylesheet">
     <link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"
   />
   


   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">    <title>adminPanel</title>
    <style>
        @media only screen and (max-width:768px){
            .top{
              height: 50px !important  
            }
            
        }
    </style>
</head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
<body>
   <div class="main">
        <div class="right-side">
            <button class="btn btn-light btnMenu col-12">X</button>
            <div class="col-12 logo p-0  text-center">
                {!! HTML::image('logo/logo4-1.png',null,['class'=>'col-6 col-sm-7 col-md-11  mx-auto mt-2 mb-2']) !!}
            </div>
            
            <div class="col-12 p-0 menu">
                <a href="/nAdmin">
                    <div class="col-12 p-2  text-center">
                        <i class="fas fa-home  icon"></i>
                        <p class="m-0 p-0">سەرەتا</p>
                    </div>
                </a>
               
                
                <a href="/nAdmin/create">
                    <div class="col-12 p-2  text-center">
                        <i class="fas fa-car-side icon"></i>
                        <p>زیادكردنی سەیارە</p>
                        
                    </div>
                </a>

                <a href="/amer">
                    <div class="col-12 p-2  text-center">
                        <i class="fas fa-caravan icon"></i>
                        <p>زیادكردنی ئامێر و هاوشێوەكانی</p>
                        
                    </div>
                </a>
               
                <a href="/raport">
                    <div class="col-12 p-2  text-center">
                        <i class="fas fa-file icon"></i>
                        <p>ڕاپۆرتی فرۆشتن</p>
                        
                    </div>
                </a>
               
                
                

                
             

            </div>
            
           
        </div>
        <div class="left-side">
            <div class="top">
                <div class="col-1 float-right text-center p-3" id="divMenu">
                    <span id="menu" onclick="changeMenu()">
                       <i class="fas fa-bars h5" ></i> 
                    </span>
                    
                </div>
                <div class="col-9 col-sm-6 col-md-5 col-lg-3 mb-2 float-left d-block mt-1 ">
                 <span class="badge badge-light">{{\Auth::user()->username}}</span>
                        <i class="fas fa-chevron-circle-down h4" id="dropdownMenuButton" 
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="position: relative;top:13px"></i>
                         
                         <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" > 
                             <a class="dropdown-item" href="{{route('nAdmin.show',auth()->id())}}">چاكسازی</a>
                            
                             <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            چوونە دەرەوە
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                           
                          </div>
                 
                </div>

               
                
            </div>      
           
            <div class="col-12 mx-auto mt-2 ">
                
                @yield('body')

                
                
            </div>

        

                
        </div>
   </div>

   <script>
     function changeMenu(){
        let widthL=$('.left-side').width()/ $('body').width() * 100;
          if(widthL !=100){
             $('.left-side').attr('style','width:100%')
             $('.right-side').attr('style','width:0%')
          }else {
              if($(window).width()>700){
                  $('.left-side').attr('style','width:90%')
                   $('.right-side').attr('style','width:10%')
              }else{
                  
                   $('.left-side').attr('style','width:0%')
                   $('.right-side').attr('style','width:100%')
              }
            
          }
       
     }
  
    
  
     $('.btnMenu').on('click',()=>{
        $('.left-side').attr('style','width:100%;')
        $('.right-side').attr('style','width:0%')
     })
   
     $(function() {
            let url=  window.location.pathname;
            let number=$('.menu a:last').index();
          
            for(let i=0;i<=number;i++){
                if($('.menu a').eq(i).attr('href')==url){
                    $('.menu a div').eq(i).addClass('active');     
                }
            }
        });
   </script>
</body>
</html>