<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ashyaRequest;
use App\ashya;
class ashyaAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ashyas=ashya::latest()->paginate(20);
        return view('admin.ashyas.index',compact('ashyas'));
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
    public function store(ashyaRequest $request)
    {
        try{
            $image=$request->image;
            $name =time().$image->getClientOriginalName();
            $image->move(base_path('public/ashyaImage'), $name);  
            auth()->user()->ashya()->create(['ashya_name'=>$request->ashya_name,
                                                    'image'=>$name,'phone_number'=>$request->phone_number,
                                                    'address'=>$request->address,'car'=>$request->car]);
            return response()->json([
                'message'=>'success',
                'name'=>$request->ashya_name,
                'path'=>$name,
                'username'=>auth()->user(),
                'address'=>$request->address,
                'phone_number'=>$request->phone_number,
                'car'=>$request->car
                
            ]);  
    }catch(Exception $e ){
        return response()->json([
            'success' => 'false',
            'errors'  => $e->getMessage(),
        ], 400);
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ashya=ashya::findOrFail($id);

        return view('admin.ashyas.edit',compact('ashya'));
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
    public function update(ashyaRequest $request, $id)
    {
        if($request->image==null){
            ashya::find($id)->update($request->only(['ashya_name','phone_number','car','address']));
            }
        else{
            $this->deleteOldPhoto($id);
            $image=$request->image;
            $name =time().$image->getClientOriginalName();
            $image->move(base_path('public/ashyaImage'), $name);  
            auth()->user()->ashya()->find($id)->update(['ashya_name'=>$request->ashya_name,
                                                            'image'=>$name,'phone_number'=>$request->phone_number,
                                                            'address'=>$request->address]);
           
          }
        return redirect('/ashyaAdmin')->with(['success'=>'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->deleteOldPhoto($id);
        ashya::find($id)->delete();
        return redirect('/ashyaAdmin')->with(['deletes'=>'deletes']);
    }


    public function deleteOldPhoto($idPhoto){
        $oldphoto=ashya::find($idPhoto)->image;
                $oldphoto=public_path('ashyaImage/').$oldphoto;
                if(file_exists($oldphoto)){
                    @unlink($oldphoto);
                }
        }
}
