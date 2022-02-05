<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\roles;
use App\cities;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\userRequest;
use Illuminate\Support\Facades\Hash;
class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permission=roles::all();
        $cities=cities::all();
        $user= User::latest()->paginate(20);
        return view('admin.users.index',['user'=>$user,'permission'=>$permission,'cities'=>$cities]);
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
    public function store(userRequest $request)
    {
        try{
            if($request->role_id!=2){
                $request->merge(['company'=>null]);
                } 
            $hashPass=Hash::make($request->password);
            $request->merge(['password'=>$hashPass]);
            User::create($request->only(['username','password','phone_number','role_id','city_id','company']));
            echo "زیادكرا";
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
         $userInfo=User::findOrFail($id);
    
         $permission=roles::pluck('name','role_id')->all();
         $cities=cities::pluck('city_name','city_id')->all();
        return view('admin.users.edit',compact('userInfo','permission','cities'));
        
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
    public function update(userRequest $request, $id)
    {
        try{
            if($request->role_id!=2){
                        $request->merge(['company'=>null]);
                }
            
                if(!empty($request->password)){
                $request->merge(['password'=>Hash::make($request->password)]);
                User::findOrFail($id)->update($request->all());
            }else{
                
                
                User::findOrFail($id)->update($request->only(['username','role_id','phone_number','city_id','company']));
            }
            
             return redirect('/user')->with('success','success');
        }catch(Exception $e ){
            return response()->json([
                'success' => 'false',
                'errors'  => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('user_id',$id)->delete();
        return redirect('/user')->with('deletes','deletes');
    }
}
