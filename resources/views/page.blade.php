<x-guest-layout>
    {{-- Breadcrumb --}}
    <div class="shadow-md border-2 border-gray-400 py-2 bg-white mt-28">
        <div class="container mx-auto">
            <ul class="flex items-center">
                <li><a class="text-base text-red-800" href="{{route('home')}}">Property</a></li>
                <li class="mx-3"><i class="fa fa-angle-right"></i></li>
                <li>{{$page->name}}</li>
            </ul>
        </div>
    </div>
    {{$page}}
</x-guest-layout>