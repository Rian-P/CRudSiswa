@extends('layouts.app')
@section('content')

<form class="max-w-sm mx-auto" method="POST" action="{{route('lembaga.tambah')}}" enctype="multipart/form-data">
  @csrf
  <div class="mb-5">
    <label for="lembaga" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">lembaga</label>
    <input type="text" name="lembaga"  class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
  </div>
  
  <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">tambah lembaga</button>
</form>
@endsection