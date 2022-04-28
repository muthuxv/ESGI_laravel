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
                Abonnement : {{ $nbabonnement }}
                Abonnés : {{ $nbabonne }}
                <br><br>
                [<a href="{{ route('user', $user) }}">Postes</a>]
                [<a href="{{ route('userComments', $user) }}">Commentaires</a>]
                [<a href="{{ route('userLiked', $user) }}">Likes</a>]
            </nav>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1>
                        postes de {{$user}}
                    </h1>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>