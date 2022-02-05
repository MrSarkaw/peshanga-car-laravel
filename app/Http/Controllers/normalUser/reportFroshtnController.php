<?php

namespace App\Http\Controllers\normalUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\reportFroshtn;
class reportFroshtnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

  

    public function index()
    {

        $reportFroshtn=auth()->user()->raport()->latest()->paginate(20);
        if(auth()->user()->role->name=="administrator"){
            return view('admin.dzraw.index',compact('reportFroshtn'));
        }else{
         return view('normalUser.raport.index',compact('reportFroshtn'));   
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message=[
            'raport.required'=>"ڕاپۆرت پڕبكەرەوە",
            'raport.max'=>'لە دوو هەزار پیت زیاتر ناتوانی بنووسیت'
        ];

        $this->validate($request,[
            'raport'=>'required|max:2000',
            
        ],$message);

        $check=0;
        if(auth()->user()->role->name=="administrator"){
            $check=1;
        }

        auth()->user()->raport()->create(['raport'=>$request->raport,'menu'=>$check]);
        return response()->json([
            'newData'=>$request->raport
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $raport=reportFroshtn::findOrFail($id);
        if(auth()->user()->role->name=="administrator"){
            return view('admin.dzraw.edit',compact('raport'));
        }else{
          return view('normalUser.raport.edit',compact('raport'));   
        }
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $message=[
            'raport.required'=>"ڕاپۆرت پڕبكەرەوە",
            'raport.max'=>'لە دوو هەزار پیت زیاتر ناتوانی بنووسیت'
        ];

        $this->validate($request,[
            'raport'=>'required|max:2000',
            
        ],$message);

        auth()->user()->raport()->findOrFail($id)->update(['raport'=>$request->raport]);
        return redirect('/raport')->with(['success'=>'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        auth()->user()->raport()->findOrFail($id)->delete();
        return redirect('/raport')->with(['deletes'=>'deletes']);
    }
}
