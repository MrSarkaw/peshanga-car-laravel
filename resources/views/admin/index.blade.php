@extends('layouts.adminPanel')

@section('body')
<div class="col-12 mx-auto mt-2  boxdiv ">
    <div class=" boxs  text-center  ">
        <p><i class="fas fa-users  boxIcon"></i> ژمارەی بەكارهێنەر</p>
        <p class="badge badge-dark p-2"> {{count($user)}}</p>
    </div>

    <div class=" boxs  text-center  ">
            <p><i class="fas fa-building  boxIcon"></i> ژمارەی كۆمپانیاكان</p>
            <p class="badge badge-dark p-2">  {{count($companies)}}</p>
    </div>

        <div class=" boxs  text-center  ">
            <p><i class="fas fa-globe-asia  boxIcon"></i> ژمارەی شار</p>
            <p class="badge badge-dark p-2">  {{count($cities)}}</p>
         </div>


        <div class=" boxs  text-center  ">
            <p><i class="fas fa-file-image  boxIcon"></i> ژمارەی بڵاوكراوەكان</p>
            <p class="badge badge-dark p-2">  {{count($automobiles)}}</p>
        </div>

     

        <div class=" boxs  text-center  ">
            <p><i class="fas fa-stream icon boxIcon"></i> ژمارەی بەشەكان</p>
            <p class="badge badge-dark p-2"> {{count($main_sections)}}</p>
        </div>
    
        <div class=" boxs  text-center  ">
                <p><i class="fas fa-store-alt  boxIcon"></i> ژمارەی دوكانی ئەشیاكان</p>
                <p class="badge badge-dark p-2">  {{count($ashya)}}</p>
        </div>
    
        <div class=" boxs  text-center  ">
            <p><i class="fas fa-dollar-sign  boxIcon"></i> ژمارەی سپۆنسەرەكان</p>
            <p class="badge badge-dark p-2">  {{count($sponser)}}</p>
         </div>

         <div class=" boxs  text-center  ">
            <p><i class="fas fa-laptop boxIcon mt-4"></i> ژمارەی ئۆفیسەكان</p>
            <p class="badge badge-dark p-2">   {{count($office)}}</p>
         </div>

 


          
</div>

<div class="row col-12 mx-auto p-2" style="position: relative;top:-20px">
    <div class="col-6 mx-auto p-1">
        <div class=" col-12  boxs  text-center  ">
        <p><i class="fas fa-file boxIcon mt-4"></i> ژمارەی ڕاپۆرتی دزین</p>
        <p class="badge badge-dark p-2">   {{count($raportDzen)}}</p>
     </div>
    </div>
    
    <div class="col-6 mx-auto  p-1">
        <div class=" col-12  boxs  text-center">
        <p><i class="fas fa-car boxIcon mt-4"></i> ژمارەی سەیارەی شەحن و قیست</p>
        <p class="badge badge-dark p-2">   {{count($qestShahn)}}</p>
     </div>
    </div>
    
    
   
    
</div>

       

@endsection