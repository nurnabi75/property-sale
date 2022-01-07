<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;

class NewProperty extends Model
{
    use HasFactory;

    protected $guarded = ['created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at'];

    // public function featured(){
    //     $this->belongsTo(Media::class, 'featured_media_id');
    // }

    public function location(){
        return $this->belongsTo(Location::class, 'Location_id');
    }

   

    public function gallery(){
        return $this->hasMany(Media::class, 'property_id');
    }

    public function dynamic_pricing($lira){

        $current_currency= Cookie::get('currency','tl');

        if($current_currency =='usd'){
            $get = Http::get('http://freecurrencyapi.net/api/v2/latest?apikey=76c89170-6178-11ec-98f1-5f7ce0abde0a&base_currency=TRY');

            if($get->successful()){
                $usd = intval($lira = $get->json()['data']['USD']);
                return $usd . 'USD';
            }

        } else{

            return $lira . 'TL';

        }


    }


}
