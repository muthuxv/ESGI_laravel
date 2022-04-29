<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
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
            @if($user != Auth::user()->pseudo)
                [<a href="{{ route('convUser', $user) }}">Envoyer d'un message</a>]
            @endif
            </nav>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1>
                        @foreach($comments as $comment)
                            <a href="/post/{{$comment['idPost']}}">
                                <span style="display:flex">
                                    <div class="container-profile">
                                        <img src="/{{$comment['path']}}" alt="">
                                    </div>
                                    {{$comment["pseudo"]}} : {{$comment["text"]}}
                                </span>
                            </a>
                            <div style="font-size:0.9em">
                                Envoyé à : {{$comment["sendAt"]}}
                                @if($comment["id"] == Auth::user()->id)
                                    [<a href=" {{ route('deleteCom', $comment['idCom'])}}">Supprimer</a>]
                                @endif
                            </div>
                        @endforeach
                    </h1>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>