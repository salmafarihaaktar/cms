<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    public function type(){
        $data=Cargo::all();
        return view('Backend.pages.cargo.list',compact('data'));

}
public function from (){
    return view('Backend.pages.cargo.from');
}
public function stores(Request $request){


// dd($request->all());

$request->validate([
    'vehicle_number'=>'required',
    'drivers_name'=>'required',
    'drivers_license'=>'required',
    'cargo_status'=>'required',
]);
Cargo::create ([
    //database column name => input field name
        'vehicle_number'=>$request->vehicle_number ,
        'drivers_name'=>$request->drivers_name,
        'drivers_license'=>$request->drivers_license,
        'cargo_status'=>$request->cargo_status,
 ]);
 
    return redirect()->route('cargo.type');
}


public function deletecargo($cargo_id){
    cargo::find($cargo_id)->delete();
    return redirect()->back()->with('message','cargo deleted successfully.');
}
public function viewcargo($cargo_id)
{
  $cargo=cargo::find($cargo_id);
  return view('Backend.pages.cargo.view',compact('cargo'));
}
public function edit($cargo_id)
{
    $cargo=cargo::find($cargo_id);
    // dd($branch);
    return view('Backend.pages.cargo.edit',compact('cargo'));
}
public function update(Request $request,$cargo_id){
    $request->validate([
        'vehicle_number'=>'required',
        'drivers_name'=>'required',
        'drivers_license'=>'required',
        'cargo_status'=>'required',
    ]);
    $cargo=cargo::find($cargo_id);
    $cargo->update ([
        //database column name => input field name
        'vehicle_number'=>$request->vehicle_number ,
        'drivers_name'=>$request->drivers_name,
        'drivers_license'=>$request->drivers_license,
        'cargo_status'=>$request->cargo_status,
 ]);
     return redirect()->route('cargo.type')->with('message','Update success.');


}



}
