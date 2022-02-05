<?php

namespace App\Http\Controllers\normalUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\cities;
use App\main_sections;
use App\amer;
use App\Http\Requests\amerRequest;
class amerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $amer=auth()->user()->amer()->latest()->paginate(30);
        $cities=cities::all();
        $main=main_sections::where('menu','amer')->get();
        return view('normalUser.amer.index',compact('cities','main','amer'));
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
    public function store(amerRequest $request)
    {
        cities::findOrFail($request->city_id);
        main_sections::findOrFail($request->sec_id);

        $photoArr=array();
        $checkName='';
        $image=$request->images;
        $number=1;
        foreach($image as $img){
         if($number>20){
         break;
         }
         $name =rand(0,999).time().$img->getClientOriginalName();
            $img->move(base_path('public/posts'), $name);  
            $photoArr[]=$name; 
            $checkName.=$name;
            $number++;
        }
        

        if(strlen($checkName) <1230){
        
           
        
            auth()->user()->amer()->create([
                'sec_id'=>$request->sec_id,
                'name'=>$request->name,
                'price'=>$request->price,
                'images'=>implode('|',$photoArr),
                'city_id'=>$request->city_id,
                'note'=>$request->note
                ]);
            
            echo "زیادكرا";
          } else{
            echo "ناوی وێنەكە كەمتر بكەرەوە";
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
        $cities=cities::all();
        $main_sections=main_sections::where('menu','amer')->get();
        $amers=amer::findOrFail($id);
        return view('normalUser.amer.edit',compact('amers','cities','main_sections'));
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
        cities::findOrFail($request->city_id);
        main_sections::findOrFail($request->sec_id);

        if($request->images==null){
            auth()->user()->amer()->findOrFail($id)->update([
                'sec_id'=>$request->sec_id,
                'name'=>$request->name,
                'price'=>$request->price,
                'note'=>$request->note,
                'city_id'=>$request->city_id,
                ]);
            
        }else{
            $this->deleteOldPhoto($id);
            $photoArr=array();
            $image=$request->images;
            $number=1;
            foreach($image as $img){
            if($number>20){
            break;
            }
            $name =rand(0,999).time().$img->getClientOriginalName();
                $img->move(base_path('public/posts'), $name);  
                $photoArr[]=$name; 
                $number++;
            }

            auth()->user()->amer()->findOrFail($id)->update([
                'sec_id'=>$request->sec_id,
                'name'=>$request->name,
                'model'=>$request->model,
                'plate_number'=>$request->plate_number,
                'price'=>$request->price,
                'mobile_number'=>$request->mobile_number,
                'note'=>$request->note,
                'comp_id'=>$request->comp_id,
                'images'=>implode('|',$photoArr),
                'city_name'=>$request->city_name,
                'menu'=>$request->menu
                ]);

            }


            return redirect('/amer')->with(['success'=>'success']);


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
        auth()->user()->amer()->findOrFail($id)->delete();
        return redirect('/amer')->with(['deletes'=>'deletes']);
    }

    public function deleteOldPhoto($idPhoto){
        $oldphoto=auth()->user()->amer()->findOrFail($idPhoto)->images;
        $photos=array();

        foreach(explode('|',$oldphoto) as $row){
            $rows=public_path('posts/').$row ;
                if(file_exists($rows)){
                                    @unlink($rows);
                        }
            }
                
               
        }
}
