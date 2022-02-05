<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\companyRequest;
use Illuminate\Support\Facades\Auth;
use App\companies;
use App\User;

class companyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies=companies::latest()->paginate(20);
        return view('admin.company.index',compact('companies'));
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
    public function store(companyRequest $request)
    {
        $user=Auth::user();
        
      try{
        auth()->user()->companies()->create($request->only(['comp_name']));
        return response()->json(['name'=>auth()->user()->username,'message'=>"زيادكرا"]); 
        
      }catch(Execption $e){
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
        $companyInfo=companies::findOrFail($id);
        return view('admin.company.edit',compact('companyInfo'));
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
    public function update(companyRequest $request, $id)
    {
        companies::findOrFail($id)->update($request->only(['comp_name']));
         return redirect('/company')->with('success','success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        companies::findOrFail($id)->delete();
        return redirect('/company')->with('deletes','deletes');

    }
}
