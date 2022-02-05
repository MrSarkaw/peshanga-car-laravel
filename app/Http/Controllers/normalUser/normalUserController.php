<?php

namespace App\Http\Controllers\normalUser;
use App\Http\Requests\normalUserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\facades\Hash;
use Illuminate\Http\Request;
use App\companies;
use App\automobiles;
use App\main_sections;
class normalUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        $automobiles=auth()->user()->automobiles()->latest()->paginate(30);
        return view('normalUser.index',compact('automobiles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
        $companies=companies::all();
        $main_sections=main_sections::where('menu',null)->get();
        $cities=['سلێمانی','هەولێر','دهۆك','كەركوك','هەڵەبجە'];
        return view('normalUser.insert',compact('companies','main_sections','cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        $cities=['سلێمانی','هەولێر','دهۆك','كەركوك','هەڵەبجە'];
        if(in_array($request->city_name,$cities)){
            
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
            
                if(auth()->user()->role->name!="companya" || $request->menu!="new" ){
                            $request->merge(['menu'=>null]); 
                }
            
                auth()->user()->automobiles()->create([
                    'sec_id'=>$request->sec_id,
                    'name'=>$request->name,
                    'model'=>$request->model,
                    'plate_number'=>$request->plate_number,
                    'price'=>$request->price,
                    'images'=>implode('|',$photoArr),
                    'mobile_number'=>$request->mobile_number,
                    'note'=>$request->note,
                    'comp_id'=>$request->comp_id,
                    'city_name'=>$request->city_name,
                    'menu'=>$request->menu
                    ]);
                
                echo "زیادكرا";
              } else{
                echo "ناوی وێنەكە كەمتر بكەرەوە";
              }     
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
        $user=auth()->user();
        return view('normalUser.editUser',compact('user'));
    }


    public function infoUpdate(Request $request){
        if($request->password!=null){
             $this->validate($request,[
            'password' => 'required|min:6|max:50|regex:/^(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z]).{8,20}$/',
            'phone_number'=>'required|digits:11|numeric',
             ]);
              
             $request->merge(['password'=>Hash::make($request->password)]);
            auth()->user()->update($request->only('password','phone_number'));
        }else{
            $this->validate($request,[
                'phone_number'=>'required|digits:11|numeric',
            ]); 
            auth()->user()->update($request->only('phone_number'));

        }

        return redirect('nAdmin');
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $automobiles=automobiles::findOrFail($id);
       
        $companies=companies::pluck('comp_name','comp_id')->all();
        $main_sections=main_sections::where('menu',null)->get();
        $cities=['سلێمانی','هەولێر','دهۆك','كەركوك','هەڵەبجە'];
        return view('normalUser.edit',compact('companies','main_sections','automobiles','cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(normalUserRequest $request, $id)
    {
        $cities=['سلێمانی','هەولێر','دهۆك','كەركوك','هەڵەبجە'];
        if(in_array($request->city_name,$cities)){
        $automobiles=automobiles::findOrFail($id);
        if(auth()->user()->role->name!="companya" || $request->menu!="new" ){
            $request->merge(['menu'=>null]); 
        }
        if($request->images==null){
            auth()->user()->automobiles()->findOrFail($id)->update([
                'sec_id'=>$request->sec_id,
                'name'=>$request->name,
                'model'=>$request->model,
                'plate_number'=>$request->plate_number,
                'price'=>$request->price,
                'mobile_number'=>$request->mobile_number,
                'note'=>$request->note,
                'comp_id'=>$request->comp_id,
                'city_name'=>$request->city_name,
                'menu'=>$request->menu
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

            auth()->user()->automobiles()->findOrFail($id)->update([
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
        }


        return redirect('/nAdmin')->with(['success'=>'success']);
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
        auth()->user()->automobiles()->findOrFail($id)->delete();
        return redirect('/nAdmin')->with(['deletes'=>'deletes']);

    }

    public function deleteOldPhoto($idPhoto){
        $oldphoto=auth()->user()->automobiles()->findOrFail($idPhoto)->images;
        $photos=array();

        foreach(explode('|',$oldphoto) as $row){
            $rows=public_path('posts/').$row ;
                if(file_exists($rows)){
                                    @unlink($rows);
                        }
            }
                
               
        }
}
