<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\main_menuses;
use App\automobiles;
use Carbon\Carbon;
use App\office;
use App\companies;
use App\User;
use App\cities;
use App\main_sections;
use App\ashya;
use App\sponser;
use App\amer;
class carsViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    // search
    public function indexSearchCars($id)
    {
        $sec=main_sections::findOrFail($id);
        \Session::forget(['section','city','model']);
        \Session(['section'=>$id]);
        if($sec){
            
              if($sec->menu==null)
              {$cities=[
                'سلێمانی' =>'سلێمانی',
                'هەولێر' =>'هەولێر',
                'دهۆك' =>'دهۆك',
                'كەركوك' =>'كەركوك',
                'هەڵەبجە' =>'هەڵەبجە',
              ];
                return view('cars.searchCars',compact('cities'));  
              }else{
                  $cities=cities::all();
                return view('cars.searchAmers',compact('cities'));  

              }
            
        }
        
    }

    public function getCompanies($name){
        \Session::forget('city');
       if($name==null || $name==''){ 
         
        }else{
            
           $check=main_sections::findOrFail(\Session::get('section'));
           if($check->menu==null){
               $cities=['سلێمانی','هەولێر','دهۆك','كەركوك','هەڵەبجە'];
   
               if(in_array($name,$cities)){
               
                \Session(['city'=>$name]);
                   
                   $automobiles=automobiles::where('city_name',$name)->where('menu',null)->where('sec_id',\Session::get('section'))->distinct()->get('comp_id');
                    
                   if($automobiles){
                        $companies=array();
                       
                        foreach($automobiles as $auto){
                            $company=companies::findOrFail($auto->comp_id);  
                            $companies[]=['comp_id'=>$company->comp_id,'comp_name'=>$company->comp_name];
                        }
                    
                        
                        if(count($companies)>0){
                            $option='<option>ماركەی ئۆتۆمبێل هەڵبژێرە</option>';
                            foreach($companies as $comp){
                                $option.="<option value='".$comp['comp_id']."'>".$comp['comp_name']."</option>";
                            } 
                           return response()->json([
                                'success'=>$option
                            ]);
                        }else{
                            return response()->json([
                                'success'=>null
                            ]);
                        }
                       
                         
                       
                    }  
               }
           }else{
               \Session(['city'=>$name]);
               $amer=cities::findOrFail($name)->amer()->
                                where('sec_id',\Session::get('section'))
                                ->distinct()->get('name');
                    if(count($amer)>0){
                        $option='<option>هەڵبژێرە</option>';
                        foreach($amer as $count=>$am){
                            $option.="
                            <optgroup >
                                <option class='b' value='".$am['name']."'>".$am['name']."</option>
                                <option  disabled>(".count(amer::where('name',$am['name'])->get()).") بەردەست</option>
                            </optgroup>";
                        } 
                       return response()->json([
                            'success'=>$option
                        ]);
                    }else{
                        return response()->json([
                            'success'=>null
                        ]);
                    } 
                } 
        }
  
       }
      

    public function getAutomobiles($id){
            $company=companies::findOrFail($id);
            if($company){
                $automobiles=automobiles::where('comp_id',$id)
                                            ->where('menu',null)
                                            ->where('sec_id',\Session::get('section'))
                                            ->where('city_name',\Session::get('city'))->distinct()->get('name');
            
                if(count($automobiles)){ 
                    $option='<option>ئۆتۆمبێل هەڵبژێرە</option>';
                    foreach($automobiles as $auto){
                        $option.="<option>".$auto->name."</option>";
                    } 
                    return response()->json([
                        'success'=>$option
                    ]);
                }else{
                    return response()->json([
                        'success'=>null
                    ]);
                }
                

            
            }   
    }


    public function getModel($name){
        \Session::forget('model');
       $automobiles=automobiles::where('name',$name)->where('city_name',\Session::get('city'))
                                    ->where('menu',null)
                                    ->where('sec_id',\Session::get('section'))->distinct()->get('model');
       if(count($automobiles) > 0){
           \Session(['model'=>$name]);
           $option='';
        foreach($automobiles as $auto){
           $option.="<option value='".$auto->model."'>".$auto->model."</option>";
        }
         return response()->json([
             'success'=>$option,
         ]);
       }else{
        return response()->json([
            'success'=>null,
        ]);
       }
    }


    public function getPrice($min,$max){
     
        if($min <= $max){
            $automobiles=automobiles::where('name',\Session::get('model'))->
                                           where('menu',null)->
                                           where('sec_id',\Session::get('section'))->
                                           where('city_name',\Session::get('city'))->whereBetween('model',[$min,$max])->distinct()->get('price');
            if(count($automobiles)>0){
                $option='';
                foreach($automobiles as $auto){
                    $option.='<option value="'.$auto->price.'">'.$auto->price.'</option>';
                }

                return response()->json([
                    'success'=>$option
                ]);
            }else{
                return response()->json([
                    'success'=>null
                ]);
            }
        }
      
                                        }

        public function returnFunc($option){
            return response()->json([
                'success'=>$option
            ]);
        }
    public function ResultSearchCars(Request $request)
    {
        $message=[
            'city_id.required'=>"شار هەڵبژێرە",
            'companies.required'=>"كۆمپانیا هەڵبژێرە",
            'automobiles.required'=>"ئۆتۆمبێل هەڵبژێرە",
            'minModel.required'=>"نزمترین مۆدێل هەڵبژێرە",
            'maxModel.required'=>"بەرزتۆین مۆدێل هەڵبژێرە",
            'minPrice.required'=>"نزمترین نرخ هەڵبژێرە",
            'maxPrice.required'=>"بەرزترین هەڵبژێرە",
        ];

        $this->validate($request,[
            'city_id'=>'required|alpha',
            'companies'=>'required',
            'automobiles'=>'required',
            'minModel'=>'required',
            'maxModel'=>'required',
            'minPrice'=>'required',
            'maxPrice'=>'required',

        ],$message);

        
        if($request->minPrice<=$request->maxPrice){
         
            $automobiles=automobiles::latest()->where('sec_id',\Session::get('section'))
                                        ->where('city_name',$request->city_id)
                                        ->where('comp_id',$request->companies)
                                        ->where('name',$request->automobiles)
                                        ->where('menu',null)
                                        ->whereBetween('model',[$request->minModel,$request->maxModel])
                                        ->whereBetween('price',[$request->minPrice,$request->maxPrice])->paginate(20);
            $ashya=ashya::where('car',$request->automobiles)->get();
            $sponser=sponser::latest()->paginate(20);
            $sec=\Session::get('section');
          
           return view('cars.resultCars',compact('automobiles','ashya','sponser','sec'));  
        }
        return redirect()->back();
       
        
    }

    public function getAmer(Request $request){
        
        $amers=cities::findOrFail(\Session('city'))
                        ->amer()->latest()->where('name',$request->name)->
                        where('sec_id',\Session::get('section'))->paginate(20);
        $sec=\Session::get('section');
        return view('cars.resultAmer',compact('amers','sec'));

                       
    }

    // main search
    public function getMainSearch($company,$nameAuto)
    {
        companies::findOrFail($company);
        $automobile=automobiles::where('comp_id',$company)->where('name','LIKE','%'.$nameAuto.'%')->distinct()->get('name');
        $list='<ol class="list-group p-0 text-center ltr">';
        if(count($automobile)>0)
        foreach($automobile as $count=>$auto){
            $list.='<a href="/mainSearch/'.$auto->name.'">
                        <li class="list-group-item  bg-head gray d-flex justify-content-between mt-2 align-items-center" 
                            style="border-radius:13px !important">
                            '.$auto->name.'
                            <span class="badge badge-light badge-pill">'
                               .count(automobiles::where('name',$auto->name)->where('comp_id',$company)->get()).
                            '</span>
                        </li>
                    </a>';
        }else{
            $list.='
                        <p class="alert alert-warning text-center p-2 LRD">نەدۆزرایەوە</li>';
        }
        $list.='</ol>';
         return response()->json([
             'success'=>$list
        ] );
    }
    public function mainSearch($name){
        $automobiles=automobiles::where('name',$name)->paginate(20);
        $ashya=ashya::where('car',$name)->get();
         $sponser=sponser::latest()->paginate(20);
        if(count($automobiles)>0){
            return view('cars.resultMainSearch',compact('automobiles','ashya','sponser'));
        }else{
             return redirect('/');
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
        $automobile=automobiles::findOrFail($id);
        $automobiles=automobiles::where('name',$automobile->name)
                                     ->where('city_name',$automobile->city_name)
                                     ->where('menu',$automobile->menu)
                                     ->where('auto_id','<>',$automobile->auto_id)
                                     ->where('comp_id',$automobile->comp_id)->paginate(20);
        return view('cars.detailsCars',compact('automobile','automobiles'));
    }

    public function showAmer($id){
        $amer=amer::findOrFail($id);
        
        $sec=\Session::get('section');
        return view('cars.detailsAmer',compact('amer','sec'));
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
        //
    }


    public function showLists($id){
        $menuses=main_menuses::findOrFail($id);
        if($menuses){
           $automobiles=automobiles::latest()->where('menu_id',$id)->paginate(20);
            return view('cars.lists',compact('automobiles')); 
        }
        
        
    }

    
    public function weeklyCars(){
        $automobiles=automobiles::latest()->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->paginate(20);
        return view('cars.weeklyCars',compact('automobiles'));
        
    }


    public function officeRentCars(){
        $offices=office::latest()->paginate(20);
        return view('cars.officeRentCars',compact('offices'));
    }


    //company and peshanga list

    public function listACompany($name){
        \Session::forget(['comp','peshanga']);
       if($name =='company' || $name=="peshangakan"){
        $cities=cities::all();
        if($name=="company"){
            \Session(['comp'=>'success']);
         }else{
            \Session(['peshanga'=>'success']);
         }
         return view('cars.listACompany',compact('cities'));
       }else{
          return redirect('/');
       }

    

       
    }

    public function viewCompany($cities){
     
    if(\Session::get('comp')){
        $cities=cities::findOrFail($cities)->user2()->where('role_id',2)->get();
    }else if(\Session::get('peshanga')){
        $cities=cities::findOrFail($cities)->user2()->where('role_id',3)->get();  
    }
       
        $content=' ';
        if(count($cities)>0){
           foreach($cities as $users){
            $content.='
                    <div class=" mt-2  border border-dark p-0" id="">
                        <div class="col-12 mx-auto  p-1 LRD row animate__animated animate__backInRight ">
                        <img src="../icons/computer.svg"  class="col-10 cl-sm-9 col-md-8 col-lg-6 d-block mx-auto" >
                            <p class="badge-custom col-12 text-center LRD p-1">ناو : '.$users->username .'  </p>
                            <p class="badge-custom2 col-12 text-center LRD p-1"> ژ.مۆبایل <br>'.$users->phone_number.' </p>';
                             if(\Session::has('comp')){
                               $content.='<p class="badge-custom2 col-12 text-center LRD p-1"> تايبەتە بە <br>'.$users->company.' </p>' ;
                            } 
                $content.=' </div>
                         </div>'; 
          }
          
         
        }
       
       return response()->json([
        'content'=>$content
       ]); 
    }
   
 
       
    }

