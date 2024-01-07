@extends('layouts.app')
@section('content')

      

<div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <div class="flex flex-col items-center mt-10 pb-10">
    <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="{{ asset('profil/foto.jpg') }}" alt="Rian pratama"/>
        @if(Auth::check())
        <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ $user->name }}</h5>
        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $user ->position }}</span>
        @else
        @endif
        
    </div>
</div>

 

@endsection