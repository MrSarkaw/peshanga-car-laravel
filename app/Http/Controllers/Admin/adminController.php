<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\ashya;
use App\cities;
use App\automobiles;
use App\main_sections;
use App\companies;
use App\sponser;
use App\office;
use App\qestShahn;
use App\reportFroshtn;
class adminController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=User::all();
        $ashya=ashya::all();
        $cities=cities::all();
        $automobiles=automobiles::all();
        $main_sections=main_sections::all();
        $companies=companies::all();
        $sponser=sponser::all();
        $office=office::all();
        $qestShahn=qestShahn::all();
        $raportDzen=reportFroshtn::where('menu',1)->get();
        
          return view('admin.index',
                compact('user','ashya','cities','automobiles','qestShahn','raportDzen'
                            ,'main_sections','companies','sponser','office'));  
       
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $user=User::findOrFail($id);
        if($id==auth()->id()){
          return view('admin.edit',compact('user'));  
        }else{
            return redirect('/admin');
        }
    }



    public function resultSearch(Request $request){
        $this->validate($request,[
            'search'=>'required'
        ]);

        $user=User::where('username','LIKE','%'.$request->search.'%')->paginate(10);
        $companies=companies::where('comp_name','LIKE','%'.$request->search.'%')->paginate(10);
        $ashyas=ashya::where('ashya_name','LIKE','%'.$request->search.'%')->paginate(10);
        $offices=office::where('name','LIKE','%'.$request->search.'%')->paginate(10);
        $sections=main_sections::where('sec_name','LIKE','%'.$request->search.'%')->paginate(10);

        return view('admin.result',compact('user','ashyas'
        ,'sections','companies','offices'));
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
            'username.required'=>'تكایە ناو پڕكەرەوە',
            'username.unique'=>'ئەم ناوە هەڵبژێردراوە و ناوێكی دیكە بەكاربێنە',
            'username.alpha_num'=>'تەنیا ئەتوانیت وشە و پیت بەكاربێنی لە هەڵبژاردنی ناو',
            'username.min'=>'پێویستە ناوەكە لە 4 پیت كەمترنەبێ',
            'password.min'=>'پێویستە پاسۆردەكە لە 6 پیت كەمترنەبێ',
            'password.regex'=>'پێویستە پاسۆردەكە پێكهاتبێت لە ژمارە و پیت (كەپیتاڵ و سمۆڵ ) وە نیشانەكانی وەك (& , * , # ) ــ',
            'phone_number.required'=>"تكایە ژ.مۆبایل پڕكەرەوە پڕكەرەوە",
            'phone_number.digits'=>'پێویستە ژمارەكە لە 11 ڕەقەم بێت',
            'phone_number.numeric'=>'تەنیا ئەتوانیت ژمارە داغڵ بكەیت و وەبۆشای لەنێوان وشەكان نەبێ',
        ];
        $this->validate($request,[
                'username' => 'required|alpha_num|min:4|max:50|unique:users,username,'.$id.',user_id',
                'password' => 'sometimes|nullable|min:6|max:50|regex:/^(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z]).{8,20}$/',
                'phone_number'=>'required|digits:11|numeric',
        ],$message);

        if($id==auth()->id()){
             if($request->password!=null){
            User::find($id)->update($request->only('username','phone_number','password'));
        }
        User::find($id)->update($request->only('username','phone_number'));
        return redirect('/admin');
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
        //
    }
}
