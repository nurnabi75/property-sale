<x-guest-layout>
    {{-- Breadcrumb --}}
    <div class="shadow-md border-2 border-gray-400 py-2 bg-white mt-28">
        <div class="container mx-auto">
            <ul class="flex items-center">
                <li><a class="text-base text-red-800" href="{{route('home')}}">Property</a></li>
                <li class="mx-3"><i class="fa fa-angle-right"></i></li>
                <li>Properties</li>
            </ul>
        </div>
    </div>

    <!--Title & share-->

    <div class="bg-white py-8">
        <div class="container mx-auto">
            <h2 class="text-3xl text-gray-800">Properties
                @if(request('type')=='0')
                    - Land
                @elseif(request('type')==1)
                    - Apartment
                @elseif(request('type')==2)
                    - Villa
                @endif
            </h2>
        </div>
    </div>

    <!-- Content -->
    <div class="container mx-auto py-10">
        <div class="flex justify-between">

            {{-- Left Content --}}
            <div class="w-9/12">
                <div class="flex flex-wrap -mx-2 justify-between mt-10">
                    @foreach($latest_properties as $property)
                   @include('components.single-property-card', ['property' =>$property])
                
                   @endforeach
                </div>
               {{ $latest_properties->withQueryString()->links() }}

                
      
            </div>
            {{-- Left Content End --}}



            {{-- Sidebar --}}
            <div class="w-3/12 ml-6 vertical-search-form">
                @include('components.property-search-form')

            </div>


        </div>

    </div>
</x-guest-layout>
