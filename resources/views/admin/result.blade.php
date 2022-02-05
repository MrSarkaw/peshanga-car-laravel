@extends('layouts.adminPanel')

@section('body')

<p class="text-center text-warning">ئەنجامی گەڕان بۆ بەكارهێنەر</p>
@if(count($user)>0)
<div class="col-12 table-responsive mx-auto">
    <table class="col-12 text-center ">
        <thead>
            <tr>
                <th>ئاست</th>
                <th>ناو</th>
                <th>ژ.مۆبایل</th>
                <th>كاتی دروست بوون</th>
                <th>دەستكاری كردن</th>
            </tr>
        </thead>
        
        <tbody>
            @foreach($user as $users)
                <tr>
                    <th>{{$users->role->name}}</th>
                    <th>{{$users->username}}</th>
                    <th>{{$users->phone_number}}</th>
                    <th class="ltr">{{$users->created_at->diffForHumans()}}</th>
                    <th><a href="{{route('user.show',$users->user_id)}}" class="btn btn-warning text-dark"><i class="fas fa-cog"></i></a></th>
                </tr>
            @endforeach
           
        </tbody>
    </table> 
    <div class="mt-2">
        {{ $user->links() }}
    </div>
     </div>
     @else
     <p class="text-center text-warning">نەدۆزرایەوە</p>
     @endif
    <br>

   
   
   
    <p class="text-center text-warning">ئەنجامی گەڕان بۆ كۆمپانیا</p>
    @if(count($companies)>0)
    <div class="col-12 table-responsive mx-auto">
        <table class="col-12 text-center ">
            <thead>
                <tr>
                    <th>ناو</th>
                    <th>زيادكردنی</th>
                    <th>كاتی دروست بوون</th>
                    <th>دەستكاری كردن</th>
                </tr>
            </thead>
            
            <tbody>
               @foreach($companies as $company)
               <tr>
                    <th>{{$company->comp_name}}</th>
                    <th>{{$company->user->username}}</th>
                    <th class="ltr">{{$company->created_at->diffForHumans()}}</th>
                    <th><a href="{{route('company.show',$company->comp_id)}}" class="btn btn-warning text-dark">
                            <i class="fas fa-cog"></i>
                         </a>
                    </th>
                </tr>
               @endforeach
               
            </tbody>
        </table> 
        <div class="mt-2">
            {{ $companies->links() }}
        </div>
    </div>
    @else
     <p class="text-center text-warning">نەدۆزرایەوە</p>
     @endif
        <br>


        <p class="text-center text-warning">ئەنجامی گەڕان بۆ ئەشیا</p>
        @if(count($ashyas)>0)
        <div class="col-12 table-responsive mx-auto">
            <table class="col-12 text-center ">
                <thead>
                    <tr>
                        <th>ناو</th>
                        <th>وێنە</th>
                        <th> ناونیشان</th>
                        <th> جۆری ئۆتۆمبێل</th>
                        <th> ژ.مۆبایل</th>
                        <th>زيادكردنی</th>
                        <th>كاتی دروست بوون</th>
                        <th>دەستكاری كردن</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach ($ashyas as $ashya)
                   <tr>
                        <th>{{$ashya->ashya_name}}</th>
                        <th> {!! HTML::image('ashyaImage/'.$ashya->image,null,['class'=>'col-12 icon mt-1 ']) !!}</th>
                        <th>{{$ashya->address}}</th>
                        <th>{{$ashya->car}}</th>
                        <th>{{$ashya->phone_number}}</th>
                        <th>{{$ashya->user->username}}</th>
                        <th class="ltr">{{$ashya->created_at->diffForHumans()}}</th>
                        <th><a href="{{route('ashyaAdmin.show',$ashya->ashya_id)}}" class="btn btn-warning text-dark">
                                <i class="fas fa-cog"></i>
                             </a>
                        </th>
                    </tr>
                   @endforeach
                   
                </tbody>
            </table> 
            <div class="mt-2">
                {{ $ashyas->links() }}
            </div>
            
        </div>
        @else
     <p class="text-center text-warning">نەدۆزرایەوە</p>
     @endif
        <br>


        <p class="text-center text-warning">ئەنجامی گەڕان بۆ ئۆفیسەكان</p>
        @if(count($offices)>0)
        <div class="col-12 table-responsive mx-auto">
            <table class="col-12 text-center ">
                <thead>
                    <tr>
                        <th>ناو</th>
                        <th> ناونیشان</th>
                        <th> ژ.مۆبایل</th>
                        <th>زيادكردنی</th>
                        <th>كاتی دروست بوون</th>
                        <th>دەستكاری كردن</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach ($offices as $office)
                   <tr>
                        <th>{{$office->name}}</th>
                        <th>{{$office->address}}</th>
                        <th>{{$office->phone_number}}</th>
                        <th>{{$office->user->username}}</th>
                        <th class="ltr">{{$office->created_at->diffForHumans()}}</th>
                        <th><a href="{{route('office.show',$office->office_id)}}" class="btn btn-warning text-dark">
                                <i class="fas fa-cog"></i>
                             </a>
                        </th>
                    </tr>
                   @endforeach
                   
                </tbody>
            </table> 
            <div class="mt-2">
                {{ $offices->links() }}
            </div>
            
        </div>
        @else
     <p class="text-center text-warning">نەدۆزرایەوە</p>
     @endif
        <br>


      


        <p class="text-center text-warning">ئەنجامی گەڕان بۆ بەشەكان</p>
        @if(count($sections)>0)
        <div class="col-12 table-responsive mx-auto">
            <table class="col-12 text-center ">
                <thead>
                    <tr>
                        <th>ناو</th>
                        <th>وێنە</th>
                        <th>زيادكردنی</th>
                        <th>كاتی دروست بوون</th>
                        <th>دەستكاری كردن</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach ($sections as $section)
                   <tr>
                        <th>{{$section->sec_name}}</th>
                        <th> {!! HTML::image('images/'.$section->image,null,['class'=>'col-12 icon mt-1 ']) !!}</th>
                        <th>{{$section->user->username}}</th>
                        <th class="ltr">{{$section->created_at->diffForHumans()}}</th>
                        <th><a href="{{route('sections.show',$section->sec_id)}}" class="btn btn-warning text-dark">
                                <i class="fas fa-cog"></i>
                             </a>
                        </th>
                    </tr>
                   @endforeach
                   
                </tbody>
            </table> 
            <div class="mt-2">
                {{ $sections->links() }}
            </div>
            
        </div>

        @else
        <p class="text-center text-warning">نەدۆزرایەوە</p>
        @endif
            
            
@endsection