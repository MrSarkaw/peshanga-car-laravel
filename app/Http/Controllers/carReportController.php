<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\reportFroshtn;
use App\User;
class carReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companya=User::where('role_id',2)->latest()->paginate(20);
        return view('cars.newCars.newCars',compact('companya'));
    }

    public function indexFroshraw(){
        $froshtn=reportFroshtn::where('menu',0)->latest()->paginate(20);
        return view('cars.newCars.froshraw',compact('froshtn'));
    }

    public function indexForDzraw(){
        $dzraw=reportFroshtn::where('menu',1)->latest()->paginate(20);
        return view('cars.dzraw.index',compact('dzraw'));
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
        $cars=User::findOrFail($id)->automobiles()->where('menu','new')->paginate(20);
        return view('cars.newCars.showCars',compact('cars'));
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
}
