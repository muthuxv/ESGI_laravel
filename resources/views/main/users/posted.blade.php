<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        @if (\Session::has('msg'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('msg') !!}</li>
                </ul>
            </div>
        @endif
           <nav>
                <b>Profil de {{ $user }}</b>

                @if($isfollowing)
                    <a href="{{ route('unfollow', $user) }}">[UNFOLLOW]</a>
                @elseif(Auth::user()->pseudo != $user)
                    <a href="{{ route('follow', $user) }}">[FOLLOW]</a>
                @endif
                <a href="{{ route('abonnements', $user) }}">Abonnement : {{ $nbabonnement }}</a>
                <a href="{{ route('abonnes', $user) }}">Abonnés : {{ $nbabonne }}</a>
                <br><br>
                [<a href="{{ route('user', $user) }}">Postes</a>]
                [<a href="{{ route('userComments', $user) }}">Commentaires</a>]
                [<a href="{{ route('userLiked', $user) }}">Likes</a>]
                [<a href="{{ route('convUser', $user) }}">Envoyer un message</a>]
            </nav>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1>postes de {{$user}}</h1>
                    @foreach($posts as $post)
                        <div style="border:1px solid black;margin-bottom:25px;padding:15px;width:750px;height:auto;position:relative;">
                            <h2 style="display:flex">
                                <div class="container-profile">
                                    <img src="/{{$post['imgP']}}" alt="">
                                </div>
                                {{$user}}
                            </h2>
                            <a href="{{ route('post', $post['idPost']) }}">
                                <p>A dit : {{$post["text"]}}</p>
                                @if(!is_null($post["path"]))
                                    <img width="450" height="300" src="/{{$post['path']}}" alt="">
                                @endif
                            </a>
                            <span style="font-size:0.9em">Posté à : {{$post["postedAt"]}}</span>
                            @if($post["id"] == Auth::user()->id)
                                [<a href="{{ route('delete', $post['idPost'])}}">Supprimer</a>]
                            @endif
                            <a style="position:absolute; bottom:5px; right:5px;font-size:1.5em" href="{{ route('like', $post['idPost']) }}">{{$post["like"]}} ❤</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>