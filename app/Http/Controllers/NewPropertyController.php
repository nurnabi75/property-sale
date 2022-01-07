<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewProperty;
use App\Models\Location;

class NewPropertyController extends Controller
{
    //
    public function single($id){
        $property = NewProperty::findOrFail($id);

        //dd($property->gallery()->count());

        return view('property.single',['property' =>$property] );
    }

    public function index(Request $request){

        $latest_properties =NewProperty::latest();

        $locations = Location::select(['id', 'name'])->get();

       if(!empty($request->sale)) {
        $latest_properties= $latest_properties->where('sale', $request->sale);
       }

       if(!empty($request->type)) {
        $latest_properties= $latest_properties->where('type', $request->type);
       }

       if(!empty($request->location)) {
        $latest_properties= $latest_properties->where('Location_id', $request->location);
       }

       if(!empty($request->bedrooms)) {
        $latest_properties= $latest_properties->where('bedrooms', $request->bedrooms);
       }
       if(!empty($request->property_name)) {
        $latest_properties= $latest_properties->Where('name', 'LIKE', '%' . $request->property_name . '%');
       }

       if(!empty($request->price)) {
        if($request->price =='100000'){
            $latest_properties= $latest_properties->where('price', '>', 0)->where('price', '<=', 100000);
        }
        if($request->price =='200000'){
            $latest_properties= $latest_properties->where('price', '>', 100000)->where('price', '<=', 200000);
        }
       if($request->price =='300000'){
            $latest_properties= $latest_properties->where('price', '>', 200000)->where('price', '<=', 300000);
        }
        if($request->price =='400000'){
            $latest_properties= $latest_properties->where('price', '>', 300000)->where('price', '<=', 400000);
        }
        if($request->price =='500000'){
            $latest_properties= $latest_properties->where('price', '>', 400000)->where('price', '<=', 500000);
        }
        if($request->price =='5000002'){
            $latest_properties= $latest_properties->where('price', '>', 500000);
        }
       }

       $latest_properties= $latest_properties->paginate(12);

        

        return view('property.index', ['latest_properties'=>$latest_properties, 'locations' =>$locations]);
    }
}
