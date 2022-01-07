<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Location;
use App\Models\Media;
use App\Models\NewProperty;
use Illuminate\Support\Facades\Storage;


class DashboardController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }

    public function properties(){
        $properties =NewProperty::latest()->paginate(20);
        
        //dd($properties);
        return view ('admin.properties',['properties' =>$properties]);
    }

    public function addProperty(){
        $locations = Location::all();

       // dd($locations);
        
        return view('admin.property.add',['locations' =>$locations]);
    }

    public function validateProperty(){
        return[
            'name' =>'required',
            'name_tr' =>'required',
            
            'Location_id' =>'required',
            'price' =>'required|integer',
            'sale' =>'integer',
            'type' =>'integer',
            'bathrooms' =>'integer',
            'net_sqm' =>'integer',
            'pool' =>'integer',
            'overview' =>'required',
            'overview_tr' =>'required',
            'description' =>'required',
            'description_tr' =>'required',
        ];
    }

    public function saveOrUpdateProperty($property, $request){

                    
      
        $property->name = $request->name;
        $property->name_tr = $request->name_tr;

       

        $featured_image_name=time(). '-' .$request ->featured_image->getClientOriginalName();

        //store the file
        $request->featured_image->storeAs('public/upload',$featured_image_name);

        $property->featured_image = $featured_image_name;

        


        $property->Location_id = $request->Location_id;
        $property->price = $request->price;
        $property->sale = $request->sale;
        $property->type = $request->type;
        $property->drawing_rooms = $request->drawing_rooms;
        $property->bedrooms = $request->bedrooms;
        $property->bathrooms = $request->bathrooms;
        $property->net_sqm = $request->net_sqm;
        $property->gross_sqm = $request->gross_sqm;
        $property->pool = $request->pool;
        $property->overview = $request->overview;
        $property->overview_tr = $request->overview_tr;
        $property->why_buy = $request->why_buy;
        $property->why_buy_tr = $request->why_buy_tr;
        $property->description = $request->description;
        $property->description_tr = $request->description_tr;

        $property->save();


        foreach($request-> gallery_images as $image){
            $gallery_images_name=time(). '-' .$image->getClientOriginalName();
            $image ->storeAs('public/upload', $gallery_images_name);
            $media = new Media();
            $media-> name = $gallery_images_name;
            $media->property_id = $property->id;
            $media -> save();
        }

       

    }

    public function createProperty( Request $request){
        $update_validation = $this ->validateProperty()[] =[
            'featured_image' =>'required|image',
             'gallery_images' =>'required',

        ];
        $request->validate($update_validation);


        $property = new NewProperty();

        $this->saveOrUpdateProperty($property, $request);

        return redirect(route('dashboard-properties'))->with(['message' => 'Property is added.']);

       
    }

    public function editProperty($property_id){
        $property =NewProperty::findOrFail($property_id);
        $locations = Location::all();

        return view('admin.property.edit',[

            'property'=>$property,
            'locations'=>$locations
        ]);
    }


    public function deleteMedia($media_id) {
        $media = Media::findOrFail($media_id);

        // delete the file 
     
        Storage::delete('public/upload/' . $media->name);

        // remove row
        $media ->delete();
        return back();


    }

    public function updateProperty($property_id, Request $request){

        $property = NewProperty::findOrFail($property_id);

        $request->validate($this->validateProperty());

        $this->saveOrUpdateProperty($property, $request);

        return redirect(route('dashboard-properties'))->with(['message' => 'Property is Saved.']);

    }

    public function deleteProperty($property_id){

        $property = NewProperty::findOrFail($property_id);

        //featured image delete 
        Storage::delete('public/upload/' . $property->featured_image);
        // delete media
        foreach($property->gallery as $media){
         $media = Media::findOrFail($media->id); 
         Storage::delete('public/upload/' . $media->name);
         $media ->delete();


        }
        // delete the property
        $property->delete();

        return redirect(route('dashboard-properties'))->with(['message' => 'Property is Deleted.']);
    }

    //user control

    public function page(){

        return view ('admin.page');
    }
}

