<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <form action="" method="GET">
                <input type="text" name="search">
                <input type="submit" value="Recherche">
            </form>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @foreach($user as $aUser)
                        <a href="/user/{{$aUser->pseudo}}">
                            <span style="display:flex">
                                <div class="container-profile">
                                    <img src="/{{$aUser->medium->path}}" alt="">
                                </div>
                                {{$aUser->pseudo}}
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>