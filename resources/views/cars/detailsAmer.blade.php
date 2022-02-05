@extends('layouts.public')
@section('body')
    <div class="col-12 mb-2">
        <button class="customBtn btn-sm mr-4 mb-2" onclick="back()">گەڕاندنەوە</button>
    </div>

    
        <div class="col-12 p-0 postImg  col-md-6 col-lg-5 float-right text-center">
            <div class="col-10 mx-auto border border-dark LRD p-2">
                @foreach (explode('|',$amer->images) as $img)
                {{HTML::image('posts/'.$img,'posts',
                ['class'=>'col-12 col-sm-5 col-md-9 LRD p-0 mx-auto mainImg'])}}
                            @php break; @endphp
                @endforeach
              
            </div>
            <div class="col-11 mt-2 mx-auto border border-dark p-1  LRD row text-center">
                @foreach (explode('|',$amer->images) as $img)
                <div class="col-3 mx-auto text-center p-0 mt-2 mb-2">
                    {{HTML::image('posts/'.$img,'posts',['class'=>'col-9  po LRD p-0 mx-auto '])}}
                </div>
                @endforeach
                
            </div>
    </div>

        <div class="col-12  col-md-6 
                     text-center row float-left
                      LRD mt-2 mx-auto ">
                <p class=" bg-head p-2 LRD mx-auto text-light col-12 text-center"> بڵاو كراوەتەوە لەلایەن
                    @if($amer->user->role_id==2)
                    كۆمپانیای
                    @else
                    پێشانگای
                    @endif
                    {{$amer->user->username}}</b>
                      <div class="col-10 mx-auto p-1  mt-3 LRD bg-head">
                        <p class="mt-2 gray">
                        {{HTML::image('icons/taxi.svg','icon',['class'=>'grid float-right mr-3'])}}
                                       جۆر  :
                                   <span >{{$amer->main_sections->sec_name}}</span>  
                               </p>
                       </div>
           
           
                       
                            <div class="col-10 mx-auto p-1  mt-3 LRD bg-head">
                                    <p class="mt-2 gray">
                                        {{HTML::image('icons/car.svg','icon',['class'=>'grid float-right mr-3'])}}
                                            ئامێر :
                                    <span>{{$amer->name}}</span>  
                                    </p>
                            </div>
                
                            <div class="col-10 mx-auto p-1  mt-3 LRD bg-head">
                                <p class="mt-2 gray">
                                    {{HTML::image('icons/car-plate.svg','icon',['class'=>'grid float-right mr-3'])}}
                                    رەقەم :
                                    <span>{{$amer->cities->city_name}}</span>  
                                </p>
                        </div>

                      
                        <div class="col-10 mx-auto p-1  mt-3 LRD bg-head">
                                <p class="mt-2 gray">
                                    {{HTML::image('icons/price.svg','icon',['class'=>'grid float-right mr-3',])}}
                                    نرخ :
                                    <span>{{$amer->price}} $</span>  
                                </p>
                        </div>


                        <div class="col-10 mx-auto p-1  mt-3 LRD bg-head">
                            <p class="mt-2 gray">
                                <span>{{$amer->note}}</span>  
                            </p>
                    </div>
                    
                    
                    </div>
                
   
                    <div class="col-12 col-sm-12 mt-5  mx-auto row postResult
                    animate__animated animate__zoomInUp custom-padding"> </div>
                
               
    <div class="modal fade " tabindex="-1" role="dialog" >
        <div class="modal-dialog">
          <div class="modal-content">
              <button class="btn btn-primary" data-dismiss="modal">X</button>
            <img src="" id="modalImg" class="w-100" alt="">
            <div class="col-12 row p-2 bg-primary mx-auto">
                <div class="col-6 p-0 text-center mx-auto"><button class="btn btn-outline-dark prev">--></button></div>
                <div class="col-6 p-0 text-center mx-auto"><button class="btn btn-outline-dark next"><--</button></div>
            </div>
          </div>
        </div>
      </div>
  <script>
       function back() { 
            window.history.back();
         }

         $(document).ready(function () { 
             $(".postImg img").click(function(){
                    $('.mainImg').attr("src", $(this).attr('src'));
            });  
            


            //next
            $('.next').on('click',()=>{
                   let image=$('#modalImg').attr('src');
                   let count=$('.po').length;
                   let number;
                   for(let i=0;i<count;i++){
                       let img=$('.po').eq(i).attr('src');
                       if(img==image){
                           number=i;
                       }    
                   }
                   if(number == (count-1)){
                          number=0;
                   }else{
                         number++;
                   }
                   let newImg=$('.po').eq(number).attr('src');
                   $('#modalImg').attr("src", newImg);
                })

                //prev
                $('.prev').on('click',()=>{
                   let image=$('#modalImg').attr('src');
                   let count=$('.po').length;
                   let number;
                   for(let i=0;i<count;i++){
                       let img=$('.po').eq(i).attr('src');
                       if(img==image){
                           number=i;
                       }    
                   }

                   if(number == (count-count)){
                          number=count-1;
                   }else{
                         number--;
                   }
                   let newImg=$('.po').eq(number).attr('src');
                   $('#modalImg').attr("src", newImg);
                })
           
           
           
             $('.mainImg').on('click',()=>{
                let src=$('.mainImg').attr('src');
                $('#modalImg').attr('src',src);
                $('.modal').modal('show');
            
            })
          })

        
  </script>
@endsection