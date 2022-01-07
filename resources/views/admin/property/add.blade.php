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
                <form action="{{route('create-property')}}" method="post" class="p-6 bg-white border-b border-gray-200"
                enctype="multipart/form-data">
                     @csrf
                    <div class="flex -mx-4 mb-6">
                        <div class="flex-1 px-4">
                            <label class="property-label" for="name"><span class="required-text">*</span>Title</label>
                            <input class="property-input" type="text" id="name" name="name" value="{{old('name')}}" required>

                            @error('name')
                            <p class="text-red-500 mt-2 text-sm">{{$message}}</p>   
                            @enderror
                        </div>
                        <div class="flex-1 px-4">
                            <label class="property-label" for="name_tr"><span class="required-text">*</span>Title - Turkish</label>
                            <input class="property-input" type="text" id="name_tr" name="name_tr" value="{{old('name_tr')}}" required>

                            @error('name_tr')
                            <p class="text-red-500 mt-2 text-sm">{{$message}}</p>   
                            @enderror
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="property-label" for="featured_image"><span class="required-text">*</span>Featured Image</label>
                        <input class="property-input" type="file" id="featured_image" name="featured_image" required>

                        
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
                            <select class="property-label" name="Location_id" id="Location_id">
                                <option value="">Select location</option>
                                @foreach ($locations as $location)
                                    <option {{old('Location_id')==$location->id ? 'selected="selected"' : ''}} value="{{$location->id}}">{{$location->name}}</option>
                                @endforeach
                            </select>

                            @error('Location_id')
                            <p class="text-red-500 mt-2 text-sm">{{$message}}</p>   
                            @enderror
                        </div>
                        <div class="flex-1 px-4">
                            <label class="property-label" for="price"><span class="required-text">*</span>Price</label>
                            <input class="property-input" type="number" id="price" name="price" value="{{old('price')}}" required>

                            @error('price')
                            <p class="text-red-500 mt-2 text-sm">{{$message}}</p>   
                            @enderror
                        </div>

                        <div class="flex-1 px-4">
                            <label class="property-label" for="sale"><span class="required-text">*</span>For</label>
                            <select class="property-label" name="sale" id="sale" required>
                                <option value="">Select type</option>
                                <option {{old('sale')=='0' ? 'selected="selected"' : '' }} value="0">Rent</option>
                                <option {{old('sale')=='1' ? 'selected="selected"' : '' }} value="1">sale</option>
                            </select>

                            @error('sale')
                            <p class="text-red-500 mt-2 text-sm">{{$message}}</p>   
                            @enderror
                        </div>

                        <div class="flex-1 px-4">
                            <label class="property-label" for="type"><span class="required-text">*</span>Type</label>
                            <select class="property-label" name="type" id="type" required>
                                <option value="">Select property type</option>
                                <option {{old('type')=='0' ? 'selected="selected"' : '' }} value="0">Land</option>
                                <option {{old('type')=='1' ? 'selected="selected"' : '' }} value="1">Appartment</option>
                                <option {{old('type')=='2' ? 'selected="selected"' : '' }} value="1">Villa</option>
                            </select>

                            @error('type')
                            <p class="text-red-500 mt-2 text-sm">{{$message}}</p>   
                            @enderror
                        </div>                    
                    </div>
                  
                        <div class="flex -mx-4 mb-6">

                            <div class="flex-1 px-4">
                                <label class="property-label" for="drawing_rooms">Drawing Room</label>
                                <select class="property-input"  name="drawing_rooms" id="drawing_rooms">
                                    <option value="" >Select bedrooms</option>
                                    @for($x = 0; $x <= 3; $x++)
                                <option {{old('drawing_rooms') == $x ? 'selected="selected"' : ''}}  value="{{$x}}">{{$x}}</option>
                                @endfor
                                    
                                </select>
    
                                @error('drawing_rooms')
                                <p class="text-red-500 mt-2 text-sm">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="flex-1 px-4">
                                <label class="property-label" for="bedrooms">Bedrooms</label>
                                <select class="property-input"  name="bedrooms" id="bedrooms" >
                                    <option value="">Select bedrooms</option>
                                    @for ($x = 0; $x <= 8; $x++)
                                    <option {{old('bedrooms') == $x ? 'selected="selected"' : ''}}  value="{{$x}}">{{$x}}</option>
                                    @endfor
                                   
                                </select>
    
                                @error('bedrooms')
                                <p class="text-red-500 mt-2 text-sm">{{$message}}</p>
                                @enderror
                            </div>
    
                            <div class="flex-1 px-4">
                                <label class="property-label" for="bathrooms">Bathrooms</label>
                                <select class="property-input"  name="bathrooms" id="bathrooms" >
                                    <option value="">Select bedrooms</option>

                                    @for ($x = 0; $x <= 6; $x++)
                                    <option {{old('bathrooms') == $x ? 'selected="selected"' : ''}}  value="{{$x}}">{{$x}}</option>
                                    @endfor
                                   
                                </select>
    
                                @error('bathrooms')
                                <p class="text-red-500 mt-2 text-sm">{{$message}}</p>
                                @enderror
                            </div>
    
                            <div class="flex-1 px-4">
                                <label class="property-label" for="net_sqm">Net square meeter</label>
                                <input class="property-input" type="number" id="net_sqm" name="net_sqm" value="{{old('net_sqm')}}" required>
    
                                @error('net_sqm')
                                <p class="text-red-500 mt-2 text-sm">{{$message}}</p>
                                @enderror
                            </div>
    
                            <div class="flex-1 px-4">
                                <label class="property-label" for="gross_sqm">Gross square meeter</label>
                                <input class="property-input" type="number" id="gross_sqm" name="gross_sqm" value="{{old('gross_sqm')}}" required>
    
                                @error('gross_sqm')
                                <p class="text-red-500 mt-2 text-sm">{{$message}}</p>
                                @enderror
                            </div>
    
                            <div class="flex-1 px-4">
                                <label class="property-label" for="pool">Pool</label>
                                <select class="property-input"  name="pool" id="pool" required>
                                    <option value="">Select pool</option>
                                    <option  {{old('pool')=='0' ? 'selected="selected"' : '' }} value="0">No</option>
                                    <option  {{old('pool')=='1' ? 'selected="selected"' : '' }} value="0" value="1">Private</option>
                                    <option  {{old('pool')=='2' ? 'selected="selected"' : '' }} value="0" value="2">Public</option>
                                    <option  {{old('pool')=='3' ? 'selected="selected"' : '' }} value="0" value="3">Both</option>
                                </select>
    
                                @error('pool')
                                <p class="text-red-500 mt-2 text-sm">{{$message}}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex -mx-4 mb-6">
                            <div class="flex-1 px-4">
                                <label class="property-label" for="overview"><span class="required-text">*</span>Overview</label>
                                <textarea class="property-input" name="overview" id="overview" cols="30" rows="3"required>{{old('overview')}}</textarea>
    
                                @error('overview')
                                <p class="text-red-500 mt-2 text-sm">{{$message}}</p>
                                @enderror
                            </div>
    
                            <div class="flex-1 px-4">
                                <label class="property-label" for="overview_tr"><span class="required-text">*</span>Overview - TR</label>
                                <textarea class="property-input" name="overview_tr" id="overview_tr" cols="30" rows="3" required >{{old('overview_tr')}}</textarea>
    
                                @error('overview_tr')
                                <p class="text-red-500 mt-2 text-sm">{{$message}}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex -mx-4 mb-6">
                            <div class="flex-1 px-4">
                                <label class="property-label" for="why_buy"><span class="required-text">*</span>Why buy</label>
                                <textarea class="property-input" name="why_buy" id="why_buy" cols="30" rows="5" required>{{old('why_buy')}}</textarea>
    
                                @error('why_buy')
                                <p class="text-red-500 mt-2 text-sm">{{$message}}</p>
                                @enderror
                            </div>
    
                            <div class="flex-1 px-4">
                                <label class="property-label" for="why_buy_tr"><span class="required-text">*</span>Why buy - TR</label>
                                <textarea class="property-input" name="why_buy_tr" id="why_buy_tr" cols="30" rows="5" required>{{old('why_buy_tr')}}</textarea>
    
                                @error('why_buy_tr')
                                <p class="text-red-500 mt-2 text-sm">{{$message}}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex -mx-4 mb-6">
                            <div class="flex-1 px-4">
                                <label class="property-label" for="description"><span class="required-text">*</span>Description</label>
                                <textarea class="property-input" name="description" id="description" cols="30" rows="10" required>{{old('description')}}</textarea>
    
                                @error('description')
                                <p class="text-red-500 mt-2 text-sm">{{$message}}</p>
                                @enderror
                            </div>
    
                            <div class="flex-1 px-4">
                                <label class="property-label" for="description_tr"><span class="required-text">*</span>Description - TR</label>
                                <textarea class="property-input" name="description_tr" id="description_tr" cols="30" rows="10" required>{{old('description_tr')}}</textarea>
    
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
