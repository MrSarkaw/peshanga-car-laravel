@extends('layouts.public')
@section('body')
<div class="col-12 col-sm-12  mx-auto row postResult
        animate__animated animate__zoomInUp custom-padding ">
        <div class="col-12 table-responsive mx-auto">
            <table class="col-12 text-center ">
                <thead>
                    <tr>
                        <th>ناو</th>
                        <th>ژ.مۆبایل</th>
                        <th>تایبەت بە</th>
                        <th>كاتی دروست بوون</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach ($qestShahn as $qestShahns)
                   <tr>
                        <th>{{$qestShahns->name}}</th>
                        <th>{{$qestShahns->phone_number}}</th>
                        <th>{{$qestShahns->cars}}</th>
                        <th class="ltr">{{$qestShahns->created_at->diffForHumans()}}</th>
                    </tr>
                   @endforeach
                   
                </tbody>
            </table> 
            <div class="mt-2">
                {{ $qestShahn->links() }}
            </div>
            
        
</div>

@endsection