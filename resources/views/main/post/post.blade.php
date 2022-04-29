<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Le post {{$id}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div style="position:relative">
                        <h2 style="display:flex">
                            <div class="container-profile">
                                <img src="/{{$post['imgP']}}" alt="">
                            </div>
                            {{$user}}
                        </h2>
                        <p>A dit : {{$post["text"]}}</p>
                        @if(!is_null($post["path"]))
                            <img width="450" height="300" src="/{{$post['path']}}" alt="">
                        @endif
                        <span style="font-size:0.9em">Posté à : {{$post["postedAt"]}}</span>
                        @if($post["id"] == Auth::user()->id)
                            [<a href="{{ route('delete', $post['idPost'])}}">Supprimer</a>]
                        @endif
                        <a style="position:absolute; bottom:5px; right:5px;font-size:1.5em" href="{{ route('like', $post['idPost']) }}">{{$post["like"]}} ❤</a>
                    </div>
                    <div style="width:100%;height:1px;background-color:black"></div>
                    <h2>Commentaire</h2>
                    <form action="{{ route('comment', $id)}}" method="POST">
                        <input name="text" type="text">
                        <input type="submit" value="Envoie commentaire">
                        @csrf
                    </form>
                    <div>
                        @foreach($comments as $comment)
                            <span style="display:flex">
                                <a href="{{ route('user', $comment['pseudo'])}}" style="display:flex">
                                    <div class="container-profile">
                                        <img src="/{{$comment['path']}}" alt="">
                                    </div>
                                    {{$comment["pseudo"]}} </a>: {{$comment["text"]}}
                            </span>
                            <div style="font-size:0.9em">
                                Envoyé à : {{$comment["sendAt"]}}
                                @if($comment["id"] == Auth::user()->id)
                                    [<a href=" {{ route('deleteCom', $comment['idCom'])}}">Supprimer</a>]
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>