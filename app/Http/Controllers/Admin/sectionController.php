<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\sectionRequest;
use App\main_sections;
class sectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections=main_sections::latest()->paginate(20);
        return view('admin.section.index',compact('sections'));
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
    public function store(sectionRequest $request)
    {
        try{

            if($request->menu!="amer"){
                $request->menu=null;
            }
                $image=$request->image;
                $name =time().$image->getClientOriginalName();
                $image->move(base_path('public/images'), $name);  
                auth()->user()->main_sections()->create(['sec_name'=>$request->sec_name,
                                                                'image'=>$name,'menu'=>$request->menu]);
                return response()->json([
                    'message'=>'success',
                    'name'=>$request->sec_name,
                    'path'=>$name,
                    'username'=>auth()->user(),
                    
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
        $section=main_sections::findOrFail($id);
        return view('admin.section.edit',compact('section'));
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
    public function update(sectionRequest $request, $id)
    {   
        if($request->menu!="amer"){
                $request->menu=null;
            }

        if($request->image==null){
           
            main_sections::find($id)->update($request->only('sec_name','menu'));
            }
        else{
            $this->deleteOldPhoto($id);
            $image=$request->image;
            $name =time().$image->getClientOriginalName();
            $image->move(base_path('public/images'), $name);  
            auth()->user()->main_sections()->find($id)->update(['sec_name'=>$request->sec_name,
                                                            'image'=>$name,'menu'=>$request->menu]);
           
          }
        return redirect('/sections')->with(['success'=>'success']);
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
        main_sections::find($id)->delete();
        return redirect('/sections')->with(['deletes'=>'deletes']);
    }

    public function deleteOldPhoto($idPhoto){
        $oldphoto=main_sections::find($idPhoto)->image;
                $oldphoto=public_path('images/').$oldphoto;
                if(file_exists($oldphoto)){
                    @unlink($oldphoto);
                }
        }
}
