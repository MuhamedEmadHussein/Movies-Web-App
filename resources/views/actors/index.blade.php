@extends('layouts.app')
@section('content')
    <div class="container mx-auto px-4 py-12">
        <div class="popular-actors">
            <h2 class="uppercase text-orange-400 tracking-wider text-lg font-semibold">Popular Actors</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($popularActors as $actor)
                    <div class="actor mt-8">
                        <a href="{{route('actors.show',$actor['id'])}}">
                            <img src="{{$actor['profile_path']}}" class="hover:opacity-75 transition ease-in-out duration-150">
                        </a>
                        <div class="mt-2">
                            <a href="{{route('actors.show',$actor['id'])}}" class="text-lg hover:text-gray-300">
                                {{$actor['original_name']}}
                            </a>
                            <div class="text-sm truncate text-gray-400">
                                {{$actor['famous_movies']}}
                            </div>
                        </div>
                    </div>
                @endforeach

        </div>
        <div class="flex justify-between mt-16">
            @if ($previous)
                <a href="/actors/page/{{$previous}}">Previous</a>
            @else
                <div></div>
            @endif

            @if ($next)
                <a href="/actors/page/{{$next}}">Next</a>
            @else
                <div></div>
            @endif
        </div>
    </div>

@endsection
