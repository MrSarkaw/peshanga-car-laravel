@extends('layouts.normalUser')
@section('body')
<span class="badge badge-warning p-2 d-block mb-4">بڵاوكراوەكانت</span>
@if (session()->has('success'))
<span class="badge badge-success p-2 d-block mb-4">تازەكرایەوە</span>
@endif

@if (session()->has('deletes'))
<span class="badge badge-danger p-2 d-block mb-4">سڕایەوە</span>
@endif
<div class="col-12 divPost  mx-auto text-center">
    @foreach ($automobiles as $auto)
    <div class="boxPost p-2">
      
        <span class="badge badge-warning mt-2">{{$auto->main_sections->sec_name}}</span>
        <p class="bg-warning text-dark rounded h4">{{$auto->name}}</p>

        <div class="col-12 p-0">
            @foreach(explode('|',$auto->images) as $row)
                <div class="col-12 p-0 border border-warning mpost">
                    {!! HTML::image('posts/'.$row,null,['class'=>'col-12 mainImg p-0']) !!}
                </div>
            @php break; @endphp
            @endforeach
        
            <div class="mt-2 posts border border-warning">

                @foreach (explode('|',$auto->images) as $row2)
                   
                        {!! HTML::image('posts/'.$row2,null,['class'=>'col-12 img  p-0']) !!}
                   
                @endforeach
                
            </div> 
        </div>
        <span class="badge badge-warning "> مۆدێل : {{$auto->model}}</span>
        <span class="badge badge-warning mt-2">ڕەقم : {{$auto->plate_number}}</span>
        <span class="badge badge-warning ">نرخ : {{$auto->price}}</span>
        <span class="badge badge-warning mt-2">ژ.مۆبایل : {{$auto->mobile_number}}</span>
        <span class="badge badge-warning mt-2">شار : {{$auto->city_name}}</span>
        @if(auth()->user()->role->name=="companya")
        <span class="badge badge-warning mt-2">جۆر : @if($auto->menu=="new") تازە @else كۆن @endif</span>
        @endif
        <div class="note border-warning border">
            {{$auto->note}}
        </div>
        <a href="{{route('nAdmin.edit',$auto->auto_id)}}">
             <button class="btn btn-warning mt-2 col-12 btn-sm"><i class="fas fa-cog"></i></button>
        </a>
       
    </div>


    @endforeach
   
   
</div>
<br>
 {{$automobiles->links()}}
<script>

        $(".img").click(function(){
            $(this).parent().siblings('.mpost').find('.mainImg').attr("src", $(this).attr('src'));
                
            });  
</script>
@endsection