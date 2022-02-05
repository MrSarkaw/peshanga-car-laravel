<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\officeRequest;

use App\office;
class officeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offices=office::latest()->paginate(20);
        return view('admin.office.index',compact('offices'));
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
    public function store(officeRequest $request)
    {
      auth()->user()->office()->create($request->only(['name','phone_number','address']));
     
      return response()->json([
        'name'=>$request->name,
        'phone_number'=>$request->phone_number,
        'address'=>$request->address,
        'user'=>auth()->user()
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
        $office=office::findOrFail($id);
        return view('admin.office.edit',compact('office'));
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
    public function update(officeRequest $request, $id)
    {
        $target=office::findOrFail($id);
        $target->update($request->only(['name','address','phone_number']));
        return redirect('/office')->with(['success'=>'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $target=office::findOrFail($id);
        $target->delete();
        return redirect('/office')->with(['deletes'=>'deletes']);
    }
}
