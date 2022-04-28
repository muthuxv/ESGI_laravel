<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bvn sur votre file') }}
        </h2>
    </x-slot>
    @switch($isPost)
        @case(1)
            <span style="color:green">Votre post a été crée !</span>
            @break

        @case(2)
            <span style="color:green">Votre post a été supprimé !</span>
            @break
    @endswitch
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>