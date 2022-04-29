<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bvn sur votre file') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div style="width : 54rem;" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @foreach($posts as $post)
                        <div style="border:1px solid black;margin-bottom:25px;padding:15px;width:750px;height:auto;">
                        <a href="{{ route('user', $post['user']) }}">
                        <h2 style="display:flex">
                            <div class="container-profile">
                                <img src="/{{$post['imgP']}}" alt="">
                            </div>
                            {{ $post['user'] }}
                        </h2>
                        </a>
                        <a href="{{ route('post', $post['idPost']) }}">
                            <p>A dit : {{$post["text"]}}</p>
                            @if(!is_null($post["path"]))
                                <img width="450" height="300" src="/{{$post['path']}}" alt="">
                            @endif
                        </a>
                            <span style="font-size:0.9em">Posté à : {{$post["postedAt"]}}</span>
                            <a style="position:relative; bottom:5px; right:-450px;font-size:1.5em" href="{{ route('like', $post['idPost']) }}">{{$post["like"]}} ❤</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>