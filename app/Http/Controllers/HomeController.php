<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\NewProperty;
use App\Models\Page;
use App\Models\property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
//use phpDocumentor\Reflection\Location;

class HomeController extends Controller
{
    public function home(){
        $latest_properties= NewProperty::latest()->get()->take(4);

        $location = Location::select(['id', 'name'])->get();



        //dd($latest_properties);

        return view('welcome', [
            'latest_properties'=> $latest_properties,
            'locations' => $location

        ]);
    }

    public function singlePage($slug){
        $page=Page::where('slug', $slug)->first();

        if(!empty($page)){
            return view ('page',[
                'page'=>$page
            ]);
        }else{
            return abort('404');
        }
    }

    public function currencyChange($code){

        Cookie::queue('currency',$code,3600);
         return back();

    }
}
