<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\sponser;

class sponserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sponsers=sponser::latest()->paginate(20);
        return view('admin.sponser.index',compact('sponsers'));
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
            'image.required'=>'تكایە وێنە هەڵبژێرە',
            'image.mimes'=>'جۆری وێنە نەگونجاوە'
        ];
        $this->validate($request,[
            'image'=>'required|mimes:jpg,jpeg'
        ],$message);


        $image=$request->image;
                $name =time().$image->getClientOriginalName();
                $image->move(base_path('public/reklam'), $name);  
                auth()->user()->sponser()->create(['image'=>$name]);
                return response()->json([
                    'message'=>'success',
                    'path'=>$name,
                    'username'=>auth()->user(),
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      
        $sponser=sponser::find($id);
        if($sponser){
            $photo=public_path('reklam/').$sponser->image;
            if(file_exists($photo)){
                @unlink($photo);
            }
            $sponser->delete();
            return response()->json([
            'message'=>'success',
            'id'=>$id,
        ]);  

        }
    }
}
