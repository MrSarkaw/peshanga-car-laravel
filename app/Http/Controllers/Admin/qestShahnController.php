<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\qestShahnRequest;
use App\qestShahn;

class qestShahnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $qestShahn=qestShahn::latest()->paginate(20);
        return view('admin.qestShahn.index',compact('qestShahn'));
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
    public function store(qestShahnRequest $request)
    {
        auth()->user()->qestShahn()->create(['menu'=>$request->menu,
                                                'name'=>$request->name,
                                                'phone_number'=>$request->phone_number,
                                                'cars'=>$request->cars]);
            return response()->json([
            'message'=>'success',
            'name'=>$request->name,
            'phone_number'=>$request->phone_number,
            'cars'=>$request->cars,
            'menu'=>$request->menu,
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
        qestShahn::findOrFail($id)->delete();
        return redirect('/qestShahn')->with(['deletes'=>'deletes']);
    }
}
