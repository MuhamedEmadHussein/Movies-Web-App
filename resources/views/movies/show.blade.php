@extends('layouts.app')

@section('content')
<div class="movies-info border-b border-gray-800">
    @if (count($movie['videos']['results']) > 0)
        <!-- Modal for YouTube video -->
        <div x-data="{ isOpen: false }">
            <!-- Modal Overlay -->
            <div x-show="isOpen" class="fixed inset-0 bg-black opacity-75"></div>

            <!-- Modal Body -->
            <div x-show="isOpen" class="fixed inset-0 flex items-center justify-center">
                <div class="bg-white rounded-lg p-8 w-full sm:w-1/2 md:w-2/3 lg:w-1/2">
                    <!-- YouTube Video -->
                    <div class="relative" style="padding-top: 56.25%;" @click.away="isOpen = false">
                        <iframe class="absolute top-0 left-0 w-full h-full" src="https://www.youtube.com/embed/{{$movie['videos']['results'][0]['key']}}" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>

            <!-- Buttons to open modal -->
            <div class="flex justify-end mr-5 mt-4">
                <button @click="isOpen = true" class="inline-flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150">
                    <svg class="w-6 fill-current" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
                    <span class="ml-2">Play Trailer Here</span>
                </button>
            </div>
        </div>
    @endif
    <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
        <img src="{{$movie['poster_path']}}" alt="parasite" class="w-64 md:w-96">
        <div class="md:ml-24">
            <h2 class="text-4xl font-semibold">
                {{$movie['title']}}
            </h2>
            <div class="flex flex-wrap items-center text-gray-400 text-sm mt-1">
                <svg class="fill-current text-orange-500 w-4" viewBox="0 0 24 24"><g data-name="Layer 2"><path d="M17.56 21a1 1 0 01-.46-.11L12 18.22l-5.1 2.67a1 1 0 01-1.45-1.06l1-5.63-4.12-4a1 1 0 01-.25-1 1 1 0 01.81-.68l5.7-.83 2.51-5.13a1 1 0 011.8 0l2.54 5.12 5.7.83a1 1 0 01.81.68 1 1 0 01-.25 1l-4.12 4 1 5.63a1 1 0 01-.4 1 1 1 0 01-.62.18z" data-name="star"/></g></svg>
                <span class="ml-1">{{$movie['vote_average']}}%</span>
                <span class="mx-2">|</span>
                <span>{{$movie['release_date']}}</span>
                <span class="mx-2">|</span>
                <span>
                    {{$movie['genres']}}
                </span>
            </div>
            <p class="text-gray-300 mt-8">
                {{$movie['overview']}}
            </p>
            <div class="mt-12">
                <h4 class="text-white font-semibold">Featured Crews</h4>
                <div class="flex mt-4">
                    @foreach ($movie['crews'] as $crew)
                        <div class="mr-8">
                            <div>
                                {{$crew['name']}}
                            </div>
                            <div class="text-sm text-gray-400">{{$crew['job']}}</div>
                        </div>
                    @endforeach
                </div>
            </div>
            @if (count($movie['videos']['results']) > 0)
                <div class="mt-12">
                    <a href="https://youtube.com/watch?v={{$movie['videos']['results'][0]['key']}}" class="inline-flex items-center bg-orange-500 text-gray-900 rounded
                    font-semibold px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150">
                        <svg class="w-6 fill-current" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
                        <span class="ml-2">Play Trailer On Youtube</span>
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
<div class="movies-cast border-b border-gray-800">
    <div class="container mx-auto px-4 py-16">
        <h2 class="text-4xl font-semibold">Casts</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            @foreach ($movie['casts'] as $cast)
                <div class="mt-8">
                    <a href="{{route('actors.show',$cast['id'])}}">
                        @if(isset($cast['profile_path']) && $cast['profile_path'] !== null)
                            <img src="https://image.tmdb.org/t/p/w235_and_h235_face{{$cast['profile_path']}}" alt="No Image" class="hover:opacity-75 transition ease-in-out duration-150">
                        @else
                            <img src="https://ui-avatars.com/api/?size=235&name={{$cast['name']}}" alt="No Image" class="hover:opacity-75 transition ease-in-out duration-150">
                        @endif
                    </a>
                    <div class="mt-2">
                        <a href="{{route('actors.show',$cast['id'])}}" class="text-lg mt-2 hover:text-gray:300">{{ $cast['name'] }}</a>
                        <div class="text-sm text-gray-400">
                            {{ $cast['character'] }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="movie-images">
    <div class="container mx-auto px-4 py-16">
        <h2 class="text-4xl font-semibold">Images</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @foreach ($movie['images'] as $image)
                <div class="mt-8">
                    <a href="#">
                        <img src="https://image.tmdb.org/t/p/w500{{$image['file_path']}}" alt="image1" class="hover:opacity-75 transition ease-in-out duration-150">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
