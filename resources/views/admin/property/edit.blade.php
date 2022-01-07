<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add new property') }}
            </h2>

            
            <div class="min-w-max">
                <a href="{{route('dashboard-properties')}}" class="fullwidth-btn bg-blue-500 text-white text-xs px-4 py-2">Back</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

               <div class="p-6">

                <h3>Gallery Images</h3>
                 <div class="flex flex-wrap mt-3 ">
                    @foreach ($property->gallery as $gallery)
                    <div style="min-width: 100px" class=" mr-3  relative">
                        <div class="flex items-center justify-center h-full">
                            <img style="max-width: 100px" src="/storage/upload/{{$gallery->name}}" alt="">
                        </div>
                       
                        <form method="post"  action="{{route('delete-media', $gallery->id)}}" onsubmit="return confirm('Do you really want Delete the images?');" class="absolute right-0 top-0">@csrf
                            <button style="font-size: 8px" type="submit" class="text-white bg-red-600 px-3 py-1">Delete</button>
                        </form>
                        
                    </div>
                    @endforeach
                   
                 </div>
               </div>

                <form action="{{route('update-property', $property->id)}}" method="post" class="p-6 bg-white border-b border-gray-200"
                enctype="multipart/form-data"> @csrf
                    <div class="flex -mx-4 mb-6">
                        <div class="flex-1 px-4">
                            <label class="property-label" for="name"> <span class="required-text">*</span> Title</label>
                            <input class="property-input" type="text" id="name" name="name" value="{{$property->name}}" required>

                            @error('name')
                            <p class="text-red-500 mt-2 text-sm">{{$message}}</p>   
                            @enderror
                        </div>
                        <div class="flex-1 px-4">
                            <label class="property-label" for="name_tr"><span class="required-text">*</span> Title - Turkish</label>
                            <input class="property-input" type="text" id="name_tr" name="name_tr" value="{{$property->name_tr}}">

                            @error('name_tr')
                            <p class="text-red-500 mt-2 text-sm">{{$message}}</p>   
                            @enderror
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="property-label" for="featured_image"><span class="required-text">*</span>Featured Image</label>
                        <input class="property-input" type="file" id="featured_image" name="featured_image">

                        <div class="mt-3 ">
                            <img style="max-width: 100px" src="/storage/upload/{{$property->featured_image}}" alt="">
                        </div>

                        @error('featured_image')
                        <p class="text-red-500 mt-2 text-sm">{{$message}}</p>   
                        @enderror
                    </div>


                    <div class="mb-6">
                        <label class="property-label" for="gallery_images"><span class="required-text">*</span>Gallery Images</label>
                        <input class="property-input" type="file" id="gallery_images" name="gallery_images[]" multiple required>

                        @error('gallery_images')
                        <p class="text-red-500 mt-2 text-sm">{{$message}}</p>   
                        @enderror

                        
                    </div>

                    <div class="flex -mx-4 mb-6">
                        <div class="flex-1 px-4">
                            <label class="property-label" for="Location_id"><span class="required-text">*</span>Location</label>
                            <select class="property-input" name="Location_id" id="Location_id">
                                <option value="">Select location</option>
                                @foreach ($locations as $location)
                                    <option {{$property->location->id == $location->id ? 'selected="selected"' : ''}} value="{{$location->id}}">{{$location->name}}</option>
                                @endforeach
                            </select>

                            @error('Location_id')
                            <p class="text-red-500 mt-2 text-sm">{{$message}}</p>   
                            @enderror
                        </div>
                        <div class="flex-1 px-4">
                            <label class="property-label" for="price"><span class="required-text">*</span>Price</label>
                            <input class="property-input" type="number" id="price" name="price" value="{{$property->price}}">

                            @error('price')
                            <p class="text-red-500 mt-2 text-sm">{{$message}}</p>   
                            @enderror
                        </div>

                        <div class="flex-1 px-4">
                            <label class="property-label" for="sale"><span class="required-text">*</span>For</label>
                            <select class="property-input" name="sale" id="sale" required >
                                <option  value="">Select type</option>
                                <option  {{$property->sale == '0' ? 'selected="selected"' : ''}} value="0">Rent</option>
                                <option  {{$property->sale == '1' ? 'selected="selected"' : ''}} value="1">sale</option>
                            </select>

                            @error('sale')
                            <p class="text-red-500 mt-2 text-sm">{{$message}}</p>   
                            @enderror
                        </div>

                        <div class="flex-1 px-4">
                            <label class="property-label" for="type"><span class="required-text">*</span>Type</label>
                            <select class="property-input" name="type" id="type" required>
                                <option value="">Select property type</option>
                                <option  {{$property->type == '0' ? 'selected="selected"' : ''}} value="0">Land</option>
                                <option  {{$property->type == '1' ? 'selected="selected"' : ''}}  value="1">Appartment</option>
                                <option  {{$property->type == '2' ? 'selected="selected"' : ''}}  value="1">Villa</option>
                            </select>

                            @error('type')
                            <p class="text-red-500 mt-2 text-sm">{{$message}}</p>   
                            @enderror
                        </div>                    
                    </div>
                  
                        <div class="flex -mx-4 mb-6">

                            <div class="flex-1 px-4">
                                <label class="property-label" for="drawing_rooms"><span class="required-text">*</span>Drawing Room</label>
                                <select class="property-input"  name="drawing_rooms" id="drawing_rooms">
                                    <option value="" required>Select bedrooms</option>
                                    @for ($x = 0; $x <= 3; $x++)
                                    <option  {{$property->drawing_rooms == $x ? 'selected="selected"' : ''}} value="{{$x}}">{{$x}}</option>
                                    @endfor
                                    
                                </select>
    
                                @error('drawing_rooms')
                                <p class="text-red-500 mt-2 text-sm">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="flex-1 px-4">
                                <label class="property-label" for="bedrooms"><span class="required-text">*</span>Bedrooms</label>
                                <select class="property-input"  name="bedrooms" id="bedrooms">
                                    <option value="" required>Select bedrooms</option>
                                    @for ($x = 0; $x <= 3; $x++)
                                    <option {{$property->bedrooms == $x ? 'selected="selected"' : ''}} value="{{$x}}">{{$x}}</option>
                                    @endfor
                                    
                                </select>
    
                                @error('bedrooms')
                                <p class="text-red-500 mt-2 text-sm">{{$message}}</p>
                                @enderror
                            </div>
    
                            <div class="flex-1 px-4">
                                <label class="property-label" for="bathrooms"><span class="required-text">*</span>Bathrooms</label>
                                <select class="property-input"  name="bathrooms" id="bathrooms">
                                    <option value="" required>Select bedrooms</option>

                                    @for ($x = 0; $x <= 5; $x++)
                                    <option {{$property->bathrooms == $x ? 'selected="selected"' : ''}} value="{{$x}}">{{$x}}</option> 
                                    @endfor
                                    
                                </select>
    
                                @error('bathrooms')
                                <p class="text-red-500 mt-2 text-sm">{{$message}}</p>
                                @enderror
                            </div>
    
                            <div class="flex-1 px-4">
                                <label class="property-label" for="net_sqm"><span class="required-text">*</span>Net square meeter</label>
                                <input class="property-input" type="number" id="net_sqm" name="net_sqm" value="{{$property->net_sqm}}" required>
    
                                @error('net_sqm')
                                <p class="text-red-500 mt-2 text-sm">{{$message}}</p>
                                @enderror
                            </div>
    
                            <div class="flex-1 px-4">
                                <label class="property-label" for="gross_sqm"><span class="required-text">*</span>Gross square meeter</label>
                                <input class="property-input" type="number" id="gross_sqm" name="gross_sqm" value="{{$property->gross_sqm}}" required>
    
                                @error('gross_sqm')
                                <p class="text-red-500 mt-2 text-sm">{{$message}}</p>
                                @enderror
                            </div>
    
                            <div class="flex-1 px-4">
                                <label class="property-label" for="pool"><span class="required-text">*</span>Pool</label>
                                <select class="property-input"  name="pool" id="pool">
                                    <option  value="" >Select pool</option>
                                    <option {{$property->pool == '0' ? 'selected="selected"' : ''}} value="0">No</option>
                                    <option {{$property->pool == '1' ? 'selected="selected"' : ''}} value="1">Private</option>
                                    <option {{$property->pool == '2' ? 'selected="selected"' : ''}} value="2">Public</option>
                                    <option {{$property->pool == '3' ? 'selected="selected"' : ''}} value="3">Both</option>
                                </select>
    
                                @error('pool')
                                <p class="text-red-500 mt-2 text-sm">{{$message}}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex -mx-4 mb-6">
                            <div class="flex-1 px-4">
                                <label class="property-label" for="overview"><span class="required-text">*</span>Overview</label>
                                <textarea class="property-input" name="overview" id="overview" cols="30" rows="3" required>{{$property->overview}}</textarea>
    
                                @error('overview')
                                <p class="text-red-500 mt-2 text-sm">{{$message}}</p>
                                @enderror
                            </div>
    
                            <div class="flex-1 px-4">
                                <label class="property-label" for="overview_tr"><span class="required-text">*</span>Overview - TR</label>
                                <textarea class="property-input" name="overview_tr" id="overview_tr" cols="30" rows="3" required>{{$property->overview_tr}}</textarea>
    
                                @error('overview_tr')
                                <p class="text-red-500 mt-2 text-sm">{{$message}}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex -mx-4 mb-6">
                            <div class="flex-1 px-4">
                                <label class="property-label" for="why_buy"><span class="required-text">*</span>Why buy</label>
                                <textarea class="property-input" name="why_buy" id="why_buy" cols="30" rows="5" required>{{$property->why_buy}}</textarea>
    
                                @error('why_buy')
                                <p class="text-red-500 mt-2 text-sm">{{$message}}</p>
                                @enderror
                            </div>
    
                            <div class="flex-1 px-4">
                                <label class="property-label" for="why_buy_tr"><span class="required-text">*</span>Why buy - TR</label>
                                <textarea class="property-input" name="why_buy_tr" id="why_buy_tr" cols="30" rows="5" required>{{$property->why_buy_tr}}</textarea>
    
                                @error('why_buy_tr')
                                <p class="text-red-500 mt-2 text-sm">{{$message}}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex -mx-4 mb-6">
                            <div class="flex-1 px-4">
                                <label class="property-label" for="description"><span class="required-text">*</span>Description</label>
                                <textarea class="property-input" name="description" id="description" cols="30" rows="10" required>{{$property->description}}</textarea>
    
                                @error('description')
                                <p class="text-red-500 mt-2 text-sm">{{$message}}</p>
                                @enderror
                            </div>
    
                            <div class="flex-1 px-4">
                                <label class="property-label" for="description_tr"><span class="required-text">*</span>Description - TR</label>
                                <textarea class="property-input" name="description_tr" id="description_tr" cols="30" rows="10" required>{{$property->description_tr}}</textarea>
    
                                @error('description_tr')
                                <p class="text-red-500 mt-2 text-sm">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <button class="btn" type="submit">Save Property</button>   
                        
                        

                </form>


            </div>
        </div>
    </div>
</x-app-layout>
