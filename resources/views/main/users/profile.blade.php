<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Parametre profile
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <span style="display:flex">
                        <div class="container-profile">
                            <img src="/{{$user->medium->path}}" alt="">
                        </div>
                        {{$user->pseudo}}
                    </span><br>
                    <span>Nom : {{$user->name}} // Prénom : {{$user->lastname}}</span><br>
                    <span>Email : {{$user->email}}</span><br><br>
                    <label style="font-weight:bold" for="">Changer de photo de profile</label><br>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li style="color:red">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('changeProfile') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="profile">
                        <input type="submit" value="Changer">
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>