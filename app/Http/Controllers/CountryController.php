<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{
    public function index()
    {    
        $countries=Country::all();
        //dd($countries);
         return response()->json($countries,200);
    }
    public function show($id)
    {
        //$country=Country::findOrFail($id);
        $country=Country::find($id);
        if(is_null($country))
        {
            return response()->json(['message'=>'Conutry Not Found!!'],404);
        }
       // dd($country);
        return response()->json($country, 200);
    }
    public function store(Request $request)
    {   
        $rules=[
            'name'=>'required|min:3',
            'iso'=>'required|min:2|max:2'
        ];
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails()){
              return response()->json($validator->errors(),400);
        }
        $data=$request->all();
        $country=new Country();
        $country->create($data);
        return response()->json($country,201);
    }
    public function update(Request $request,$country)
    {   
        $country=Country::find($country);
        if(is_null($country))
        {
        return response()->json(['message'=>'Conutry Not Found!!'],404);
        }
        $country->update($request->all());
        return response()->json($country,200);
    }
     public function destroy(Request $request,$country)
    {
         $country=Country::find($country);
        if(is_null($country))
        {
        return response()->json(['message'=>'Conutry Not Found!!'],404);
        }
        $country->delete();
        return response()->json(null,200);
    }
}
